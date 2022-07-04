<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Auth::routes(['register' => false]);
Route::get('/unauthorized', [App\Http\Controllers\HomeController::class, 'unauthorizedView'])->name('unauthorized');

Route::middleware('auth')->group(function () {
//    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::redirect('/', '/site-setting')->name('home');

    Route::prefix('pages')->group(function () {
        Route::get('/about', [\App\Http\Controllers\PageController::class, 'about'])->name('about');
        Route::get('/academics', [\App\Http\Controllers\PageController::class, 'academics'])->name('academics');
        Route::get('/admission', [\App\Http\Controllers\PageController::class, 'admission'])->name('admission');
        Route::get('/media', [\App\Http\Controllers\PageController::class, 'media'])->name('media');
        Route::get('/home-page', [\App\Http\Controllers\PageController::class, 'homepage'])->name('home-page');
        Route::get('/photo-splash', [\App\Http\Controllers\PageController::class, 'photoSplash'])->name('photo-splash');
        Route::get('/testimonials', [\App\Http\Controllers\PageController::class, 'testimonials'])->name('testimonials');
        Route::get('/questions-answer', [\App\Http\Controllers\NewsController::class, 'indexQA'])->name('questions-answer');

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
    Route::post('/site-setting/update-name', [\App\Http\Controllers\SiteSettingController::class, 'updateSiteSetting'])->name('site-setting-update-name');
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

    //useful links
    Route::get('/useful-link/create', [\App\Http\Controllers\SiteSettingController::class, 'createULink'])->name('useful-link-create');
    Route::post('/useful-link/store', [\App\Http\Controllers\SiteSettingController::class, 'storeULink'])->name('useful-link-store');
    Route::get('/useful-link/edit/{id}', [\App\Http\Controllers\SiteSettingController::class, 'editULink'])->name('useful-link-edit');
    Route::get('/useful-link/{id}/delete', [\App\Http\Controllers\SiteSettingController::class, 'deleteULink'])->name('useful-link-delete');
    Route::post('/useful-link/update', [\App\Http\Controllers\SiteSettingController::class, 'updateULink'])->name('useful-link-update');
    Route::get('/useful-link/toggle-display/{id}', [\App\Http\Controllers\SiteSettingController::class, 'toggleDisplayULink'])->name('useful-link-toggle-display');

 //Missions and Visions
    Route::get('/mission/edit/{id}', [\App\Http\Controllers\SiteSettingController::class, 'editMission'])->name('mission-edit');
    Route::get('/mission/{id}/delete', [\App\Http\Controllers\SiteSettingController::class, 'deleteULink'])->name('mission-delete');
    Route::post('/mission/update', [\App\Http\Controllers\SiteSettingController::class, 'updateMission'])->name('mission-update');
    Route::get('/mission/toggle-display/{id}', [\App\Http\Controllers\SiteSettingController::class, 'toggleDisplayULink'])->name('mission-toggle-display');

    //photo splash
    Route::get('/create-splash', [\App\Http\Controllers\SlideImageController::class, 'createSplash'])->name('splash-create');
    Route::post('/store-splash', [\App\Http\Controllers\SlideImageController::class, 'storeSplash']);
    Route::delete('/delete-splash/{id}', [\App\Http\Controllers\SlideImageController::class, 'destroySplash'])->name('splash-delete');

    //Testimonials
    Route::get('/create-testimonial', [\App\Http\Controllers\TestimonialController::class, 'createTestimonial'])->name('testimonial-create');
    Route::post('/store-testimonial', [\App\Http\Controllers\TestimonialController::class, 'storeTestimonial']);
    Route::post('/testimonial/update-one', [\App\Http\Controllers\TestimonialController::class, 'updateOne'])->name('testimonial-update');
    Route::delete('/delete-testimonial/{id}', [\App\Http\Controllers\TestimonialController::class, 'destroy'])->name('slide-delete');

    //Questions & Answers
    Route::get('/create-questions-answer', [\App\Http\Controllers\NewsController::class, 'createQuestionAnswer'])->name('questions-answer-create');
    Route::post('/store-questions-answer', [\App\Http\Controllers\NewsController::class, 'storeQA'])->name('questions-answer-store');
    Route::get('/questions-answer/edit/{id}', [\App\Http\Controllers\NewsController::class, 'editQA'])->name('questions-answer-edit');
    Route::get('/questions-answer/{id}/delete', [\App\Http\Controllers\NewsController::class, 'deleteQA'])->name('questions-answer-delete');
    Route::post('/questions-answer/update-one', [\App\Http\Controllers\NewsController::class, 'updateQA'])->name('questions-answer-update');
    Route::get('/questions-answer/toggle-display/{id}', [\App\Http\Controllers\NewsController::class, 'toggleDisplayQA'])->name('questions-answer-toggle-display');

    //menu and submenu
    Route::get('/menu-submenu', [\App\Http\Controllers\PageController::class, 'menu'])->name('menu-submenu');

    //Landing Page
    Route::post('/home-page/update-one', [\App\Http\Controllers\LandingPageController::class, 'updateOne'])->name('home-page-update-one');
    Route::get('/landing-page/toggle-display/{id}', [\App\Http\Controllers\LandingPageController::class, 'toggleDisplayExploreMore'])->name('landing-explore-more-toggle-display');
    Route::get('/explore-more/create', [\App\Http\Controllers\LandingPageController::class, 'createExploreMore'])->name('explore-more-create');
    Route::post('/explore-more/store', [\App\Http\Controllers\LandingPageController::class, 'storeExploreMore'])->name('explore-more-store');
    Route::get('/explore-more/edit/{id}', [\App\Http\Controllers\LandingPageController::class, 'editExploreMore'])->name('explore-more-edit');
    Route::get('/explore-more/{id}/delete', [\App\Http\Controllers\LandingPageController::class, 'deleteExploreMore'])->name('explore-more-delete');
    Route::post('/explore-more/update', [\App\Http\Controllers\LandingPageController::class, 'updateExploreMore'])->name('explore-more-update');

    //news $ article - landing
    Route::get('/news-article/toggle-display/{id}', [\App\Http\Controllers\LandingPageController::class, 'toggleDisplayNewsArticle'])->name('landing-news-article-toggle-display');
    Route::get('/news-article/create', [\App\Http\Controllers\LandingPageController::class, 'createNewsArticle'])->name('news-article-create');
    Route::post('/news-article/store', [\App\Http\Controllers\LandingPageController::class, 'storeNewsArticle'])->name('news-article-store');
    Route::get('/news-article/edit/{id}', [\App\Http\Controllers\LandingPageController::class, 'editNewsArticle'])->name('news-article-edit');
    Route::get('/news-article/{id}/delete', [\App\Http\Controllers\LandingPageController::class, 'deleteNewsArticle'])->name('news-article-delete');
    Route::post('/news-article/update', [\App\Http\Controllers\LandingPageController::class, 'updateNewsArticle'])->name('news-article-update');

    //upcoming events - landing
    Route::get('/upcoming-event/toggle-display/{id}', [\App\Http\Controllers\LandingPageController::class, 'toggleDisplayNewsArticle'])->name('landing-upcoming-event-toggle-display');
    Route::get('/upcoming-event/create', [\App\Http\Controllers\LandingPageController::class, 'createUpcomingEvent'])->name('upcoming-event-create');
    Route::post('/upcoming-event/store', [\App\Http\Controllers\LandingPageController::class, 'storeUpcomingEvent'])->name('upcoming-event-store');
    Route::get('/upcoming-event/edit/{id}', [\App\Http\Controllers\LandingPageController::class, 'editUpcomingEvent'])->name('upcoming-event-edit');
    Route::get('/upcoming-event/{id}/delete', [\App\Http\Controllers\LandingPageController::class, 'deleteUpcomingEvent'])->name('upcoming-event-delete');
    Route::post('/upcoming-event/update', [\App\Http\Controllers\LandingPageController::class, 'updateUpcomingEvent'])->name('upcoming-event-update');
    Route::get('/school-calendar', [\App\Http\Controllers\NewsController::class, 'indexCalendar'])->name('school-calendar');
    Route::post('/upload-calendar', [\App\Http\Controllers\NewsController::class, 'uploadContent'])->name('upload-calendar');
    Route::get('/calendar-event/toggle-display/{id}', [\App\Http\Controllers\LandingPageController::class, 'toggleDisplayCalendar'])->name('calendar-event-toggle-display');

});
