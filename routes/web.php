<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DonaturController,
    ProfileController,
    CategoryController,
    DashboardController,
    FundraiserController,
    FundraisingController,
    FundraisingPhaseController,
    FundraisingWithdrawalController
};

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::middleware('role:owner')->group(function () {
            Route::resources([
                'categories' => CategoryController::class,
                'donaturs' => DonaturController::class,
                'fundraisers' => FundraiserController::class,
            ]);

            Route::post('/fundraising/active/{fundraising}', [FundraisingController::class, 'active_fundraising'])
                ->name('fundraising.active');

            Route::resource('fundraising_withdrawals', FundraisingWithdrawalController::class)
                ->middleware('role:owner|fundraiser');

            Route::resource('fundraising_phases', FundraisingPhaseController::class)
                ->middleware('role:owner|fundraiser');

            Route::resource('fundraisings', FundraisingController::class)
                ->middleware('role:owner|fundraiser');
        });

        Route::middleware('role:fundraiser')->group(function () {
            Route::post('/fundraising_withdrawals/request/{fundraising}', [FundraisingWithdrawalController::class, 'store'])
                ->name('fundraising_withdrawals.store');

            Route::post('/fundraising_phases/update/{fundraising}', [FundraisingPhaseController::class, 'store'])
                ->name('fundraising_phases.store');

            // Route::post('/fundraiser/apply', [DashboardController::class, 'apply_fundraiser'])
            //     ->name('fundraiser.apply');

            Route::get('/my-withdrawals', [DashboardController::class, 'my_withdrawals'])->name('my-withdrawals');

            Route::get('/my-withdrawals/details/{fundraisingWithdrawal}', [DashboardController::class, 'apply_fundraiser'])
                ->name('my_withdrawals.details');
        });
            Route::get('fundraisers', [FundraiserController::class, 'index'])->name('fundraisers.index');
        
            Route::post('/fundraiser/apply', [DashboardController::class, 'apply_fundraiser'])
                ->name('fundraiser.apply');
    });
});

require __DIR__ . '/auth.php';
