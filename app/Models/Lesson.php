<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'subject_id', 'status'
    ];

    public function lesson_detail(){
        return $this->hasMany(LessonDetail::class);
    }


}