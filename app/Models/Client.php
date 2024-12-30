<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'billing_address',
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'client_id');
    }
}
