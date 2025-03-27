<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 'account_id', 'category_id', 'type', 'amount', 'description', 'transaction_date'
    ];

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}


    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function budget()
{
    return $this->hasOne(Budget::class, 'category_id', 'category_id')
        ->where('user_id', $this->user_id)
        ->where('month', date('Y-m'));
}

}
