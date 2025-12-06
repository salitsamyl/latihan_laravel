<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LandingProgram extends Model
{
    use SoftDeletes;

    protected $table = 'landing_programs';

    protected $fillable = [
        'title',
        'description',
        'icon',
        'position',
        'status',
        'image'
    ];

    protected $casts = [
        'position' => 'integer',
        'status'   => 'boolean',
    ];

    // Scope: hanya yang aktif
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    // Scope: urutkan berdasarkan position (asc) lalu created_at desc
    public function scopeOrdered($query)
    {
        return $query->orderBy('position')->orderBy('created_at', 'desc');
    }
}