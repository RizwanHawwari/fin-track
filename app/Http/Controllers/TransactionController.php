<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\BalanceLog;
use App\Models\Budget;
use App\Events\BudgetThresholdReached;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreTransactionRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TransactionController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $userId = Auth::id();
    $transactions = Transaction::where('user_id', $userId)
                    ->with('category')
                    ->latest()
                    ->paginate(10);

    // Teks informasi yang bisa diubah dari backend
    $transactionInfo = "Transactions adalah data catatan pemasukan dan pengeluaran keuangan Anda. Gunakan fitur ini untuk melacak transaksi secara rinci dan melihat histori keuangan.";

    return view('transactions.index', compact('transactions', 'transactionInfo'));
    }

    public function create()
    {
        $categories = auth()->user()->categories; 
        $accounts = Account::where('user_id', Auth::id())->get(); // Load akun milik user

        return view('transactions.create', compact('categories', 'accounts'));
    }

    public function store(StoreTransactionRequest $request)
    {
        $user = Auth::user();
    
        $account = Account::where('id', $request->account_id)
            ->where('user_id', $user->id)
            ->firstOrFail();
    
        $cleanAmount = str_replace('.', '', $request->amount);
        $formattedAmount = number_format((float) $cleanAmount, 2, '.', '');
    
        // 🔹 CEK SALDO AKUN SEBELUM MENYIMPAN TRANSAKSI
        if ($request->type === 'expense' && $formattedAmount > $account->balance) {
            return redirect()->back()->with('error', 'Saldo akun tidak mencukupi untuk transaksi ini.');
        }
    
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'amount' => $formattedAmount,
        ] + $request->only([
            'account_id', 'category_id', 'transaction_date', 'type', 'description'
        ]));
    
        // 🔹 UPDATE SALDO AKUN
        if ($transaction->type === 'income') {
            $account->increment('balance', $formattedAmount);
        } else {
            $account->decrement('balance', $formattedAmount);
        }
    
        // 🔹 SIMPAN KE BALANCE LOGS
        BalanceLog::create([
            'account_id' => $account->id,
            'amount' => $formattedAmount,
            'type' => $transaction->type,
        ]);
    
        // 🔹 CEK DAN UPDATE BUDGET JIKA TRANSAKSI 'EXPENSE'
        if ($transaction->type === 'expense') {
            $budget = Budget::where('category_id', $transaction->category_id)
                ->where('user_id', $user->id)
                ->where('month', date('Y-m'))
                ->first();
    
            if ($budget) {
                $budget->increment('spent', $formattedAmount);
    
                // 🔹 Hitung persentase penggunaan budget
                $percentUsed = ($budget->spent / $budget->amount) * 100;
    
                // 🔹 Jika penggunaan budget di antara 80% - 99%, kirim Warning
                if ($percentUsed >= 80 && $percentUsed < 100) {
                    $user->notify(new \App\Notifications\BudgetWarningNotification($budget));
                }
    
                // 🔹 Jika penggunaan sudah mencapai atau melebihi 100%, kirim ThresholdReached
                if ($percentUsed >= 100) {
                    $user->notify(new \App\Notifications\BudgetThresholdReached($budget));
                }
            }
        }
    
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }    

public function update(Request $request, Transaction $transaction)
{
    $this->authorize('update', $transaction);

    $request->merge(['amount' => str_replace('.', '', $request->amount)]);

    $validated = $request->validate([
        'transaction_date' => 'required|date',
        'description' => 'required|string|max:255',
        'amount' => 'required|numeric|min:1',
        'type' => 'required|in:income,expense',
        'category_id' => 'required|exists:categories,id',
        'account_id' => 'required|exists:accounts,id',
    ]);

    $user = Auth::user();
    $account = Account::where('id', $transaction->account_id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    $cleanAmount = str_replace('.', '', $validated['amount']);
    $formattedAmount = number_format((float) $cleanAmount, 2, '.', '');

    // 🔹 KEMBALIKAN SALDO SEBELUM UPDATE
    if ($transaction->type === 'income') {
        $account->decrement('balance', $transaction->amount);
    } else {
        $account->increment('balance', $transaction->amount);
    }

    // 🔹 CEK SALDO SEBELUM UPDATE
    if ($validated['type'] === 'expense' && $formattedAmount > $account->balance) {
        return redirect()->back()->with('error', 'Saldo akun tidak mencukupi untuk transaksi ini.');
    }

    // 🔹 UPDATE TRANSAKSI
    $transaction->update([
        'amount' => $formattedAmount,
    ] + $validated);

    // 🔹 UPDATE SALDO AKUN
    if ($transaction->type === 'income') {
        $account->increment('balance', $formattedAmount);
    } else {
        $account->decrement('balance', $formattedAmount);
    }

    // 🔹 SIMPAN KE BALANCE LOGS
    BalanceLog::create([
        'account_id' => $account->id,
        'amount' => $formattedAmount,
        'type' => $transaction->type,
    ]);

    // 🔹 UPDATE BUDGET JIKA TRANSAKSI 'EXPENSE'
    if ($transaction->type === 'expense') {
        $budget = Budget::where('category_id', $transaction->category_id)
            ->where('user_id', $user->id)
            ->where('month', date('Y-m'))
            ->first();

        if ($budget) {
            $budget->increment('spent', $formattedAmount);

            // 🔹 Hitung persentase penggunaan budget
            $percentUsed = ($budget->spent / $budget->amount) * 100;

            // 🔹 Jika penggunaan budget di antara 80% - 99%, kirim Warning
            if ($percentUsed >= 80 && $percentUsed < 100) {
                $user->notify(new \App\Notifications\BudgetWarningNotification($budget));
            }

            // 🔹 Jika penggunaan sudah mencapai atau melebihi 100%, kirim ThresholdReached
            if ($percentUsed >= 100) {
                $user->notify(new \App\Notifications\BudgetThresholdReached($budget));
            }
        }
    }

    return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui!');
}


    public function edit(Transaction $transaction)
    {
        $this->authorize('update', $transaction);

        $categories = auth()->user()->categories;
        $accounts = Account::where('user_id', Auth::id())->get(); // Hindari query di blade

        return view('transactions.edit', compact('transaction', 'categories', 'accounts'));
    }

    public function destroy(Transaction $transaction)
{
    $this->authorize('delete', $transaction);

    $account = Account::where('id', $transaction->account_id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    // 🔹 Kembalikan saldo akun sebelum transaksi dihapus
    if ($transaction->type === 'income') {
        $account->decrement('balance', $transaction->amount);
    } else {
        $account->increment('balance', $transaction->amount);
    }

    // 🔹 Kurangi spent dari budget kalau transaksi 'expense'
    if ($transaction->type === 'expense') {
        $budget = Budget::where('user_id', Auth::id())
            ->where('category_id', $transaction->category_id)
            ->where('month', date('Y-m'))
            ->first();

        if ($budget) {
            $budget->decrement('spent', $transaction->amount);
        }
    }

    // 🔹 SIMPAN KE BALANCE LOGS
    BalanceLog::create([
        'account_id' => $account->id,
        'amount' => $transaction->amount,
        'type' => 'delete_' . $transaction->type, // Menandai bahwa ini dari transaksi yang dihapus
    ]);

    $transaction->delete();

    return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus!');
}

}