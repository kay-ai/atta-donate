<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'user_id',
        'amount',
        'currency',
        'status',
    ];

    public function donation(){
        return $this->hasOne(Donation::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
