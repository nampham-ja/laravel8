<?php

use App\Http\Controllers\admin\AboutController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\MultiImageController;
use Illuminate\Support\Facades\Route;

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
    return view('web.index');
})->name('web_home');
Route::get('/portfolio', function () {
    return view('web.portfolio');
})->name('web_portfolio');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');

    Route::get('user/logout', [AdminController::class, 'Logout'])->name('user.logout');

    // ブランドの画像
    Route::get('admin/brand', [BrandController::class, 'AllBrand'])->name('admin.allBrand');
    Route::post('update/brand', [BrandController::class, 'UpdateBrand'])->name('update.brand');

    Route::get('edit/brand/{id}', [BrandController::class, 'EditBrand'])->name('edit.brand');
    Route::get('delete/brand/{id}', [BrandController::class, 'deleteBrand'])->name('delete.brand');


    // Slider All Route
    Route::get('admin/slider', [SliderController::class, 'AllSlider'])->name('admin.allSlider');
    Route::get('add/slider', [SliderController::class, 'addSlider'])->name('admin.addSlider');
    Route::post('update/slider', [SliderController::class, 'UpdateSlider'])->name('update.slider');

    Route::get('edit/slider/{id}', [SliderController::class, 'EditSlider'])->name('edit.slider');
    Route::get('delete/slider/{id}', [SliderController::class, 'deleteSlider'])->name('delete.slider');

    // About All Route
    Route::get('admin/about', [AboutController::class, 'AllAbout'])->name('admin.allAbout');
    Route::get('add/about', [AboutController::class, 'addAbout'])->name('admin.addAbout');
    Route::post('update/about', [AboutController::class, 'UpdateAbout'])->name('update.about');

    Route::get('edit/about/{id}', [AboutController::class, 'EditAbout'])->name('edit.about');
    Route::get('delete/about/{id}', [AboutController::class, 'deleteAbout'])->name('delete.about');

    // MultiImage All Route
    Route::get('admin/multi_image', [MultiImageController::class, 'AllMultiImage'])->name('admin.MultiImage');
    Route::get('add/multi_image', [MultiImageController::class, 'addMultiImage'])->name('admin.addMultiImage');
    Route::post('update/multi_image', [MultiImageController::class, 'UpdateMultiImage'])->name('update.multi_image');

    Route::get('edit/multi_image/{id}', [MultiImageController::class, 'EditMultiImage'])->name('edit.multi_image');
    Route::get('delete/multi_image/{id}', [MultiImageController::class, 'deleteMultiImage'])->name('delete.multi_image');
});
