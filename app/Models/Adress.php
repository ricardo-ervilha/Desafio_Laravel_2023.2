<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adress extends Model
{
    protected $table = 'addresses';

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
