<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Main;
use App\User;
use Session;
use App\Donatori;
use App\Podrska;
use App\Updates;
use App\Komentari;
use App\Komentariobjava;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
Use Log;

class PodrskaController extends Controller
{

    public function jospodrzalih()
    {
        $jospodrzalih = Podrska::whereslug(Input::get('slug'))->orderBy('id', 'ASC')
            ->skip(Input::get('skip'))
            ->take(50)
            ->get();
        
        return \Response::json($jospodrzalih);
    }
}

