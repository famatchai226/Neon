<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'file_path',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
