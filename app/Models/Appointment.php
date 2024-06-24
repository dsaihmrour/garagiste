<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_datetime',
        'end_datetime',
        'user_id',
        'mechanic_id',
        'vehicle_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mechanic()
    {
        return $this->belongsTo(User::class, "mechanic_id");
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
