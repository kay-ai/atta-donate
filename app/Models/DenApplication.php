<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DenApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'country', 'city',
        'business_name', 'business_website', 'industry', 'business_stage',
        'idea_title', 'business_description', 'problem_statement',
        'target_audience', 'revenue_model', 'competitors', 'video_pitch',
        'funding_amount', 'funding_usage', 'co_founders', 'co_founders_details',
        'previous_funding', 'funding_source', 'terms_accepted'
    ];

    public function interview()
    {
        return $this->hasOne(Interview::class, 'den_application_id');
    }
}
