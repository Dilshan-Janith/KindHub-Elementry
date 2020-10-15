<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'class' => 'API\ClassController',
    'student' => 'API\StudentController',
    'teacher' => 'API\TeachersController'
    ]);

Route::get('get_teacher','Api\TeachersController@Teacher');
Route::get('get_class','Api\ClassController@Class');
