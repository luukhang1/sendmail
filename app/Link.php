<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Link extends Model
{
    //
    use Sluggable;
    public $timestamps = true;
    protected $fillable = ['title', 'linkfile', 'linkyoutube','title', 'user_id', '_link'];
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
