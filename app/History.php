<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    //
    protected $table = 'history';
    public $fillable = ['status', 'total_money', 'user_id', 'money_id'];
    public $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
