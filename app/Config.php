<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    //
    protected $table = 'config';
    protected $fillable = ['status', 'user_id','price', 'domain'];

    protected function getStatusAttribute($data)
    {
        return $data == 1 ? 'Active' : 'Pending';
    }

}
