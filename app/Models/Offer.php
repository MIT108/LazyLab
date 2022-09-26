<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'recommended', 'price', 'description'
    ];

    public function offer_detail(){
        return $this->hasMany(OfferDetail::class);
    }
}

