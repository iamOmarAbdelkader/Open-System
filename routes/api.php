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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// apply validation
Route::post('validate', 'ValidationController@validation')->name('validate');
Route::post('items-in-the-store', 'ItemsInStoreController@index')->name('api.get-items-in-the-store');
Route::post('get-orders', 'GetOrdersController@index')->name('api.get-orders');
Route::post('employee-attendance', 'EmployeeAttendanceController@index')->name('api.employee-attendance');

Route::post('employee-loan', 'EmployeeLoanController@index')->name('api.employee-loan');
Route::post('reposites', 'RepositesController@index')->name('api.reposites');

Route::post('attendance', 'AttendanceController@store')->name('api.attendance-store');
Route::delete('attendance', 'AttendanceController@destroy')->name('api.attendance-destroy');