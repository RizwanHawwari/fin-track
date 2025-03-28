<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAccountRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AccountController extends Controller
{
    // Controller ini sudah aman dengan middleware yang ditambahkan di routing, jadi tidak perlu konstruktor lagi
    use AuthorizesRequests;

    public function index()
    {
        $userId = auth()->id(); // Mengambil ID user yang sedang login

        // Ambil akun-akun milik user tersebut dengan pagination
        $accounts = Account::where('user_id', $userId)->paginate(10);

        return view('accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('accounts.create');
    }

    public function store(StoreAccountRequest $request)
    {
        // Hapus format angka ribuan kalau ada koma/titik
        $balance = str_replace(',', '', $request->balance);

        // Cek apakah akun dengan nama yang sama sudah ada untuk user yang sama
        $existingAccount = Account::where('user_id', auth()->id())
            ->where('name', $request->name)
            ->first();

        if ($existingAccount) {
            return redirect()->back()->with('error', 'Akun dengan nama tersebut sudah ada.');
        }

        // Buat akun baru
        Account::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'balance' => $balance,
            'type' => $request->type,
        ]);

        return redirect()->route('accounts.index')->with('success', 'Akun berhasil ditambahkan!');
    }

    public function edit(Account $account)
    {
        // Menyaring akses hanya untuk akun milik user yang sedang login
        if ($account->user_id !== auth()->id()) {
            return redirect()->route('accounts.index')->with('error', 'Akses ditolak.');
        }

        return view('accounts.edit', compact('account'));
    }

    public function update(Request $request, Account $account)
    {
        $this->authorize('update', $account);

        if (
            Account::where('user_id', auth()->id())
                ->where('name', $request->name)
                ->where('id', '!=', $account->id)
                ->exists()
        ) {
            return redirect()->back()->with('error', 'Akun dengan nama tersebut sudah ada.');
        }

        $account->update($request->only(['name', 'balance', 'type']));

        return redirect()->route('accounts.index')->with('success', 'Akun berhasil diperbarui!');
    }

    public function destroy(Account $account)
    {
        $this->authorize('delete', $account);

        try {
            $account->delete();
            return redirect()->route('accounts.index')->with('success', 'Akun berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('accounts.index')->with('error', 'Akun tidak bisa dihapus karena masih memiliki transaksi terkait.');
        }
    }
}
