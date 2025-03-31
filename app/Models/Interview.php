<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    protected $fillable = ['den_application_id', 'interview_date', 'interview_time', 'venue'];

    public function denApplication()
    {
        return $this->belongsTo(DenApplication::class, 'den_application_id');
    }
}
