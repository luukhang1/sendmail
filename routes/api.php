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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::post('/site/create-link', 'Admin\LinkController@createLinkAjax')->name('site.create-link');
Route::post('/site/payment-method/del', 'Admin\PaymentController@delpayment')->name('site.del-payment');
Route::get('/getlink', 'Admin\LinkController@getLinkAjax')->name('site.getlink');
Route::post('/site/submit', 'Site\SiteController@submit')->name('site.submit');

