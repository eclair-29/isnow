<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApproverType extends Model
{
    public function approvers()
    {
        return $this->hasMany(Approver::class);
    }
}
