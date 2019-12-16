<?php


Route::get('/', function () {
      return view('welcome');
});

Route::group(['prefix'=>'admin'],function() {
  Route::get('news/create', 'Admin\NewsController@add');
});

//課題３　「http://XXXXXX.jp/XXX というアクセスが来たときに、 AAAControllerのbbbというAction に渡すRoutingの設定」を書いてみてください。

//【応用】 前章でAdmin/ProfileControllerを作成し、add Action, edit Actionを追加しました。web.phpを編集して、admin/profile/create にアクセスしたら ProfileController の add Action に、admin/profile/edit にアクセスしたら ProfileController の edit Action に割り当てるように設定してください。

Route::get('admin/profile/create','Admin\ProfileController@add')->middleware('auth');
Route::post('admin/profile/create','Admin\ProfileController@create')->middleware('auth');


Route::get('admin/profile/edit','Admin\ProfileController@edit')->middleware('auth');
Route::post('admin/profile/edit','Admin\ProfileController@update')->middleware('auth');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
     Route::get('news/create', 'Admin\NewsController@add');
     Route::post('news/create', 'Admin\NewsController@create');
});

