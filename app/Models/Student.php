<?php

namespace App\Models;

use App\Models\Rayon;
use App\Models\Rombel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'nis',
        'name',
        'rombel_id',
        'rayon_id',
    ];

    public function rombel(){
        return $this->belongsTo(Rombel::class, 'rombel_id');
    }
    public function rayon(){
        return $this->belongsTo(Rayon::class, 'rayon_id');
    }
    public function late(){
        return $this->hasMany(Late::class);
    }
}
