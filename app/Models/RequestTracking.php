<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestTracking extends Model
{
    protected $fillable = [
        'request_id', 'user_id', 'approver_id', 'status_id', 'notes'
    ];

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(Approver::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
