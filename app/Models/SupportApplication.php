<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'support_type',
        'first_name',
        'last_name',
        'gender',
        'email',
        'phone',
        'area_of_interest',
        'cv',
        'institution',
        'message'
    ];
}
