<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountApplication extends Model
{
    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function accountType()
    {
        return $this->belongsTo(AccountType::class);
    }
}
