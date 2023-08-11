<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'cpf',
        'dateBirth',
        'address_id',
        'phone',
        'profilePhoto'
    ];

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
}
