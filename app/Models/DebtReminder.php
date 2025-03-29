<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DebtReminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'counterparty',
        'description',
        'amount',
        'due_date',
        'status',
    ];    

    protected $casts = [
        'due_date' => 'date',
        'amount' => 'decimal:2',
    ];

    // Scope untuk user yang sedang login
    public function scopeForCurrentUser($query)
    {
        return $query->where('user_id', Auth::id());
    }
}

