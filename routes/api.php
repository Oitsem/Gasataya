<?php

// Auth
Route::post('/auth/login', 'AuthController@apiLogin');
Route::post('/auth/logout', 'AuthController@apiLogout')->name('logout');
Route::get('/auth/user', 'AuthController@user');


Route::group(['middleware' => ['api']], function () {
    // Medical Assistance
    Route::match(['put', 'patch'], '/medical-assistance/{medical-assistance}/restore', 'MedicalAssistanceController@restore');
    Route::delete('/medical-assistance/{medical-assistance}/force-delete', 'MedicalAssistanceController@forceDestroy');
    Route::get('/medical-assistance/search', 'MedicalAssistanceController@search');
    Route::resource('medical-assistance', 'MedicalAssistanceController', [
        'only' => [
            'index', 'store', 'show', 'update', 'destroy'
        ]
    ]);

    // Users
    Route::match(['put', 'patch'], '/users/{user}/restore', 'UsersController@restore');
    Route::delete('/users/{user}/force-delete', 'UsersController@forceDestroy');
    Route::resource('/users', 'UsersController', [
        'only' => [
            'index', 'store', 'show', 'update', 'destroy'
        ]
    ]);

    // Persons
    Route::match(['put', 'patch'], '/persons/{person}/restore', 'PersonsController@restore');
    Route::delete('/persons/{person}/force-delete', 'PersonsController@forceDestroy');
    Route::get('/persons/search', 'PersonsController@search');
    Route::resource('persons', 'PersonsController', [
        'only' => [
            'index', 'store', 'show', 'update', 'destroy'
        ]
    ]);

    // Queues
    Route::post('/queues', 'QueuesController@store');
    Route::get('/queues/{type?}', 'QueuesController@index');
    Route::get('/queues/{type}/{queue}', 'QueuesController@show');
});
