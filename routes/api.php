<?php

// Auth
Route::post('/auth/login', 'AuthController@apiLogin');
Route::post('/auth/logout', 'AuthController@apiLogout')->name('logout');
Route::get('/auth/user', 'AuthController@user');


Route::group(['middleware' => ['auth:api']], function () {
    // Users
    Route::match(['put', 'patch'], 'users/{user}/restore', 'UsersController@restore');
    Route::delete('users/{user}/force-delete', 'UsersController@forceDestroy');
    Route::resource('users', 'UsersController', [
        'only' => [
            'index', 'store', 'show', 'update', 'destroy'
        ]
    ]);
});
