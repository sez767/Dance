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

use Faker\Provider\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Route as RouteAlias;

Route::redirect('/','/admin');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/teachers/uploadfile','UploadfileController@index');
Route::get('/admin/news/uploadfile','UploadfileController@index');

Route::post('uploadfile','UploadfileController@upload');
#Admin groups routs
Route::get('/admin','Admin\\AdminHomeController@index')->name('admin.home');
Route::get('/admin/changeschool/{id}','Admin\\AdminHomeController@changeSchool');
Route::resource('admin/users', 'Admin\\UsersController');
Route::resource('admin/schools', 'Admin\\SchoolsController');
Route::resource('admin/categories', 'Admin\\CategoryController');
Route::resource('admin/clothes', 'Admin\\ClothesController');
Route::resource('admin/dances', 'Admin\\DanceController');
Route::resource('admin/teachers', 'Admin\\TeacherController');
Route::resource('admin/news', 'Admin\\NewsController');
Route::resource('admin/events', 'Admin\\EventController');
Route::resource('admin/competitions', 'Admin\\CompetitionController');
Route::resource('admin/conquers', 'Admin\\ConquerController');
Route::resource('admin/parties', 'Admin\\PartyController');
Route::resource('admin/masterclasses', 'Admin\\MasterclassesController');
Route::resource('admin/halls', 'Admin\\HallController');
Route::resource('admin/choreographers', 'Admin\\ChoreographerController');
Route::resource('admin/dancepartners', 'Admin\\DancepartnerController');
Route::resource('admin/feedbacks', 'Admin\\FeedbackController'); //feedbacks
Route::resource('admin/inventories', 'Admin\\InventoryController');
Route::post('admin/contacts', 'Admin\\ContactController');
Route::get('subcategories/{id}', 'Admin\\CategoryController@findSubcategory');
Route::get('invite', 'Admin\\InviteController@invite')->name('invite');
Route::post('invite', 'Admin\\InviteController@process')->name('process');
// {token} is a required parameter that will be exposed to us in the controller method
Route::get('accept/{token}', 'Admin\\InviteController@accept')->name('accept');

Route::get('admin/subcategories/create/{id}', 'Admin\\SubcategoryController@create');
Route::post('admin/subcategories/create/{id}', 'Admin\\SubcategoryController@store');
Route::get('/admin/subcategories/edit/{sid}', 'Admin\\SubcategoryController@edit');
Route::patch('/admin/subcategories/edit/{sid}', 'Admin\\SubcategoryController@update');
Route::delete('admin/subcategories/{sid}', 'Admin\\SubcategoryController@destroy');
#End Admin
Route::group(['middleware' => ['web']], function() {
    Route::get('storage/storage_inner_folder_fullpath/{filename}', function ($filename) {
        return Image::make(storage_path() . '/storage_inner_folder_fullpath/' . $filename)->response();
    });
});
Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});
Route::get('/admin/userToSchool','UsersToSchoolController@index');

