<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dateBirth',
        'species',
        'breed'
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }
}
