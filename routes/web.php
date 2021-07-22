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

Route::match(array('GET','POST'),'/', 'App\Http\Controllers\User\UserController@index');
Route::match(array('GET','POST'),'/student_login', 'App\Http\Controllers\User\UserController@index');
Route::match(array('GET','POST'),'track', 'App\Http\Controllers\User\UserController@track_by_id');
Route::post('login_check', 'App\Http\Controllers\User\UserController@login_check');
Route::get('user/logout', 'App\Http\Controllers\User\UserController@logout');
Route::match(array('GET','POST'),'registration', 'App\Http\Controllers\User\UserController@registration');
Route::post('register_store', 'App\Http\Controllers\User\UserController@register_store');
Route::get('dashboard', 'App\Http\Controllers\User\UserController@dashboard');

Route::get('documents', 'App\Http\Controllers\User\UserController@documents');
Route::post('documents_update', 'App\Http\Controllers\User\UserController@documents_update');

Route::get('offer_letter', 'App\Http\Controllers\User\UserController@offer_letter');
Route::get('offer_letter_download/{id}', 'App\Http\Controllers\User\UserController@offer_letter_download');
Route::get('invoice', 'App\Http\Controllers\User\UserController@invoice');
Route::get('invoice/download/{id}', 'App\Http\Controllers\User\UserController@invoice_download');

Route::get('notification', 'App\Http\Controllers\User\UserController@notification');
Route::get('notification_close/{id}', 'App\Http\Controllers\User\UserController@notification_close');

Route::get('queries', 'App\Http\Controllers\User\UserController@queries');
Route::post('queries_store', 'App\Http\Controllers\User\UserController@queries_store');

Route::get('change_password', 'App\Http\Controllers\User\UserController@change_password');
Route::post('change_password_post', 'App\Http\Controllers\User\UserController@change_password_post');

Route::get('profile', 'App\Http\Controllers\User\UserController@profile');
Route::post('profile_update', 'App\Http\Controllers\User\UserController@profile_update');

Route::get('forget_password', 'App\Http\Controllers\User\UserController@forget_password');
Route::post('forget_password_post', 'App\Http\Controllers\User\UserController@forget_password_post');
Route::get('reset_password/{otp}', 'App\Http\Controllers\User\UserController@reset_password');
Route::post('reset_password_post', 'App\Http\Controllers\User\UserController@reset_password_post');

//ADMIN
Route::get('admin/', 'App\Http\Controllers\Admin\AdminController@index')->name("admin.login");

Route::get('admin/login', 'App\Http\Controllers\Admin\AdminController@login');
Route::post('admin/check_login', 'App\Http\Controllers\Admin\AdminController@check_login')->name('admin.check_login');

Route::get('admin/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();
Route::get('admin/dashboard', 'App\Http\Controllers\Admin\AdminController@dashboard');
Route::match(array('GET','POST'),'admin/profile', 'App\Http\Controllers\Admin\AdminController@profile');
Route::match(array('GET','POST'),'admin/change_password', 'App\Http\Controllers\Admin\AdminController@change_password');
Route::resource('admin/setting', 'App\Http\Controllers\Admin\SettingController');
Route::resource('admin/profile', 'App\Http\Controllers\Admin\ProfileController');

Route::resource('admin/admin_user', 'App\Http\Controllers\Admin\AdminUserController')->names('admins');
Route::resource('admin/students', 'App\Http\Controllers\Admin\StudentController')->names('students');
Route::get('admin/students/university/{id}','App\Http\Controllers\Admin\StudentController@university');
Route::get('admin/students/delete_university/{id}','App\Http\Controllers\Admin\StudentController@delete_university');

Route::post('admin/students/ajax','App\Http\Controllers\Admin\StudentController@ajax');

Route::match(array('GET','POST'),'admin/query/reply/{id}', 'App\Http\Controllers\Admin\QueryController@reply');
Route::match(array('GET','POST'),'admin/query/notification/', 'App\Http\Controllers\Admin\QueryController@notification');
Route::resource('admin/query', 'App\Http\Controllers\Admin\QueryController')->names('query');

Route::get('admin/query/admin_notification/{id}', 'App\Http\Controllers\Admin\QueryController@admin_notification');

Route::get('admin/invoice/{id}','App\Http\Controllers\Admin\InvoiceController@index');
Route::get('admin/invoice/create/{student_id}','App\Http\Controllers\Admin\InvoiceController@create');
Route::post('admin/invoice/store/{student_id}','App\Http\Controllers\Admin\InvoiceController@store');
Route::get('admin/invoice/{invoice_id}/edit/{student_id}','App\Http\Controllers\Admin\InvoiceController@edit');
Route::post('admin/invoice/{invoice_id}/update/{student_id}','App\Http\Controllers\Admin\InvoiceController@update');
Route::get('admin/invoice/show/{invoice_id}','App\Http\Controllers\Admin\InvoiceController@show');
Route::get('admin/invoice/invoice_mail/{invoice_id}','App\Http\Controllers\Admin\InvoiceController@send_invoice_mail');

Route::delete('admin/invoice/delete/{invoice_id}','App\Http\Controllers\Admin\InvoiceController@delete');



//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});
