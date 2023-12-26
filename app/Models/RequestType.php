<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestType extends Model
{
    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function applicationType()
    {
        return $this->belongsTo(ApplicationType::class);
    }
}
