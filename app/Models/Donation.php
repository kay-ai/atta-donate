<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_id',
        'amount',
        'donation_type',
        'location',
        'message'
    ];

    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
