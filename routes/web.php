<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);
Route::redirect('/', '/login');

Route::post('form/store/public','FormController@storePublic');

Route::middleware(['auth','verified'])->group(function () {

    Route::get('dashboard','DashboardController@index');
    Route::get('forms','FormController@index');
    Route::post('forms/datatable','FormController@datatable');
    Route::post('forms/export','FormController@export');
    Route::post('forms/create','FormController@create');
    Route::post('forms/edit','FormController@edit');
    Route::post('forms/store','FormController@store');
    Route::post('forms/update','FormController@update');
    Route::post('forms/destroy','FormController@destroy');
    Route::post('location/communes','LocationController@getCommunes');
    Route::get('analisisVisitas','AnalisisController@umami');

    Route::post('dashboard/grafico1','DashboardController@grafico1');
    Route::post('dashboard/grafico2','DashboardController@grafico2');
    Route::post('dashboard/grafico3','DashboardController@grafico3');
    Route::post('dashboard/grafico4','DashboardController@grafico4');

});
