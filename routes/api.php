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

/*
 * Since the route does not use a controller and using closure unable to prepare route [api/user] for serialization.
 * When needs to add the route, use a controller.
*/
//Route::middleware('auth:api')->get('/user', static function (Request $request) {
//    return $request->user();
//});
