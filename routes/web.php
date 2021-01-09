<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Front\homepage;

use App\Http\Controllers\Back\Dashboard;

use App\Http\Controllers\Back\authority;

use App\Http\Controllers\Back\contentcontrol;

use App\Http\Controllers\Back\categorycontroller;

use App\Http\Controllers\Back\pagecontroller;

use App\Http\Controllers\Back\configcontroller;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/

Route::prefix("/admin")->middleware('islogin')->group(function () {

    Route::get("/login", [authority::class, 'login'])->name('login');

    Route::post("/login", [authority::class, 'login_post'])->name('login_post');
});

Route::prefix("/admin")->middleware('isadmin')->group(function () {

    Route::get("/panel", [Dashboard::class, 'index'])->name('dashboard');

    //MAKALE İŞLEMLERİ  
    Route::prefix("/makaleler")->group(function () {
        Route::get('/silineneler', [contentcontrol::class, 'trashed'])->name('makale_trashed');

        Route::get('/', [contentcontrol::class, 'index'])->name('makale');

        Route::get('/oluştur', [contentcontrol::class, 'create'])->name('makale_creat');

        Route::post('/oluştur', [contentcontrol::class, 'store'])->name('makale_save');

        Route::get('/{id}/düzenle', [contentcontrol::class, 'edit'])->name('makale_edit');

        Route::put('/{id}', [contentcontrol::class, 'update'])->name('makale_update');

        Route::get('/switchh', [contentcontrol::class, 'switch'])->name('switch');

        Route::get('/deletee/{id}', [contentcontrol::class, 'delete'])->name('makale_delete');

        Route::get('/recover/{id}', [contentcontrol::class, 'recover'])->name('makale_recover');

        Route::get('/hardDelete/{id}', [contentcontrol::class, 'hardDelete'])->name('makale_hardDelete');
    });

    //CATEGORY İŞLEMLERİ
    Route::prefix("/kategoriler")->group(function () {
        Route::get('/', [categorycontroller::class, 'index'])->name('category_index');

        Route::get('/switch', [categorycontroller::class, 'switch'])->name('category_switch');

        Route::post('/kayıt', [categorycontroller::class, 'save'])->name('category_save');

        Route::get('/düzenle', [categorycontroller::class, 'edit'])->name('category_edit');

        Route::post('/update', [categorycontroller::class, 'update'])->name('category_update');

        Route::post('/delete', [categorycontroller::class, 'delete'])->name('category_delete');
    });

    //PAGE İŞLEMLERİ
    Route::prefix("/sayfalar")->group(function () {
        Route::get('/silineneler', [pagecontroller::class, 'trashed'])->name('page_trashed');

        Route::get('/', [pagecontroller::class, 'index'])->name('page_index');

        Route::get('/switch', [pagecontroller::class, 'switch'])->name('page_switch');

        Route::get('/{id}/düzenle', [pagecontroller::class, 'edit'])->name('page_edit');

        Route::put('/{id}', [pagecontroller::class, 'update'])->name('page_update');

        Route::get('/deletee/{id}', [pagecontroller::class, 'delete'])->name('page_delete');

        Route::get('/recover/{id}', [pagecontroller::class, 'recover'])->name('page_recover');

        Route::get('/hardDelete/{id}', [pagecontroller::class, 'hardDelete'])->name('page_hardDelete');

        Route::get('/oluştur', [pagecontroller::class, 'create'])->name('page_creat');

        Route::post('/oluştur', [pagecontroller::class, 'save'])->name('page_save');

        Route::get('/sıralama', [pagecontroller::class, 'orders'])->name('page_orders');
    });
    //CONFİG İŞLMLERİ
    Route::get('/ayarlar', [configcontroller::class, 'index'])->name('config_index');

    Route::post('/ayarlar-güncelle', [configcontroller::class, 'update'])->name('config_update');

    Route::get("/logout", [authority::class, 'logout'])->name('logout');
});



/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [homepage::class, 'index'])->name('homepage');

Route::get("/test", [homepage::class, 'test']);

Route::get('/page', [homepage::class, 'index']);

Route::get("/contact", [homepage::class, 'contact'])->name('contact');

Route::get("/contactt", [homepage::class, 'contact_post'])->name('contact_post');

Route::get("/category/{category}", [homepage::class, 'category'])->name('category');

Route::get("/{category}/{slug}", [homepage::class, 'post'])->name('post');

Route::get("/{page}", [homepage::class, 'page'])->name('page');
