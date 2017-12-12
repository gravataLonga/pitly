<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shorten extends Model
{
    protected $guarded = [];

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
}
