<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingNavLink extends Model
{
    protected $table = 'landing_nav_links';

    protected $fillable = [
        'label',
        'url',
        'position',
        'status',
    ];

    protected $casts = [
        'position' => 'integer',
        'status'   => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('position');
    }
}