<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $fillable = [
        'cep',
        'publicPlace',
        'district',
        'uf',
        'city',
        'num'
    ];

    public function user()
    {
        $this->hasOne(User::class);
    }

    public function owner()
    {
        $this->hasOne(Owner::class);
    }

    use HasFactory;
}
