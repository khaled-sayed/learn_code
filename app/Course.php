<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillabel = ['title','status'];

    protected $timestamp = false;

    public function photo(){
        return $this->morphOne('App\photo', 'photoable');
    }

    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function quizzes(){
        return $this->hasMany('App\Quiz');
    }

    public function track(){
        return $this->belongsTo('App\Track');
    }

    public function Videos(){
        return $this->hasMany('App\Video');
    }
}
