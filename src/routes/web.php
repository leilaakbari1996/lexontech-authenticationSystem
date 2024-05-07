<?php

use Illuminate\Support\Facades\Route;



Route::get('register','Lexontech\AuthenticationSystem\app\Http\Controllers\AuthenticationSystem\AuthController@register')->name('login');
Route::post('send-sms','Lexontech\AuthenticationSystem\app\Http\Controllers\AuthenticationSystem\AuthController@sendSMS');
Route::post('login','Lexontech\AuthenticationSystem\app\Http\Controllers\AuthenticationSystem\AuthController@login');


Route::middleware('auth:sanctum')->group(function (){
    Route::get('/logout','Lexontech\AuthenticationSystem\app\Http\Controllers\AuthenticationSystem\AuthController@logout');
});

