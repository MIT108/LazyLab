<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'image', 'classroom_id', 'status'
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
    public function lesson()
    {
        return $this->hasMany(Lesson::class);
    }

    public function getImageAttribute($value)
    {
        return env('APP_URL') . Storage::url("subject/" . $value);
    }
    
}