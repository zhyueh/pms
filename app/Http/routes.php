<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'Auth\AuthController@getLogin');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::controller('user', 'UserController');
Route::controller('home', 'Home\HomeController');

Route::controller('project/project', 'Project\ProjectController');
Route::controller('project/version', 'Project\VersionController');
Route::controller('project/module', 'Project\ModuleController');
Route::controller('project/team', 'Project\TeamController');
Route::controller('project/story', 'Project\StoryController');
Route::controller('project/storycomment', 'Project\StoryCommentController');
Route::controller('project/devplan', 'Project\DevPlanController');
Route::controller('project/testcase', 'Project\TestCaseController');
Route::controller('project/testplan', 'Project\TestPlanController');
Route::controller('project/bug', 'Project\BugController');

Route::controller('schedule', 'Schedule\ScheduleController');
Route::controller('meeting', 'Meeting\MeetingController');
Route::controller('weeklyreport', 'WeeklyReport\WeeklyReportController');
Route::controller('organization', 'Organization\OrganizationController');

Route::controller('setting/role', 'Setting\RoleController');
Route::controller('setting/menu', 'Setting\MenuController');
Route::controller('setting/user', 'Setting\UserController');
Route::controller('setting/enum', 'Setting\EnumController');
Route::controller('setting/route', 'Setting\RouteController');
