<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/v1/on-covid-19', 'CovidEstimatorController@covid19ImpactEstimator')->middleware('apilogger');
Route::get('/v1/on-covid-19/xml', 'CovidEstimatorController@covid19ImpactEstimatorXml')->middleware('apilogger');

Route::get('/v1/on-covid-19/json', 'CovidEstimatorController@covid19ImpactEstimatorJson')->middleware('apilogger');
Route::get('/v1/on-covid-19/logs', 'ApiLogController@index')->name("apilogs.index");


