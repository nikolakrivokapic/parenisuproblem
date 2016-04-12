<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poruke1 extends Model
{
    //

protected $table = 'poruke1';

   public function poruke()
    {
        return $this->belongsTo('App\Poruke');
    }




}
