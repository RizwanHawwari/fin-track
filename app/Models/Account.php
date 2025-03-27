<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Account extends Model
{
    protected $fillable = [
        'user_id', 'name', 'balance', 'type'
    ];

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}


    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
