<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

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

Route::get('/', function () {
    return view('app');
});

Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/rssfeeds', [NewsController::class, 'RssIndex'])->name('rssfeeds');
Route::post('/news/rssfeeds/save', [NewsController::class, 'RSSsave'])->name('rssfeeds.save');
Route::get('/scrape/rss/execute', [NewsController::class, 'Rss_Scrape'])->name('scrape.rss.execute');
