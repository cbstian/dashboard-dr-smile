<?php

use Illuminate\Support\Facades\Route;

$landingDiaMadre = function(){
    Route::get('/','Landing\LandingController@diaDeLaMadre');
    Route::post('descargarGiftcard','Landing\LandingController@descargarGiftcard')->name('descargarGiftcard');
};

if (config('app.env') == 'production') {
    Route::domain('diadelamadre.drsmile.cl')->group($landingDiaMadre);
    Route::domain('diadelamama.drsmile.cl')->group($landingDiaMadre);
} else {
    Route::domain('mama.dev.drsmile.local')->group($landingDiaMadre);
}

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

Route::prefix('landing')->group(function () {

    Route::get('limpiezaprofunda','Landing\LandingController@limpiezaProfunda');
    Route::get('ortodoncia','Landing\LandingController@ortodoncia');
    Route::get('odontopediatria','Landing\LandingController@odontopediatria');
    Route::get('esteticadental','Landing\LandingController@esteticadental');
    Route::get('implantologia','Landing\LandingController@implantologia');
    Route::get('botox2','Landing\LandingController@botox2');
    Route::get('botox3','Landing\LandingController@botox3');

    Route::post('store','Landing\LandingController@store');

});
