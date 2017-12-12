<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $guarded = [];

    protected $hidden = ['updated_at', 'created_at'];
}
