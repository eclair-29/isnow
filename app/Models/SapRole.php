<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SapRole extends Model
{
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
