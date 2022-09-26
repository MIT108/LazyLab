<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Classroom extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image',
        'status'
    ];

    public function getImageAttribute($value){
        return env('APP_URL').Storage::url("classroom/".$value);
    }
    public function student(){
        return $this->hasMany(Student::class);
    }

    public function subject(){
        return $this->hasMany(Subject::class);
    }
}
