<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $table=  'dosen';
    protected $fillable = [
        'NID',
        'namaD',
        'matkul_id',
        'alamat',
    ];

    public function matkul()
    {
        return $this->belongsTo(Matkul::class);
    }
}