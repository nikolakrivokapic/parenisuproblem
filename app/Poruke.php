<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Poruke extends Model
{
    //
    public $timestamps = false;

    protected $table = 'poruke';

    public function poruke1()
    {
        return $this->hasMany('App\Poruke1', 'poruka_id')->orderBy('id', 'DESC');
    }

    public function porukesve()
    {
        return $this->hasMany('App\Poruke1', 'poruka_id')->orderBy('id', 'DESC');
    }

    public function getPoruke1PaginatedAttribute()
    {
        return $this->poruke1()
            ->orderBy('id', 'DESC')
            ->paginate(5);
    }
}
