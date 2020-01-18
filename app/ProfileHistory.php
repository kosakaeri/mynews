<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileHistory extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required',
        'gender' => 'required',
        'hobby' => 'required',
        'introduction' => 'required',
        
    );
    
    // Newsモデルに関連付けを行う
    public function profile_histories()
    {
      return $this->hasMany('App\ProfileHistory');

    }    
}