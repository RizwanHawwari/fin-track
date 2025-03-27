<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Category;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'category_id', 'amount', 'spent', 'month'];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Accessor untuk persentase penggunaan budget
    public function getPercentUsedAttribute()
    {
        return $this->amount > 0 ? ($this->spent / $this->amount) * 100 : 0;
    }
}
