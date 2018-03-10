<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shorten extends Model
{
    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->token = str_random(6);
        });
    }

    public function stats()
    {
        return $this->hasMany(Stat::class);
    }

    public function getCreatedAttribute()
    {
        return $this->created_at->format('j F, Y');
    }
}
