<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SapApplication extends Model
{
    protected $fillable = [
        'account_application_id',
        'sap_roles',
        'roles_for_delete',
    ];

    protected $casts = [
        'sap_roles' => 'array'
    ];

    public function accountApplication()
    {
        return $this->belongsTo(AccountApplication::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
