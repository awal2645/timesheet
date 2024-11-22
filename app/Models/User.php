<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['username', 'email', 'password', 'role', 'zoom_account_id', 'zoom_client_id', 'zoom_client_secret'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function employer()
    {
        return $this->hasOne(Employer::class);
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    // Scope |  user filter as active
    public function scopeActive($query)
    {
        return $query
            ->whereHas('employer', function ($q) {
                $q->where('status', true);
            })
            ->whereHas('employee', function ($q) {
                $q->where('status', true);
            });
    }

    public function isAdmin()
    {
        return $this->role === 'superadmin';
    }

    public function isEmployee()
    {
        return $this->role === 'employee';
    }

    public function isEmployer()
    {
        return $this->role === 'employer';
    }
}
