<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    public function accountApplications()
    {
        return $this->hasMany(AccountApplication::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
