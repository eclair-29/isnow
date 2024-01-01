<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = [
        'application_type_id',
        'request_type_id',
        'approver_id',
        'user_id',
        'status_id',
        'purpose',
        'ticket_id',
    ];

    public function approver()
    {
        return $this->belongsTo(Approver::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function applicationType()
    {
        return $this->belongsTo(ApplicationType::class);
    }

    public function requestType()
    {
        return $this->belongsTo(RequestType::class);
    }

    public function requestTrackings()
    {
        return $this->hasMany(RequestTracking::class);
    }

    public function accountApplication()
    {
        return $this->hasOne(AccountApplication::class);
    }
}
