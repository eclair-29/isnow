<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function category()
    {
        return $this->belongsTo(StatusCategory::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function sites()
    {
        return $this->hasMany(Site::class);
    }

    public function divisions()
    {
        return $this->hasMany(Division::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function applicationTypes()
    {
        return $this->hasMany(ApplicationType::class);
    }

    public function requestTypes()
    {
        return $this->hasMany(RequestType::class);
    }

    public function depts()
    {
        return $this->hasMany(Dept::class);
    }

    public function requestTrackings()
    {
        return $this->hasMany(RequestTracking::class);
    }

    public function accountApplications()
    {
        return $this->hasMany(AccountApplication::class);
    }

    public function accountTypes()
    {
        return $this->hasMany(AccountType::class);
    }

    public function sapRoles()
    {
        return $this->hasMany(SapRole::class);
    }
}
