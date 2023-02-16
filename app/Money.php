<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Money extends Model
{
    //
    protected $table = 'money';
    public $fillable = ['status', 'price', 'view', 'user_id'];
    public $guarded = [];
}
