<?php

use App\Http\Controllers\Apps\AppPageController;
use App\Http\Controllers\Website\PageController;
use App\Http\Controllers\Soft\PlanController;
use Illuminate\Support\Facades\Route;

  Route::group(['prefix' => 'plans', 'as' => 'plans.', 'middleware' => 'softAccess'], function () {
        Route::get('/{id}/{title}', [PlanController::class, 'plan'])->name('index');
        Route::get('/process-transaction/{id}/{price}', [PlanController::class, 'processTransaction'])->name('process-transaction');
        Route::get('/success-transaction', [PlanController::class, 'successTransaction'])->name('successTransaction');
        Route::get('/cancel-transaction', [PlanController::class, 'cancelTransaction'])->name('cancelTransaction');
    });
Route::group(['prefix'=>'apps','as'=>'Apps.', 'middleware'=>'onlyLogins'], function(){
    Route::get('/', [AppPageController::class, 'index'])->name('index');
    Route::get('/transfers', [AppPageController::class, 'transfers'])->name('transfers');
    Route::get('/newtransfers', [AppPageController::class, 'newtransfers'])->name('newtransfers');
    Route::get('/new_transfers/{slug}', [AppPageController::class, 'newtransfers_slug'])->name('new_transfers');
	  Route::get('/pricings', [AppPageController::class, 'pricingPage'])->name('pricings');
	  Route::get('/nits-history', [AppPageController::class, 'nitshistory'])->name('nitshistory');
	  Route::get('/nits-list-history', [AppPageController::class, 'nits_list_history'])->name('nits_list_history');
	  Route::get('/mynits', [AppPageController::class, 'mynits'])->name('mynits');
	  Route::get('/connections/{apps}', [AppPageController::class, 'connection_apps'])->name('connection_apps');
	  Route::get('/connections_data/{apps}', [AppPageController::class, 'connections_data'])->name('connections_data');
	
    Route::get('/{first}/', [AppPageController::class, 'oneAppSelected'])->name('oneAppSelected');
    Route::get('/{first}/{second}', [AppPageController::class, 'twoAppsSelected'])->name('twoAppsSelected');
    Route::get('/{first}/{second}/{third}', [AppPageController::class, 'threeAppsSelected'])->name('threeAppsSelected');
});
Route::group(['prefix'=>'zaps','as'=>'Apps.', 'middleware'=>'onlyLogins'], function(){
    Route::get('/', [AppPageController::class, 'zaps'])->name('zaps');
    Route::get('/zaps/details/{id}/{type}', [AppPageController::class, 'zapsDetails'])->name('zapsDetails');
});
