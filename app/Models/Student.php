<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory;

    protected $hidden = [
        'password',
    ];
    protected $guarded = [];
    protected $casts = [
        'password' => 'hashed'
    ];

    public function links(): BelongsToMany
    {
        return $this->belongsToMany(Link::class);
    }
}
