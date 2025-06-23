<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PopulationStatistic extends Model
{
    protected $fillable = [
        'year',
        'total_male',
        'total_female',
        'productive_age',
        'elderly',
        'children',
        'education_primary',
        'education_secondary',
        'education_higher',
        'job_farmers',
        'job_fishermen',
        'job_others',
    ];

    protected $casts = [
        'year' => 'integer',
        'total_male' => 'integer',
        'total_female' => 'integer',
        'productive_age' => 'integer',
        'elderly' => 'integer',
        'children' => 'integer',
        'education_primary' => 'integer',
        'education_secondary' => 'integer',
        'education_higher' => 'integer',
        'job_farmers' => 'integer',
        'job_fishermen' => 'integer',
        'job_others' => 'integer',
    ];

    public function scopeRecent($query)
    {
        return $query->orderBy('year', 'desc');
    }

    public function scopeByYear($query, $year)
    {
        return $query->where('year', $year);
    }

    // Helper method to get total population
    public function getTotalPopulationAttribute()
    {
        return $this->total_male + $this->total_female;
    }
}
