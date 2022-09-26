<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'offer_id'
    ];
    public function offer(){
        return $this->belongsTo(Offer::class);
    }
}
