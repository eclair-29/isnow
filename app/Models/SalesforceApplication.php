<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesforceApplication extends Model
{
    protected $fillable = [
        'account_application_id',
        'salesforce_profiles'
    ];

    protected $casts = [
        'salesforce_profiles' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
