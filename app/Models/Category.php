<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Budget;

class Category extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function users()
{
    return $this->belongsToMany(User::class, 'user_categories')->withTimestamps();
}

public function budgets()
{
    return $this->hasMany(Budget::class);
}

}
