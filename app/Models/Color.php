<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class);
    }
}
