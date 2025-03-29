<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDebtReminderRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Pakai policy kalau perlu lebih ketat
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'counterparty' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:1',
            'due_date' => 'required|date|after:today',
        ];
    }
}
