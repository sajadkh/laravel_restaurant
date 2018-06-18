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


//route for authentication users

Route::post('/sign_in','Authentication@sign_in');

Route::post('/sign_up','Authentication@sign_up');

Route::get('/log_out','Authentication@log_out');


//-------------------------------------------------
//route for tables

Route::post('/create_tables','Restaurant@create_tables');

Route::get('/not_reserved_tables','Restaurant@not_reserved');

Route::post('/reserve_table','Restaurant@reserve_table');

Route::post('/de_reserve_table','Restaurant@de_reserve_table');