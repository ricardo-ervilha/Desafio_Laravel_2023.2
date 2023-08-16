<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnostic',
        'guidelines',
        'medicines',
        'extraInfos'
    ];

    public function consultation()
    {
        return $this->hasOne(Consultation::class);
    }
}
