<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusCategory extends Model
{
    public function statuses()
    {
        return $this->hasMany(Status::class);
    }
}