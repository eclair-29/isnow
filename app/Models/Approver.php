<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Approver extends Model
{
    protected $fillable = ['user_id', 'approver_type_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function approverType()
    {
        return $this->belongsTo(ApproverType::class);
    }

    public function requestTrackings()
    {
        return $this->hasMany(RequestTracking::class);
    }
}
