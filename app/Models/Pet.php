<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Species;
use App\Models\Breed;

class Pet extends Model
{
    protected $fillable = [
        'pet_name',
        'owner_name',
        'species_id',
        'breed_id',
        'age_value',
        'age_unit',
        'gender',
        'health_status',
        'last_visit',
        'weight',
        'notes',
        'photo'
    ];

    public function species()
    {
        return $this->belongsTo(Species::class);
    }

    public function breed()
    {
        return $this->belongsTo(Breed::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}