<?php

namespace App\Http\Controllers;

use App\Models\DebtReminder;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDebtReminderRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DebtReminderController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $reminders = DebtReminder::forCurrentUser()->orderBy('due_date', 'asc')->get();
        return view('debts.reminders.index', compact('reminders'));
    }

    public function create()
    {
        return view('debts.reminders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'counterparty' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:1',
            'due_date' => 'required|date|after:today',
        ]);
        
        DebtReminder::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'counterparty' => $validated['counterparty'],
            'description' => $validated['description'],
            'amount' => $validated['amount'],
            'due_date' => $validated['due_date'],
            'status' => 'pending',
        ]);        

        return redirect()->route('debt-reminders.index')->with('success', 'Reminder hutang berhasil ditambahkan!');
    }

    public function edit(DebtReminder $debtReminder)
    {
        $this->authorize('update', $debtReminder);
        return view('debts.reminders.edit', compact('debtReminder'));
    }

    public function update(StoreDebtReminderRequest $request, DebtReminder $debtReminder)
    {
        $this->authorize('update', $debtReminder);

        $debtReminder->update($request->validated());

        return redirect()->route('debt-reminders.index')->with('success', 'Reminder hutang berhasil diperbarui!');
    }

    public function destroy(DebtReminder $debtReminder)
    {
        $this->authorize('delete', $debtReminder);
        $debtReminder->delete();

        return redirect()->route('debt-reminders.index')->with('success', 'Reminder hutang berhasil dihapus!');
    }
}
