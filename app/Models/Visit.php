<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'pet_id',
        'visit_date',
        'status',
        'weight',
        'notes',
        'follow_up'
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}