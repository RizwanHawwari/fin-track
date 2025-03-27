<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Bisa juga pakai policy buat cek role
    }

    public function rules()
    {
        return [
            'transaction_date' => 'required|date',
            'description' => 'required|string|max:255',
            'amount' => 'required|string',
            'type' => 'required|in:income,expense',
            'category_id' => 'required|exists:categories,id',
            'account_id' => 'required|exists:accounts,id',
        ];
    }
}
