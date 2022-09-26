<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'password',
        'phone',
        'status',
        'dob',
        'classroom_id',
        'about_me',
        'customer_type_id',
        'school'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }

    public function customer_type(){
        return $this->belongsTo(CustomerType::class);
    }
}
