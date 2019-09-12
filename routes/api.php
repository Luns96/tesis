<?php

use Illuminate\Http\Request;

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

Route::get('user/index', 'UserController@userIndex');
Route::get('user/{id}', 'UserController@user');
Route::put('user/reset/{id}', 'UserController@resetPassword');
Route::get('user/project/{id}', 'UserController@projects');
Route::get('type/index', 'TypeController@typeIndex');
Route::put('type/destroy/{id}', 'TypeController@destroy');
Route::put('type/update/{id}', 'TypeController@update');
Route::post('type', 'TypeController@store');
Route::get('type/index/adm', 'TypeController@typeAdm');
Route::get('company/index', 'CompanyController@companyIndex');
Route::get('company/index/adm', 'CompanyController@companyAdm');
Route::get('company/index/gerente', 'CompanyController@companyGerente');
Route::put('company/destroy/{id}', 'CompanyController@destroy');
Route::put('company/update/{id}', 'CompanyController@update');
Route::post('company', 'CompanyController@store');
Route::get('roles/index', 'UserController@roles');
Route::post('user', 'UserController@store');
Route::put('user/update/{id}', 'UserController@update');
Route::put('user/destroy/{id}', 'UserController@destroy');
// Route::get('project/index', 'ProjectController@projectIndex');
Route::post('project', 'ProjectController@store');
Route::put('project/update/{id}', 'ProjectController@update');
Route::delete('project/destroy/{id}', 'ProjectController@destroy');
Route::get('project/info/{id}', 'ProjectController@projectList');
// Route::get('goals/index/{id}', 'ProjectController@goalsIndex');
// Route::post('goal', 'GoalsController@store');
// Route::put('goal/update/{id}', 'GoalsController@update');
// Route::delete('goal/destroy/{id}', 'GoalsController@destroy');
// Route::get('goals/info/{id}', 'GoalsController@goalList');
Route::get('objective/index/{id}', 'ProjectController@objectiveIndex');
Route::post('objective', 'ObjectiveController@store');
Route::put('objective/update/{id}', 'ObjectiveController@update');
Route::delete('objective/destroy/{id}', 'ObjectiveController@destroy');
Route::get('objective/info/{id}', 'ObjectiveController@objectiveList');
// Route::get('objects/index/{id}', 'ObjectiveController@objectsIndex');
Route::get('goal/index/{id}', 'ObjectiveController@goalIndex');
Route::post('goal', 'GoalController@store');
Route::delete('goal/destroy/{id}', 'GoalController@destroy');
Route::put('goal/update/{id}', 'GoalController@update');
Route::get('goal/show/{id}', 'GoalController@show');
Route::get('goal/info/{id}', 'GoalController@goalList');
// Route::post('object', 'ObjectController@store');
// Route::delete('object/destroy/{id}', 'ObjectController@destroy');
// Route::put('object/update/{id}', 'ObjectController@update');
// Route::get('object/show/{id}', 'ObjectController@show');
// Route::get('object/info/{id}', 'ObjectController@objectList');
Route::get('activity/index/{id}', 'GoalController@activityIndex');
Route::post('activity', 'ActivityController@store');
Route::put('activity/update/{id}', 'ActivityController@update');
Route::delete('activity/destroy/{id}', 'ActivityController@destroy');
Route::put('activity/complete/{id}', 'ActivityController@complete');

