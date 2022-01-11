<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);
Route::redirect('/', '/login');

Route::post('form/store/public','FormController@storePublic');

Route::middleware(['auth','verified'])->group(function () {

    Route::get('forms','FormController@index');
    Route::post('forms/datatable','FormController@datatable');
    Route::post('forms/export','FormController@export');

});
