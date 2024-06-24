<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'username',
        'password',
        'email',
        "firstName",
        "lastName",
        "address",
        "phoneNumber",
    ];



    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    /**
     * Get the vehicles for the user.
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class, 'mechanic_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function handle(Registered $event)
    {
        if ($event->user instanceof MustVerifyEmail && !$event->user->hasVerifiedEmail()) {
            $event->user->sendEmailVerificationNotification();
        }
    }
}
