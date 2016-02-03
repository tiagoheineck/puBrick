<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Profile;
use App\User;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});


Route::group(['middleware' => 'web'], function () {
    Route::get('auth/facebook', 'Auth\AuthController@redirectToProvider');
    Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderCallback');
    Route::auth();
    Route::get('/', 'HomeController@index');

});

Route::group(['middleware' => ['web','auth']], function() {
    Route::get('/new', 'ObraController@getForm');
    Route::post('/new',['as'=>'obra.save' , 'uses'=>'ObraController@save']);
    Route::post('/comments','ComentarioController@send');
    Route::get('/near/{latitude}/{longitude}','ObraController@proximas');
    Route::get('/view/{id}','ObraController@porId');
    Route::get('/favorite/{id}','FavoritoController@set');
    Route::get('/favorite','FavoritoController@lista');
    Route::get('/denounce/{obraId}/{comentarioId?}','DenunciaController@getForm');
    Route::post('/denounce','DenunciaController@save');
});


Route::get('login/fb', function() {
    $facebook = new Facebook(Config::get('facebook'));
    $params = array(
        'redirect_uri' => url('/login/fb/callback'),
        'scope' => 'email',
    );
    return Redirect::to($facebook->getLoginUrl($params));
});

Route::get('login/fb/callback', function() {
    $code = \Illuminate\Support\Facades\Input::get('code');
    if (strlen($code) == 0) return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');

    $facebook = new Facebook(Config::get('facebook'));
    $uid = $facebook->getUser();

    if ($uid == 0) return Redirect::to('/')->with('message', 'There was an error');

    $me = $facebook->api('/me?fields=id,name,email,picture');

    $profile = Profile::whereUid($uid)->first();
    if (empty($profile)) {

         $user = new User();

        $user->name = $me['name'];
        $user->email = $me['email'];
        $user->photo = $me['picture']['data']['url'];
        $user->save();

        $profile = new Profile();
        $profile->uid = $uid;
        $profile->username = $me['email'];
        $profile = $user->profiles()->save($profile);
    }
    $profile->access_token = $facebook->getAccessToken();
    $profile->save();

    Auth::login($profile->user);
    return redirect('/');
});