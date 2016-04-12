<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Main;
use App\User;
use Event;
use App\Events\ItemCreated;
use App\Donatori;
use App\Podrska;
use App\Poruke;
use App\Poruke1;
use App\Updates;
use App\Komentari;
use App\Komentariobjava;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
Use Log;

class PorukeController extends Controller
{

    public function slanje()
    {
        $vreme = date("Y-m-d, H:i");
        $user = Auth::user()->fullname;
        $slika = Auth::user()->slika;
        $user_id = Auth::user()->id;
        $receiver = User::wherefullname(Input::get('autor2'))->first()->id;
        
        $temp = Poruke::where(function ($query) use($receiver) {
            $query->where('receiver', '=', $receiver)->where('sender', '=', Input::get('sender'));
        })->orWhere(function ($query) use($receiver) {
            $query->where('receiver', '=', Input::get('sender'))
                ->where('sender', '=', $receiver);
        })
            ->first();
        
        if (! $temp) {
            
            $array = array(
                'receiver' => $receiver,
                'sender' => Input::get('sender'),
                'text' => Input::get('text'),
                'vreme' => $vreme,
                'readunread' => Auth::user()->email,
                'autor' => Input::get('autor'),
                'autor2' => Input::get('autor2')
            );
            
            $id = Poruke::insertGetId($array);
            
            $array = array(
                'receiver' => $receiver,
                'sender' => Input::get('sender'),
                'text' => Input::get('text'),
                'vreme' => $vreme,
                'poruka_id' => $id
            );
            Poruke1::insert($array);
        } else {
            
            $array = array(
                'receiver' => $receiver,
                'sender' => Input::get('sender'),
                'text' => Input::get('text'),
                'vreme' => $vreme,
                'poruka_id' => $temp->id
            );
            $idi = Poruke1::insertGetId($array);
            
            $podcast = Poruke1::whereid($idi)->first();
            Event::fire(new ItemCreated($podcast));
        }
        
        return Redirect::to('/users/poruke/' . Auth::user()->id);
    }
}
