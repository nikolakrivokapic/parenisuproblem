<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentariobjava extends Model
{
    //
    protected $table = 'komentari_objava';

    public function updates()
    {
        return $this->belongsTo('App\Updates');
    }
}
