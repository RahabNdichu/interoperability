<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.kpa-applications.index')->with('status', session('status'));
    }

    return redirect()->route('admin.kpa-applications.index');
});

Auth::routes();
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Statuses
    Route::delete('statuses/destroy', 'StatusesController@massDestroy')->name('statuses.massDestroy');
    Route::resource('statuses', 'StatusesController');

    // kpa Applications
    Route::delete('kpa-applications/destroy', 'KpaApplicationsController@massDestroy')->name('kpa-applications.massDestroy');
    Route::get('kpa-applications/{kpa_application}/analyze', 'KpaApplicationsController@showAnalyze')->name('kpa-applications.showAnalyze');
    Route::post('kpa-applications/{kpa_application}/analyze', 'KpaApplicationsController@analyze')->name('kpa-applications.analyze');
    Route::get('kpa-applications/{kpa_application}/send', 'KpaApplicationsController@showSend')->name('kpa-applications.showSend');
    Route::post('kpa-applications/{kpa_application}/send', 'KpaApplicationsController@send')->name('kpa-applications.send');
    Route::resource('kpa-applications', 'KpaApplicationsController');
    // nssf
    Route::delete('nssf/destroy', 'NSSFApplicationsController@massDestroy')->name('nssf-applications.massDestroy');
      Route::resource('nssf', 'NSSFApplicationsController');


    // Comments
    Route::delete('comments/destroy', 'CommentsController@massDestroy')->name('comments.massDestroy');
    Route::resource('comments', 'CommentsController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }
});
