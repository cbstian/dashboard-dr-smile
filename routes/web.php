<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);
Route::redirect('/', '/login');

Route::post('form/store/public','FormController@storePublic');

Route::middleware(['auth','verified'])->group(function () {

    Route::get('forms','FormController@index');
    Route::post('forms/datatable','FormController@datatable');
    Route::post('forms/export','FormController@export');
    Route::post('forms/create','FormController@create');
    Route::post('forms/edit','FormController@edit');
    Route::post('forms/store','FormController@store');
    Route::post('forms/update','FormController@update');
    Route::post('location/communes','LocationController@getCommunes');
    Route::get('analisisVisitas','AnalisisController@umami');

});
