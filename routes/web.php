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
//    return "fuck you";
    return view('auth/login');
});

/////////////////////// Start of Authentication routes /////////////////////////////////////////
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
/////////////////////// End of Authentication routes ///////////////////////////////////////////
/////////////////////// Strat of Resource Routes ///////////////////////////////////////////////
Route::resource('branch','branchController');
Route::resource('department','departmentController');
Route::resource('doctor','doctorController');
Route::resource('test','testController');
Route::resource('parameter','parameterController');
Route::resource('material','materialController');
Route::resource('user','userController');
Route::resource('pacient','pacientController');
Route::resource('pacienttest','pacienttestController');
Route::resource('role','RoleController');
Route::resource('permission','PermissionController');
Route::resource('testresult','testresultController');
////////////////////// End of Resourec routes/////////////////////////////////
///
///
////////////////////// report routes routes/////////////////////////////////

Route::get('today-report','ReportController@showTodayReport')->name('today.report');
Route::get('tabular-report/form','ReportController@TabularForm')->name('tabular.form');
Route::post('tabular-report','ReportController@showTabularForm')->name('tabular.show');
Route::get('salesummary/form','ReportController@ssForm')->name('ss.form');
Route::post('salesummary','ReportController@showssForm')->name('ss.show');
Route::get('save-result/{id}','testresultController@saveResult')->name('save.result');
Route::get('editpatient/{id}','pacientController@edit_pacient')->name('edit.pacient');
Route::get('show-All-Patients','testresultController@showAllPacientlist')->name('showAllPacientlist');
Route::get('detail/{id}','testresultController@printBill')->name('print_result');
Route::get('bill/{id}','pacientController@printBill')->name('print_bill');
Route::get('save-test-result/{test_id}/{user_id}','testresultController@saveResult')->name('save.test.result');
Route::post('addNewQuantity',['as'=>'addNewQuantity','uses'=>'materialController@addQuantity']);

Route::get('less',['as'=>'lessmaterial','uses'=>'materialController@less']);
