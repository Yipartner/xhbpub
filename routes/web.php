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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/article/list','ArticleController@showArticles');
Route::get('/article/{article_id}','ArticleController@showSingleArticle');
Route::middleware(['AdminCheck'])->group(function (){
Route::get('/admin/addnew','ArticleController@index');
Route::get('/admin/addtype','AdminController@typeIndex');
Route::get('/admin','AdminController@index');
Route::get('/admin/article','AdminController@showArticles');
Route::get('/admin/type','AdminController@showTypes');
Route::get('/admin/editarticle/{article_id}','AdminController@editArticle');
Route::post('/post/addnew','ArticleController@addNew');
Route::post('/post/updata','ArticleController@updata');
Route::post('/post/addtype','AdminController@addType');
Route::delete('/comment/{comment_id}','CommentController@delComment');
Route::delete('/article/{article_id}','ArticleController@delArticle');
Route::delete('/type/{article_id}','AdminController@delType');
});
Route::post('/post/addcomment','CommentController@addComment');
Route::get('/type/{type_id}','ArticleController@showArticlesByType');

