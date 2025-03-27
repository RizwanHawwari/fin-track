<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id', 'report_type', 'start_date', 'end_date', 'total_income', 'total_expense'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
