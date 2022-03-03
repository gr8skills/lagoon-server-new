<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Auth::routes(['register' => false]);
Route::get('/unauthorized', [App\Http\Controllers\HomeController::class, 'unauthorizedView'])->name('unauthorized');

Route::middleware('auth')->group(function () {
//    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::redirect('/', '/pages/about')->name('home');

    Route::prefix('pages')->group(function () {
        Route::get('/about', [\App\Http\Controllers\PageController::class, 'about'])->name('about');
        Route::get('/academics', [\App\Http\Controllers\PageController::class, 'academics'])->name('academics');
        Route::get('/admission', [\App\Http\Controllers\PageController::class, 'admission'])->name('admission');
        Route::get('/media', [\App\Http\Controllers\PageController::class, 'media'])->name('media');
        Route::get('/home-page', [\App\Http\Controllers\PageController::class, 'homepage'])->name('home-page');
        Route::get('/facilities', [\App\Http\Controllers\PageController::class, 'facilities'])->name('facilities');

        Route::get('/edit/{slug}', [\App\Http\Controllers\PageController::class, 'editPage'])->name('page-edit');
        Route::post('/edit/{slug}', [\App\Http\Controllers\PageController::class, 'updatePage']);
        Route::delete('/delete/{slug}', [\App\Http\Controllers\PageController::class, 'deletePage'])->name('page-delete');
    });

    Route::get('/news/{slug}/edit', [\App\Http\Controllers\NewsController::class, 'edit'])->name('news-edit');
    Route::post('/news/{slug}/edit', [\App\Http\Controllers\NewsController::class, 'update']);
    Route::get('/news/{slug}/delete', [\App\Http\Controllers\NewsController::class, 'destroy'])->name('news-delete');
    Route::get('/news/create', [\App\Http\Controllers\NewsController::class, 'create'])->name('news-create');
    Route::post('/news', [\App\Http\Controllers\NewsController::class, 'store'])->name('store-news');
    Route::get('/news', [\App\Http\Controllers\NewsController::class, 'index'])->name('news');
    Route::get('/articles', [\App\Http\Controllers\ArticleController::class, 'index'])->name('article');
    Route::get('/site-setting', [\App\Http\Controllers\SiteSettingController::class, 'index'])->name('site-setting');
    Route::post('/site-setting/update-name', [\App\Http\Controllers\SiteSettingController::class, 'updateSiteName'])->name('site-setting-update-name');
    Route::post('/site-setting/update-logo', [\App\Http\Controllers\SiteSettingController::class, 'updateSiteLogo'])->name('site-setting-update-logo');
    Route::get('/sponsors/create', [\App\Http\Controllers\SiteSettingController::class, 'createSponsor'])->name('sponsors-create');
    Route::post('/sponsors/store', [\App\Http\Controllers\SiteSettingController::class, 'storeSponsor'])->name('sponsors-store');
    Route::get('/sponsors/edit', [\App\Http\Controllers\SiteSettingController::class, 'editSponsor'])->name('sponsors-edit');
    Route::get('/sponsors/{id}/delete', [\App\Http\Controllers\SiteSettingController::class, 'deleteSponsor'])->name('sponsors-delete');
    Route::post('/sponsors/update', [\App\Http\Controllers\SiteSettingController::class, 'updateSponsor'])->name('sponsors-update');
    Route::get('/sponsors/toggle-display', [\App\Http\Controllers\SiteSettingController::class, 'toggleDisplaySponsor'])->name('sponsors-toggle-display');
    Route::get('/create-slide', [\App\Http\Controllers\SlideImageController::class, 'create'])->name('slide-create');
    Route::post('/store-slide', [\App\Http\Controllers\SlideImageController::class, 'store']);
    Route::delete('/delete-slide/{id}', [\App\Http\Controllers\SlideImageController::class, 'destroy'])->name('slide-delete');
});
