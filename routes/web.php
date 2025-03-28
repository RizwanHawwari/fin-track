<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\UserCategoryController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect()->route('dashboard');
})->middleware(['auth']);

Route::get('/admin-dashboard', function () {
    return "Selamat datang di halaman admin!";
})->middleware('role:admin');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/dashboard-data', [DashboardController::class, 'dashboardData'])->middleware('auth');

Route::middleware(['auth'])->group(function () {
Route::resource('accounts', AccountController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('transactions', TransactionController::class);
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::resource('budgets', BudgetController::class)->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/hide-transaction-info', function (Request $request) {
    session(['show_transaction_info' => 'hidden']);
    return response()->json(['status' => 'success']);
})->name('hide.transaction.info');

Route::middleware(['auth'])->group(function () {
    Route::get('/user/categories', [UserCategoryController::class, 'index'])->name('user.categories.index');
    Route::post('/user/categories', [UserCategoryController::class, 'store'])->name('user.categories.store');
    Route::put('/user/categories', [UserCategoryController::class, 'update'])->name('user.categories.update');
});

Route::get('/notifications/read/{id}', [NotificationController::class, 'read'])->name('notifications.read');

Route::post('/notifications/read', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return response()->json(['success' => true]);
})->name('notifications.markAsRead');



require __DIR__.'/auth.php';
