<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
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
}
