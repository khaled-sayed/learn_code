<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class photo extends Model
{
    protected $table = 'photoable';
    protected $fillabel = ['filename'];

    public function photoable(){
        return $this->morphTo('App\photo');
    }
}
