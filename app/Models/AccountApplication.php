<?php

namespace App\Models;

use App\SapApplication;
use Illuminate\Database\Eloquent\Model;

class AccountApplication extends Model
{
    protected $fillable = [
        'request_id',
        'account_type_id',
        'charges',
        'status_id',
    ];

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

    public function sapApplication()
    {
        return $this->hasOne(SapApplication::class);
    }
}
