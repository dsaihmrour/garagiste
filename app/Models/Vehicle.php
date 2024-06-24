<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'make',
        'model',
        'fuelType',
        'registration',
        'photos',
        'user_id',
    ];

    protected $casts = [
        'photos' => 'array', // Cast 'photos' attribute to array
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
