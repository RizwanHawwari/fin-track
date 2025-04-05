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
            ->selectRaw(
                "
            SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END) as total_income,
            SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END) as total_expense
        ",
            )
            ->first();

        $totalIncome = $totals->total_income ?? 0;
        $totalExpense = $totals->total_expense ?? 0;

        $accounts = Account::where('user_id', $userId)->get();
        $totalAccountsBalance = $accounts->sum('balance');
        $totalSaldo = Account::where('user_id', Auth::id())->sum('balance');

        $transactions = Transaction::where('user_id', $userId)->with('category')->latest()->limit(5)->get();

        $balanceHistory = Transaction::selectRaw(
            '
            DATE_FORMAT(transaction_date, "%Y-%m") as month,
            SUM(amount) as balance
        ',
        )
            ->where('user_id', $userId)
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        // 🔹 Ambil notifikasi terbaru
        $notifications = auth()->user()->unreadNotifications;

        $dailyMessages = ['Jangan remehin pengeluaran kecil, lama-lama bisa jadi lubang lho!', 'Keuangan oke, hati pun tenang. Kamu udah di jalur yang bener!', 'Yuk, catat lagi pengeluarannya — langkah kecil, hasilnya besar!', 'Hai ' . Auth::user()->name . ', udah sempet cek saldo hari ini belum?', 'Keuangan aman tuh mulai dari hal-hal simpel. Kamu keren udah mulai!', 'Dompet adem itu goals banget. Yuk, terus pantau pengeluaranmu!', 'Setiap catatan pengeluaran tuh langkah kecil menuju bebas finansial. Gas terus!', 'Kamu pantas banget hidup tanpa drama finansial. Lanjutkan kebiasaan kerennya!', 'Cuma satu klik atau cek, tapi bisa bantu atur masa depanmu lebih rapi', 'Kamu dan dompetmu? Bisa kok makin kompak dan tertata!'];

        $dailyMessage = $dailyMessages[array_rand($dailyMessages)];

        return view('dashboard', compact('totalIncome', 'totalExpense', 'accounts', 'transactions', 'balanceHistory', 'totalSaldo', 'totalAccountsBalance', 'notifications', 'dailyMessage'));
    }

    // Endpoint untuk mengambil data dashboard untuk chart
    public function dashboardData()
    {
        $userId = Auth::id();
        $today = Carbon::today();
        $currentMonth = Carbon::now()->format('Y-m');

        // 🔹 Pemasukan vs Pengeluaran
        $totals = Transaction::where('user_id', $userId)
            ->selectRaw(
                "
            SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END) as total_income,
            SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END) as total_expense
        ",
            )
            ->first();

        $income = (int) ($totals->total_income ?? 0);
        $expense = (int) ($totals->total_expense ?? 0);

        // 🔹 Saldo per bulan
        $balanceHistory = Transaction::where('user_id', $userId)->selectRaw('DATE_FORMAT(transaction_date, "%Y-%m") as date, SUM(amount) as balance')->groupBy('date')->orderBy('date', 'asc')->get()->map(fn($item) => ['date' => $item->date, 'balance' => (int) $item->balance]);

        // 🔹 Budget per kategori
        $budgetUsage = \DB::table('budgets')
            ->join('categories', 'budgets.category_id', '=', 'categories.id')
            ->leftJoin('transactions', function ($join) use ($userId, $currentMonth) {
                $join
                    ->on('budgets.category_id', '=', 'transactions.category_id')
                    ->where('transactions.user_id', '=', $userId)
                    ->whereRaw('DATE_FORMAT(transactions.transaction_date, "%Y-%m") = ?', [$currentMonth]);
            })
            ->where('budgets.user_id', $userId)
            ->groupBy('categories.name', 'budgets.amount')
            ->selectRaw(
                '
            categories.name as category,
            budgets.amount as budget,
            COALESCE(SUM(transactions.amount), 0) as spent
        ',
            )
            ->get();

        // 🔹 Total budget vs sisa budget bulan ini
        $totalBudget = $budgetUsage->sum('budget');
        $totalSpent = $budgetUsage->sum('spent');
        $remainingBudget = $totalBudget - $totalSpent;

        // 🔹 Rata-rata pengeluaran harian bulan ini
        $daysPassed = Carbon::now()->day;
        $dailyExpenseAvg = $daysPassed > 0 ? (int) round($totalSpent / $daysPassed) : 0;

        // 🔹 Prediksi saldo akhir bulan (asumsi pemasukan tetap)
        $predictedBalance = Account::where('user_id', $userId)->sum('balance') - $totalSpent;

        // 🔹 Kategori pengeluaran terbesar
        $topCategories = Transaction::where('transactions.user_id', $userId)->where('transactions.type', 'expense')->join('categories', 'transactions.category_id', '=', 'categories.id')->selectRaw('categories.name, SUM(transactions.amount) as total_spent')->groupBy('categories.name')->orderByDesc('total_spent')->limit(5)->get();

        return response()->json([
            'income' => $income,
            'expense' => $expense,
            'balanceHistory' => $balanceHistory,
            'budgetUsage' => $budgetUsage,
            'totalBudget' => $totalBudget,
            'totalSpent' => $totalSpent,
            'remainingBudget' => $remainingBudget,
            'dailyExpenseAvg' => $dailyExpenseAvg,
            'predictedBalance' => $predictedBalance,
            'topCategories' => $topCategories,
        ]);
    }
}
