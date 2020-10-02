<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class photo extends Model
{
    protected $table = 'photoable';
    protected $fillabel = ['filename'];
    protected $guarded = ['id']; 

    public function photoable(){
        return $this->morphTo('App\photo');
    }
}
