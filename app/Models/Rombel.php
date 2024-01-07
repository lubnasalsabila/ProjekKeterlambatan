<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rombel extends Model
{
    use HasFactory;
    protected $fillable=[
        'rombel',
    ];

    public function student(){
        return $this->hasMany(Student::class, 'rombel_id');
    }
}
