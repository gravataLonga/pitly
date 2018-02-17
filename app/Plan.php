<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public function getPriceAttribute($value)
    {
        return number_format($this->amount/100, 2, ',', '');
    }
}
