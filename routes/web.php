<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\admin\OtherFieldController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SizeController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\IconsController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExtensionsController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ExComponentController;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\AuthenticationController;

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

Auth::routes(['verify' => true]);
//My Routes
Route::get('/login-admin', [UserController::class, 'login'])->name('admin.login');
Route::post('/login-admin', [UserController::class, 'loginPost'])->name('admin.login.post');
Route::get('/logout', [UserController::class, 'logout'])->name('admin.logout');
Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    //...............................DASHBOARD....................................

    Route::get('/', [DashboardController::class, 'dashboardEcommerce'])->name('dashboard-ecommerces');
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('ecommerce', [DashboardController::class, 'dashboardEcommerce'])->name('dashboard-ecommerce');
        Route::get('analytics', [DashboardController::class, 'dashboardAnalytics'])->name('dashboard-analytics');
    });

    //.............................USER...........................................

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.user.list');
        Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
        Route::get('/show/{user}', [UserController::class, 'show'])->name('admin.user.show');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::post('/create', [UserController::class, 'store'])->name('admin.user.store');
        Route::patch('/edit/{user}', [UserController::class, 'update'])->name('admin.user.update');
    });

    //.................................CATEGORY....................................

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.category.list');
        Route::post('/create', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::patch('/edit/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::delete('/delete/{category}', [CategoryController::class, 'delete'])->name('admin.category.delete');
    });

    //.................................Product......................................

    Route::group(['prefix' => 'product'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.product.list');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.product.create');
        Route::post('/create', [ProductController::class, 'store'])->name('admin.product.store');
        Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::patch('/edit/{product}', [ProductController::class, 'update'])->name('admin.product.update');
        Route::delete('/delete/{product}', [ProductController::class, 'destroy'])->name('admin.product.delete');
    });

    //...............................Color...........................................

    Route::group(['prefix' => 'color'], function () {
        Route::get('/', [ColorController::class, 'index'])->name('admin.color.list');
        Route::post('/create', [ColorController::class, 'store'])->name('admin.color.store');
        Route::patch('/edit/{color}', [ColorController::class, 'update'])->name('admin.color.update');
        Route::delete('/delete/{color}', [ColorController::class, 'destroy'])->name('admin.color.delete');
    });
    //..............................Other Field.....................................

    Route::group(['prefix' => 'other-field'], function () {
        Route::get('/', [OtherFieldController::class, 'index'])->name('admin.other.list');
        Route::post('/create', [OtherFieldController::class, 'store'])->name('admin.other.store');
        Route::patch('/edit/{other}', [OtherFieldController::class, 'update'])->name('admin.other.update');
        Route::delete('/deletr/{other}', [OtherFieldController::class, 'destroy'])->name('admin.other.delete');
    });

    //...................................Size.........................................

    Route::group(['prefix' => 'size'], function () {
        Route::get('/', [SizeController::class, 'index'])->name('admin.size.list');
        Route::post('/create', [SizeController::class, 'store'])->name('admin.size.store');
        Route::patch('/edit/{size}', [SizeController::class, 'update'])->name('admin.size.update');
        Route::delete('/delete/{size}', [SizeController::class, 'destroy'])->name('admin.size.delete');
    });

    //Application Routes
    Route::group(['prefix' => 'app'], function () {
        Route::get('invoice/view', [ApplicationController::class, 'invoiceApplication'])->name('app-invoice-view');
        Route::get('invoice/list', [ApplicationController::class, 'invoiceListApplication'])->name('app-invoice-list');
        Route::get('invoice/edit', [ApplicationController::class, 'invoiceEditApplication'])->name('app-invoice-edit');
        Route::get('invoice/add', [ApplicationController::class, 'invoiceAddApplication'])->name('app-invoice-add');
        Route::get('file-manager', [ApplicationController::class, 'fileManagerApplication'])->name('app-file-manager');
    });


    // icons
    Route::group(['prefix' => 'icons'], function () {
        Route::get('livicons', [IconsController::class, 'liveIcons'])->name('icons-livicons');
        Route::get('boxicons', [IconsController::class, 'boxIcons'])->name('icons-boxicons');
    });

    // Authentication  Route
    Route::group(['prefix' => 'auth'], function () {
        Route::get('login', [AuthenticationController::class, 'loginPage'])->name('auth-login');
        Route::get('register', [AuthenticationController::class, 'registerPage'])->name('auth-register');
        Route::get('forgot-password', [AuthenticationController::class, 'forgetPasswordPage'])->name('auth-forgot-password');
        Route::get('reset-password', [AuthenticationController::class, 'resetPasswordPage'])->name('auth-reset-password');
        Route::get('lock-screen', [AuthenticationController::class, 'authLockPage'])->name('auth-lock-screen');
    });

    // Miscellaneous
    Route::group(['prefix' => 'misc'], function () {
        Route::get('coming-soon', [MiscellaneousController::class, 'comingSoonPage'])->name('misc-coming-soon');
        Route::get('error-404', [MiscellaneousController::class, 'error404Page'])->name('misc-error-404');
        Route::get('error-500', [MiscellaneousController::class, 'error500Page'])->name('misc-error-500');
        Route::get('not-authorized', [MiscellaneousController::class, 'notAuthPage'])->name('misc-not-authorized');
        Route::get('maintenance', [MiscellaneousController::class, 'maintenancePage'])->name('misc-maintenance');
    });

    Route::get('maps/leaflet', [ChartController::class, 'leafletMap'])->name('maps-leaflet');

    // locale Route
    Route::get('lang/{locale}', [LanguageController::class, 'swap'])->name('lang-locale');
});
