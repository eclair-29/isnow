<?php

namespace App;

use App\Models\Dept;
use App\Models\Division;
use App\Models\Request;
use App\Models\Site;
use App\Models\Status;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'staff_id', 'password', 'status_id', 'site_id', 'division_id', 'dept_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function approver()
    {
        return $this->hasOne(Approver::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function dept()
    {
        return $this->belongsTo(Dept::class);
    }

    public function requestTrackings()
    {
        return $this->hasMany(RequestTracking::class);
    }
}
