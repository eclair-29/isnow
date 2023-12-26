<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationType extends Model
{
    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

    public function requestTypes()
    {
        return $this->hasMany(RequestType::class);
    }
}
