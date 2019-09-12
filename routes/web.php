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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();


Route::middleware(['auth'])->group(function () {
    Route::get('user/account', 'UserController@accountInfo');
    Route::get('user/account/rol', 'UserController@accountInfoRol');
    Route::get('project/index', 'ProjectController@projectIndex');
    Route::get('project', 'ProjectController@index')->name('project.index');
    // Route::get('goals/{id}', 'ProjectController@indexGoal');
    // Route::get('goals', 'ProjectController@indexGoallist')->name('goals.index');
    Route::get('objective/{id}', 'ProjectController@indexObjective');
    // Route::get('objective', 'ProjectController@indexObjectivelist')->name('objective.index');
    Route::get('goal/{id}', 'ObjectiveController@indexGoal');
    Route::get('activity/{id}', 'GoalController@index')->name('activity.index');
    // Route::get('object/{id}', 'GoalsController@indexObject');
    Route::get('user/reset', 'UserController@reset')->name('auth.reset');
    Route::group(['middleware' => ['role:Administrador']], function () {
        Route::get('user', 'UserController@index')->name('user.index');
        Route::get('type', 'TypeController@index')->name('type.index');
        Route::get('company', 'CompanyController@index')->name('company.index');
    });
    Route::group(['middleware' => ['role:SuperGerente']], function () {
        Route::get('userGerente', 'UserController@indexGerente')->name('user.indexGerente');
        Route::get('userGerente/index', 'UserController@userIndexGerente');
    });
});
// Route::group(['middleware' => ['permission:read-user'],], function () {
//     Route::group(['middleware' => ['permission:create-user']], function () {
       
//     });
//     Route::group(['middleware' => ['role:admin']], function () {
        
//     });
// });
Route::get('/home', 'HomeController@index')->name('home');



// Route::get('user/id', 'UserController@GerenteIndex');






