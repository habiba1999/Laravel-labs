<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory,Sluggable;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'slug'
    ];
    public function user(){
        return $this->belongsTo(related:User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function sluggable():array{
        return [
            'slug'=>[
                'source'=>['title']
            ]
            ];
    }
}
