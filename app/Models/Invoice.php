<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'additionalCharges',
        'totalAmount',
        "dueDate",
        "user_id",
        "description"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }
}
