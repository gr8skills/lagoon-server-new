<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

Route::prefix('/about')->group(function () {
    Route::get('/home', [\App\Http\Controllers\Api\AboutPagesController::class, 'home']);
    Route::get('/meet-head', [\App\Http\Controllers\Api\AboutPagesController::class, 'meetHead']);
    Route::get('/educational-philosophy', [\App\Http\Controllers\Api\AboutPagesController::class, 'philosophy']);
    Route::get('/virtual-tour', [\App\Http\Controllers\Api\AboutPagesController::class, 'virtualTour']);
    Route::get('/partnership', [\App\Http\Controllers\Api\AboutPagesController::class, 'partners']);
    Route::get('/contact-us', [\App\Http\Controllers\Api\AboutPagesController::class, 'contactUs']);
});
Route::prefix('/academics')->group(function () {
    Route::get('/facilities', [\App\Http\Controllers\Api\AcademicsPagesController::class, 'facilities']);
    Route::get('/junior-school', [\App\Http\Controllers\Api\AcademicsPagesController::class, 'juniorSchool']);
    Route::get('/senior-school', [\App\Http\Controllers\Api\AcademicsPagesController::class, 'seniorSchool']);
    Route::get('/library', [\App\Http\Controllers\Api\AcademicsPagesController::class, 'library']);
    Route::get('/calendar', [\App\Http\Controllers\Api\AcademicsPagesController::class, 'calendar']);
});
Route::prefix('/admission')->group(function () {
    Route::get('/procedure', [\App\Http\Controllers\Api\AdmissionPagesController::class, 'procedure']);
    Route::get('/tuition', [\App\Http\Controllers\Api\AdmissionPagesController::class, 'tuition']);
    Route::get('/scholarships', [\App\Http\Controllers\Api\AdmissionPagesController::class, 'scholarship']);
    Route::get('/faqs', [\App\Http\Controllers\Api\AdmissionPagesController::class, 'faqs']);
    Route::get('/apply', [\App\Http\Controllers\Api\AdmissionPagesController::class, 'apply']);
});
Route::prefix('/studentLife')->group(function () {
    Route::get('/life-in-lagoon', [\App\Http\Controllers\Api\StudentLifePagesController::class, 'life']);
    Route::get('/lagoon-traditions', [\App\Http\Controllers\Api\StudentLifePagesController::class, 'traditions']);
    Route::get('/student-leadership', [\App\Http\Controllers\Api\StudentLifePagesController::class, 'leadership']);
    Route::get('/service', [\App\Http\Controllers\Api\StudentLifePagesController::class, 'services']);
    Route::get('/club-and-activities', [\App\Http\Controllers\Api\StudentLifePagesController::class, 'clubActivities']);
    Route::get('/mentoring-tutorials', [\App\Http\Controllers\Api\StudentLifePagesController::class, 'tutorials']);
});
Route::prefix('/giving')->group(function () {
    Route::get('/why-give', [\App\Http\Controllers\Api\GivingPagesController::class, 'why']);
    Route::get('/giving-faqs', [\App\Http\Controllers\Api\GivingPagesController::class, 'givingFaqs']);
    Route::get('/how-to-give', [\App\Http\Controllers\Api\GivingPagesController::class, 'howTo']);
});
Route::prefix('/parents')->group(function () {
    Route::get('/nafad', [\App\Http\Controllers\Api\ParentsPagesController::class, 'nafad']);
    Route::get('/digital-safety', [\App\Http\Controllers\Api\ParentsPagesController::class, 'digitalSafety']);
    Route::get('/launch-menu', [\App\Http\Controllers\Api\ParentsPagesController::class, 'launchMenu']);
});
Route::get('/news/{slug}', [App\Http\Controllers\Api\NewsController::class, 'show']);
Route::get('/news', [App\Http\Controllers\Api\NewsController::class, 'index']);
Route::get('/site-settings', [\App\Http\Controllers\Api\SiteSettingController::class, 'index']);
Route::get('/sponsors', [\App\Http\Controllers\Api\SiteSettingController::class, 'sponsors']);

Route::get('/slide-images', [\App\Http\Controllers\Api\SlideImageController::class, 'index']);

Route::get('/menu-submenu', [\App\Http\Controllers\Api\SiteSettingController::class, 'menus']);
Route::get('/useful-links', [\App\Http\Controllers\Api\SiteSettingController::class, 'usefulLinks']);
Route::get('/splash-photo', [\App\Http\Controllers\Api\SiteSettingController::class, 'splashPhoto']);
Route::get('/landing-page', [\App\Http\Controllers\Api\SiteSettingController::class, 'landingData']);
Route::get('/news-events', [\App\Http\Controllers\Api\SiteSettingController::class, 'newsArticles']);
Route::get('/full-calendar', [\App\Http\Controllers\Api\NewsController::class, 'index']);
Route::get('/testimonials', [\App\Http\Controllers\Api\TestimonialController::class, 'index']);
