<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class UserCategoryController extends Controller
{
    // Simpan kategori yang dipilih user
    public function store(Request $request)
    {
        $request->validate([
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $user = Auth::user();
        $user->categories()->sync($request->categories);

        return response()->json(['message' => 'Kategori berhasil disimpan']);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        // Ambil kategori yang dipilih user
        $selectedCategories = $request->input('categories', []);

        // Sinkronisasi kategori user (hapus yang lama, tambah yang baru)
        $user->categories()->sync($selectedCategories);

        return redirect()->route('user.categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function index()
    {
        $user = auth()->user();
        $categories = Category::where('is_default', true)->get();
        $selectedCategories = $user->categories->pluck('id')->toArray();

        return response()->json([
            'categories' => $categories,
            'selectedCategories' => $selectedCategories,
        ]);
    }

    public function create()
    {
        return view('user.create-category'); // Pastikan file Blade ini ada
    }
}
