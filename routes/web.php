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
    return view('/auth/login');
});

// Route::get('/admin/employeelist', function () {
//     return view('admin.employeelist');
// });


Auth::routes();

Route::get('/home', 'AttendanceController@index')->name('home');

Route::post('/employees/store', 'EmployeeController@store')->name('store');
Route::post('/employees/update', 'EmployeeController@update')->name('update');
Route::post('/employees/destory', 'EmployeeController@destory')->name('delete');
// Route::get('/employees/destroy/{id}', ['uses' => 'EmployeeController@destroy']);
Route::resource('attendances', 'AttendanceController');
Route::resource('employees', 'EmployeeController');
Route::resource('employeeAttendances', 'EmployeeAttendanceController');
Route::post('/employeeAttendancesfilter','EmployeeAttendanceController@getFilter')->name('empattendaceFilter');

//for user 
Route::post('check', 'UserAuthController@check')->name('auth.check');
Route::post('login', 'UserAuthController@login');

//for hms
Route::get('/admin/attendancelist','AttendanceListController@index')->name('getAllList');
Route::post('/admin/attendancelistfilter','AttendanceListController@getFilter')->name('attendanceFilter');
Route::get('/admin/attendancelistrefresh','AttendanceListController@getRefresh');
// Route::get('/admin/attendancelistexport','ExportExcelController@exportExcel')->name('exportExcel');
Route::get('/employee/profile','ProfileController@showProfile')->name('employee.profile');
Route::post('/employee/addskill','ProfileController@addSkill');
Route::get('/employee/editprofile','ProfileController@showEditProfile');
Route::post('/employee/updatedata','ProfileController@updateProfile')->name('employee.updatedata');
Route::post('employee/editphoto','ProfileController@editPhoto');
Route::post('employee/editskill','ProfileController@editSkill');
Route::get('employee/attendancelog','EmployeeAttendanceController@index');