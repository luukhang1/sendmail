<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    public $fillable = [];

    protected function getTypeAttribute($value)
    {
        return $value == 1 ? 'Momo' : 'Bank';
    }
    protected function getActiveAttribute($value)
    {
        return $value == 1 ? 'Active' : 'Disable';
    }
    
    
}
    
