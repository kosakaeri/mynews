<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use App\ProfileHistory;
use Carbon\Carbon;

class ProfileController extends Controller
{
   public function add()
   {
     return view('admin.profile.create');
   }
   
   public function create(Request $request)
   {
      // Varidationを行う
      $this->validate($request, Profile::$rules);
      $profile = new Profile;
      $form = $request->all();
 
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      
      // データベースに保存する
      $profile->fill($form);
      $profile->save();
      

     return redirect('admin/profile/create');
   }
   
   public function edit(Request $request)
   {
      //Profile Modelからデータを取得する
      $profile = Profile::find($request->id);
      if (empty($profile)) {
        abort(404);    
      }
     return view('admin.profile.edit', ['profile_form' => $profile]);
   }
   
   public function update(Request $request)
   {
      // Validationをかける
      $this->validate($request, Profile::$rules);
      
      // Profile Modelからデータを取得する
      $profiles = Profile::find($request->id);
      
      // 送信されてきたフォームデータを格納する
      $profile_form = $request->all();
        unset($profile_form['remove']);
        unset($profile_form['_token']);
        
      // 該当するデータを上書きして保存する
      $profiles->fill($profile_form)->save();
      
       //時刻を扱うために Carbon という日付操作ライブラリを使用。Carbon を使って取得した現在時刻を、ProfileHistoryモデルの edited_at として記録します。
      $history = new ProfileHistory;
      $history->profile_id = $profiles->id;
      $history->edited_at = Carbon::now();
      $history->save();
      
      
      return redirect('admin/profile/edit');
   }
   
   
}
