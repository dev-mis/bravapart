<?php

declare(strict_types=1);

use Hyperf\HttpServer\Router\Router as Route;
use App\Middleware\AuthMiddleware;
use function Hyperf\ViewEngine\view;

Route::get('/', [App\Controller\IndexController::class, 'index']);
Route::post('/first-validation', [App\Controller\IndexController::class, 'firstValidation']);
Route::post('/second-validation', [App\Controller\IndexController::class, 'secondValidation']);
Route::post('/third-validation', [App\Controller\IndexController::class, 'thirdValidation']);
Route::post('/store', [App\Controller\IndexController::class, 'store']);
Route::get('/sitemap.xml', function($query){
    return view('frontend.sitemap')->render();
});

Route::post('/get-provinces', [App\Controller\IndexController::class, 'getProvinces']);
Route::post('/get-cities/{provinceId}', [App\Controller\IndexController::class, 'getCities']);
Route::post('/get-districts/{cityId}', [App\Controller\IndexController::class, 'getDistricts']);
Route::post('/get-villages/{districtId}', [App\Controller\IndexController::class, 'getVillages']);
Route::post('/get-postal-code/{villageId}', [App\Controller\IndexController::class, 'getPostalCode']);


Route::addGroup('/admin', function(){
    Route::get('', [App\Controller\Admin\DashboardController::class, 'index']);

    Route::addGroup('/agents', function(){
        Route::get('', [App\Controller\Admin\AgentsController::class, 'index']);
        Route::get('/view/{id}', [App\Controller\Admin\AgentsController::class, 'view']);
        Route::post('/datatable', [App\Controller\Admin\AgentsController::class, 'datatable']);
        Route::post('/approve/{id}', [App\Controller\Admin\AgentsController::class, 'approve']);
        Route::post('/reject/{id}', [App\Controller\Admin\AgentsController::class, 'reject']);
    });

    Route::addGroup('/settings', function(){
        Route::addGroup('/users', function(){
            Route::get('', [App\Controller\Admin\Settings\UsersController::class, 'index']);
            Route::post('/datatable', [App\Controller\Admin\Settings\UsersController::class, 'datatable']);
            Route::get('/create', [App\Controller\Admin\Settings\UsersController::class, 'create']);
            Route::post('/create', [App\Controller\Admin\Settings\UsersController::class, 'store']);
            Route::get('/edit/{id}', [App\Controller\Admin\Settings\UsersController::class, 'edit']);
            Route::post('/edit/{id}', [App\Controller\Admin\Settings\UsersController::class, 'update']);
            Route::get('/delete/{id}', [App\Controller\Admin\Settings\UsersController::class, 'delete']);
        });

        Route::addGroup('/header-banner', function(){
            Route::get('', [App\Controller\Admin\Settings\HeaderBannerController::class, 'index']);
            Route::post('/update', [App\Controller\Admin\Settings\HeaderBannerController::class, 'update']);
        });

        Route::addGroup('/seo', function(){
            Route::get('', [App\Controller\Admin\Settings\SeoController::class, 'index']);
            Route::post('/update', [App\Controller\Admin\Settings\SeoController::class, 'update']);
        });

        Route::addGroup('/testimonial', function(){
            Route::get('', [App\Controller\Admin\Settings\TestimonialController::class, 'index']);
            Route::post('/datatable', [App\Controller\Admin\Settings\TestimonialController::class, 'datatable']);
            Route::get('/create', [App\Controller\Admin\Settings\TestimonialController::class, 'create']);
            Route::post('/create', [App\Controller\Admin\Settings\TestimonialController::class, 'store']);
            Route::get('/edit/{id}', [App\Controller\Admin\Settings\TestimonialController::class, 'edit']);
            Route::post('/edit/{id}', [App\Controller\Admin\Settings\TestimonialController::class, 'update']);
            Route::get('/delete/{id}', [App\Controller\Admin\Settings\TestimonialController::class, 'delete']);
        });
    });

    Route::get('/login', [App\Controller\Admin\AuthController::class, 'showLoginForm']);
    Route::post('/login', [App\Controller\Admin\AuthController::class, 'login']);

    Route::get('/logout', [App\Controller\Admin\AuthController::class ,'logout']);
}, ['middleware' => [AuthMiddleware::class]]);
