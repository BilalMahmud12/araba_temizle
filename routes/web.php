<?php

use App\Http\Controllers\Client\ClientRegisterController;
use App\Http\Controllers\System\AreaController;
use App\Http\Controllers\System\BuildingBlockController;
use App\Http\Controllers\System\ClientController as SystemClientController;
use App\Http\Controllers\System\DistrictController;
use App\Http\Controllers\System\PackageCategoryController;
use App\Http\Controllers\System\PackageController;
use App\Http\Controllers\System\ServiceContractController;
use App\Http\Controllers\System\ServiceSpotController;
use App\Http\Controllers\System\ServiceSpotTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ClientController;
use Illuminate\Support\Facades\Session;

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
    return view('website.home');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('system')->as('system.')->group(function (){

    Route::middleware(['guest:web'])->group(function () {
        Route::view('/login', 'dashboard.user.auth.login')->name('login');
        Route::view('/register', 'auth.register')->name('register');
    });

    Route::middleware(['auth:web'])->group(function () {
        Route::get('/dashboard', function (){ return inertia('System/Dashboard'); })->name('dashboard');

        // System Definitions
        Route::prefix('definitions')->as('definitions.')->group(function() {

            // Packages Route Group
            Route::prefix('packages')->as('packages.')->group(function () {
                Route::get('/index', [PackageController::class, 'index'])->name('index');
                Route::get('/create', [PackageController::class, 'create'])->name('create');
                Route::post('/store', [PackageController::class, 'store'])->name('store');
                Route::get('/show/{id}', [PackageController::class, 'show'])->name('show');
                Route::post('/update/{id}', [PackageController::class, 'update'])->name('update');
                Route::delete('destroy/{id}', [PackageController::class, 'destroy'])->name('destroy');
            });

            // Package Categories Route Group
            Route::prefix('package-categories')->as('package-categories.')->group(function () {
                Route::get('/index', [PackageCategoryController::class, 'index'])->name('index');
                Route::get('/create', function (){ return inertia('System/Definitions/Packages/Categories/Create'); })->name('create');
                Route::post('/store', [PackageCategoryController::class, 'store'])->name('store');
                Route::get('/show/{id}', [PackageCategoryController::class, 'show'])->name('show');
                Route::post('/update/{id}', [PackageCategoryController::class, 'update'])->name('update');
                Route::delete('destroy/{id}', [PackageCategoryController::class, 'destroy'])->name('destroy');
            });

            // Contracts Route Group
            Route::prefix('contracts')->as('contracts.')->group(function (){
                Route::get('/index', [ServiceContractController::class, 'index'])->name('index');
                Route::get('/create', [ServiceContractController::class, 'create'])->name('create');
                Route::post('/store', [ServiceContractController::class, 'store'])->name('store');
                Route::get('/show/{id}', [ServiceContractController::class, 'show'])->name('show');
                Route::post('/update/{id}', [ServiceContractController::class, 'update'])->name('update');
                Route::delete('destroy/{id}', [ServiceContractController::class, 'destroy'])->name('destroy');
            });

            // Service Spots Route Group
            Route::prefix('spots')->as('spots.')->group(function (){

                Route::prefix('service-spots')->as('service-spots.')->group(function (){
                    Route::get('/index', [ServiceSpotController::class, 'index'])->name('index');
                    Route::get('/create', [ServiceSpotController::class, 'create'])->name('create');
                    Route::post('/store', [ServiceSpotController::class, 'store'])->name('store');
                    Route::get('/show/{id}', [ServiceSpotController::class, 'show'])->name('show');
                    Route::post('/update/{id}', [ServiceSpotController::class, 'update'])->name('update');
                    Route::delete('destroy/{id}', [ServiceSpotController::class, 'destroy'])->name('destroy');
                });

                Route::prefix('service-building-blocks')->as('service-building-blocks.')->group(function () {
                    Route::post('/store', [BuildingBlockController::class, 'store'])->name('store');
                });


                // Service Spot Types Route Group
                Route::prefix('service-spot-type')->as('service-spot-type.')->group(function (){
                    Route::get('/index', [ServiceSpotTypeController::class, 'index'])->name('index');
                    Route::get('/create', [ServiceSpotTypeController::class, 'create'])->name('create');
                    Route::post('/store', [ServiceSpotTypeController::class, 'store'])->name('store');
                    Route::get('/show/{id}', [ServiceSpotTypeController::class, 'show'])->name('show');
                    Route::post('/update/{id}', [ServiceSpotTypeController::class, 'update'])->name('update');
                    Route::delete('destroy/{id}', [ServiceSpotTypeController::class, 'destroy'])->name('destroy');
                });

                // Districts Route Group
                Route::prefix('districts')->as('districts.')->group(function (){
                    Route::get('/index', [DistrictController::class, 'index'])->name('index');
                    Route::get('/create', [DistrictController::class, 'create'])->name('create');
                    Route::post('/store', [DistrictController::class, 'store'])->name('store');
                    Route::get('/show/{id}', [DistrictController::class, 'show'])->name('show');
                    Route::post('/update/{id}', [DistrictController::class, 'update'])->name('update');
                    Route::delete('destroy/{id}', [DistrictController::class, 'destroy'])->name('destroy');
                });

                // Areas Route Group
                Route::prefix('areas')->as('areas.')->group(function (){
                    Route::get('/index', [AreaController::class, 'index'])->name('index');
                    Route::get('/create', [AreaController::class, 'create'])->name('create');
                    Route::post('/store', [AreaController::class, 'store'])->name('store');
                    Route::get('/show/{id}', [AreaController::class, 'show'])->name('show');
                    Route::post('/update/{id}', [AreaController::class, 'update'])->name('update');
                    Route::delete('destroy/{id}', [AreaController::class, 'destroy'])->name('destroy');
                });

            });

        });

        Route::prefix('clients')->as('clients.')->group(function () {
            Route::get('/index', [SystemClientController::class, 'index'])->name('index');
        });
    });

});

Route::prefix('client')->as('client.')->group(function () {

    Route::middleware(['guest:client'])->group(function () {
        Route::get('/login', [ClientController::class, 'login'])->name('login');

        // Create Account Routes
        Route::prefix('signup')->as('signup.')->group(function(){
            Route::get('/account-info', [ClientRegisterController::class, 'signup'])->name('account-info');
            Route::get('/account-activation/{client_id}', [ClientRegisterController::class, 'accountActivation'])->name('account-activation');
            Route::get('/wash-package/{client_id}', [ClientRegisterController::class, 'washPackage'])->name('wash-package');
        });

        Route::post('/create-account', [ClientRegisterController::class, 'createAccount'])->name('create-account');
        Route::post('/activate-client/{client_id}', [ClientRegisterController::class, 'activateClientAccount'])->name('activate-client');
    });

    Route::middleware(['auth:client'])->group(function () {
        Route::inertia('index', 'Clients/Index')->name('index');
    });
});

Route::get('/sessions', function () {
    Session::put('a_code', 995566);
    return Session::all();
});
