<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'isActief'])->group(function () {

    Route::get('/', function () {
        return view('app');
    });

    Route::get('/news', [NewsController::class, 'index'])->name('nieuws');
    Route::get('/news/rssfeeds', [NewsController::class, 'RssIndex'])->name('rssfeeds');
    Route::post('/news/rssfeeds/save', [NewsController::class, 'RSSsave'])->name('rssfeeds.save');
    Route::get('/scrape/rss/execute', [NewsController::class, 'Rss_Scrape'])->name('scrape.rss.execute');

    Route::get('/searchterms', [NewsController::class, 'SearchTermsIndex'])->name('search-terms-index');
    Route::post('/searchterms/save', [NewsController::class, 'SearchTermSave'])->name('search-terms-save');
    Route::post('/searchterms/update/{id}', [NewsController::class, 'SearchTermUpdate'])->name('search-terms-update');
    Route::get('/searchterms/delete/{id}', [NewsController::class, 'SearchTermDelete'])->name('search-terms-delete');
    Route::get('/searchresults/{id}', [NewsController::class, 'SearchResults'])->name('search-results');
//Route::get('/twitter', [NewsController::class, 'TwitterSearch'])->name('search-twitter');
});

Route::get('/login/azure', [AuthController::class, 'RedirectAzure'])->name('login.azure');
Route::get('/loginazure', [AuthController::class, 'AuthenticateAzure']);
