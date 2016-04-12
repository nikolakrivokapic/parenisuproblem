<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Updates extends Model
{
    //

protected $table = 'updates';
public $timestamps = false;
 public function komentariobjava()
    {
        return $this->hasMany('App\Komentariobjava','update_id')->orderBy('id','DESC')->take(12); 
    }
}
