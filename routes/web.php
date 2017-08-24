<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//ログイン画面
Route::get('/login', [
    'as' => 'login',
    'uses' => 'UsersController@login'
]);

//メイン画面→ここで大体の処理を行うよ
Route::get("/",[
    "as"=>"index",
    "uses"=>"UsersController@index"
]);

Route::get('/auth/twitter', [
    'as' => 'auth.twitter.login',
    'uses' => 'Auth\SocialAuthController@redirectToProvider'
]);

Route::get('/auth/twitter/callback', [
    'as' => 'auth.twitter.callback',
    'uses' => 'Auth\SocialAuthController@handleProviderCallback'
]);

Route::get('/auth/twitter/logout', [
    'as' => 'auth.twitter.logout',
    'uses' => 'Auth\SocialAuthController@logout'
]);

Route::post("/books/register",[
    "as"=>"books.register",
    "uses"=>"BooksController@register"
]);

Route::post("books/show",[
    "as"=>"books.show",
    "uses"=>"BooksController@show"
]);

Route::post("books/delete",[
    "as"=>"books.delete",
    "uses"=>"BooksController@delete"
]);

Route::post("books/state",[
    "as"=>"books.state",
    "uses"=>"BooksController@state"
]);

Route::post("users/avatar", [
    "as" => "users.avatar",
    "uses" => "UsersController@avatar"
]);