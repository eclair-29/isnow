<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approver extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }
}
