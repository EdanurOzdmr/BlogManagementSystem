<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', function () {
    return view('welcome');
});
Route::namespace('Frontend')->group(function () {
    Route::get('/', 'DefaultController@index')->name('home.index');

    //BLOG
    Route::get('/blog', 'BlogController@index')->name('blog.Index');
    Route::get('/blog/{slug}', 'BlogController@detail')->name('blog.detail');
    //PAGE
    Route::get('/page/{slug}', 'PageController@detail')->name('page.detail');
    //CONTACT
    Route::get('/contact', 'DefaultController@contact')->name('contact.detail');
    Route::post('/contact', 'DefaultController@sendMail');


});
Route::get('nedmin', 'Backend\DefaultController@index')->name('nedmin.Index');


Route::namespace('Backend')->group(function () {
    Route::prefix('nedmin/settings')->group(function () {
        Route::get('/', 'SettingsController@index')->name('settings.Index');
        Route::post('', 'SettingsController@sortable')->name('settings.Sortable');
        Route::get('/delete/{id}', 'SettingsController@destroy')->name('settings.destroy');
        Route::get('/edit/{id}', 'SettingsController@edit')->name('settings.Edit');
        Route::post('/{id}', 'SettingsController@update')->name('settings.Update');
    });
});
Route::namespace('Backend')->group(function () {
    Route::prefix('nedmin')->group(function () {
        Route::get('/dashboard', 'DefaultController@index')->name('nedmin.Index')->middleware('admin');
        Route::get('/', 'DefaultController@login')->name('nedmin.login')->middleware('CheckLogin');
        Route::get('/logout', 'DefaultController@logout')->name('nedmin.logout');
        Route::post('/login', 'DefaultController@authenticate')->name('nedmin.Authenticate');

    });

});


Route::namespace('Backend')->group(function () {
    Route::prefix('nedmin')->group(function () {
        Route::middleware(['admin'])->group(function () {
            //BLOG
            Route::resource('blog', 'BlogController');
            Route::post('/blog/sortable', 'BlogController@sortable')->name('blogs.Sortable');
            //PAGE
            Route::resource('page', 'PageController');
            Route::post('/page/sortable', 'PageController@sortable')->name('pages.Sortable');
            //SLİDER
            Route::resource('slider', 'SliderController');
            Route::post('/slider/sortable', 'SliderController@sortable')->name('sliders.Sortable');
            //USER
            Route::resource('user', 'UserController');
            Route::post('/user/sortable', 'UserController@sortable')->name('user.Sortable');

        });

    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
