<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
