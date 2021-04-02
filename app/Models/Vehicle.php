<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mark_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($vehicle) {
            $vehicle->colors()->detach();
        });
    }

    public function mark()
    {
        return $this->belongsTo(Mark::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }
}
