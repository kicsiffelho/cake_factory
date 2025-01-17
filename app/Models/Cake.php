<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cake extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'price',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
