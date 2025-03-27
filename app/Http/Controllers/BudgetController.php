<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BudgetController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $budgets = Budget::where('user_id', Auth::id())->with('category')->paginate(10);
        return view('budgets.index', compact('budgets'));
    }

    public function create()
{
    $categories = auth()->user()->categories; // Ambil kategori dari pivot table user_categories
    return view('budgets.create', compact('categories'));
}



    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:1',
            'month' => 'required|date_format:Y-m',
        ]);

        Budget::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'spent' => 0, // Awalnya 0
            'month' => $request->month,
        ]);

        return redirect()->route('budgets.index')->with('success', 'Budget berhasil ditambahkan!');
    }

    public function edit(Budget $budget)
    {
        $this->authorize('update', $budget);
        $categories = auth()->user()->categories; 
        return view('budgets.edit', compact('budget', 'categories'));
    }

    public function update(Request $request, Budget $budget)
    {
        $this->authorize('update', $budget);
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $budget->update([
            'amount' => $request->amount,
        ]);

        return redirect()->route('budgets.index')->with('success', 'Budget berhasil diperbarui!');
    }

    public function destroy(Budget $budget)
    {
        $this->authorize('delete', $budget);
        $budget->delete();
        return redirect()->route('budgets.index')->with('success', 'Budget berhasil dihapus!');
    }
}

