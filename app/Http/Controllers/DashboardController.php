<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
{
    $userId = Auth::id();

    $totals = Transaction::where('user_id', $userId)
        ->selectRaw("
            SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END) as total_income,
            SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END) as total_expense
        ")
        ->first();

    $totalIncome = $totals->total_income ?? 0;
    $totalExpense = $totals->total_expense ?? 0;

    $accounts = Account::where('user_id', $userId)->get();
    $totalAccountsBalance = $accounts->sum('balance');
    $totalSaldo = Account::where('user_id', Auth::id())->sum('balance');

    $transactions = Transaction::where('user_id', $userId)
        ->with('category')
        ->latest()
        ->limit(5)
        ->get();

    $balanceHistory = Transaction::selectRaw('
            DATE_FORMAT(transaction_date, "%Y-%m") as month, 
            SUM(amount) as balance
        ')
        ->where('user_id', $userId)
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->get();

    // 🔹 Ambil notifikasi terbaru
    $notifications = auth()->user()->unreadNotifications;

    return view('dashboard', compact(
        'totalIncome', 'totalExpense', 'accounts', 'transactions', 
        'balanceHistory', 'totalSaldo', 'totalAccountsBalance', 'notifications'
    ));
}



    // Endpoint untuk mengambil data dashboard untuk chart
    public function dashboardData()
{
    $userId = Auth::id();

    // Pemasukan vs Pengeluaran
    $totals = Transaction::where('user_id', $userId)
        ->selectRaw("
            SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END) as total_income,
            SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END) as total_expense
        ")
        ->first();

    $income = (int) ($totals->total_income ?? 0); // Cast to integer
    $expense = (int) ($totals->total_expense ?? 0); // Cast to integer

    // Saldo perbulan
    $balanceHistory = Transaction::selectRaw('
            DATE_FORMAT(transaction_date, "%Y-%m") as date, 
            SUM(amount) as balance
        ')
        ->where('user_id', $userId)
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get()
        ->map(function ($item) {
            $item->balance = (int) $item->balance;  // Cast balance to integer
            return $item;
        });

    return response()->json([
        'income' => $income,
        'expense' => $expense,
        'balanceHistory' => $balanceHistory,
    ]);
}
}

