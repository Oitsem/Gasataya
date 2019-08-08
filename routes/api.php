<?php

use App\Events\TestEvent;

// Auth
Route::post('/auth/login', 'AuthController@apiLogin');
Route::post('/auth/logout', 'AuthController@apiLogout')->name('logout');
Route::get('/auth/user', 'AuthController@user');


Route::group(['middleware' => ['api']], function () {
    // Burials
    Route::match(['put', 'patch'], '/burials/{burial}/restore', 'BurialsController@restore');
    Route::delete('/burials/{burial}/force-delete', 'BurialsController@forceDestroy');
    Route::get('/burials/search', 'BurialsController@search');
    Route::resource('burials', 'BurialsController', [
        'only' => [
            'index', 'store', 'show', 'update', 'destroy'
        ]
    ]);

    // CHED Scholars
    Route::match(['put', 'patch'], '/ched-scholars/{chedScholar}/restore', 'ChedScholarsController@restore');
    Route::delete('/ched-scholars/{chedScholar}/force-delete', 'ChedScholarsController@forceDestroy');
    Route::get('/ched-scholars/search', 'ChedScholarsController@search');
    Route::resource('ched-scholars', 'ChedScholarsController', [
        'only' => [
            'index', 'store', 'show', 'update', 'destroy'
        ]
    ]);

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
    Route::get('/persons/get-barangays', 'PersonsController@getBarangays');
    Route::resource('persons', 'PersonsController', [
        'only' => [
            'index', 'store', 'show', 'update', 'destroy'
        ]
    ]);

    // Queues
    Route::post('/queues', 'QueuesController@store');
    Route::get('/queues/{type?}', 'QueuesController@index');
    Route::get('/queues/{type}/{queue}', 'QueuesController@show');

    Route::get('/', function () {
        /*event(new TestEvent('POTA HAHAHA'));*/

        $http = new \GuzzleHttp\Client(['verify' => false ]);
        $url  = 'https://fcm.googleapis.com/fcm/send';

        $body = [
            'collapse_key' => 'type_a',
            'data' => [
                'phone' => '+639077062927',
                'message' => 'Gether',
                'sim' => 1
            ],
            'to' => 'dZ0fvV3igzE:APA91bERRum8WcDOYPW3w1KGxnIIZL9YKfllS1XvhmEXa37-N4LFt2MViWg0MH5OssJSjkqXwvcI7jDhdO5KgBEFEPCxH9erw0Qtr79t7hyZtHKSGFS-kGaxSldSXQ3s1o01LW00Hj4k'
        ];

        try {
            $response = $http->post($url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'key=AAAAxSfAv0Y:APA91bHwLwZviUy9153u6cRHWhFERdIPizIF5uWFjM-jmQoqFzNQTNyqtr3x81XkMQW4AE9mzXPoB3kvq_Y-jliEbigWZbkuhLhhKQOQCnzoIJF36XsGOLhI98tlTyAMtTrrm1O_Tmcg'
                ],
                'body' => json_encode($body)
            ]);

            return json_decode((string) $response->getBody(), true);
        } catch (Exception $exception) {
            if ($exception->getCode() == 400) {
                return response()->json(
                    'Invalid Request. Please enter a username or a password.',
                    $exception->getCode()
                );
            } elseif ($exception->getCode() == 401) {
                return response()->json(
                    'Your credentials are incorrect Please try again.',
                    $exception->getCode()
                );
            }

            return response()->json(
                'Something went wrong on the server.',
                $exception->getCode()
            );
        }
    });
});
