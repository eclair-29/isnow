<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesforceApplication extends Model
{
    protected $casts = [
        'salesforce_profiles' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
