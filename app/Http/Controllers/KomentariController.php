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

class KomentariController extends Controller
{

        public function unesi($slug)
    {

    $vreme = date("Y-m-d, H:i");
    $user = Auth::user()->fullname;
      $slika = Auth::user()->slika;
          $user_id = Auth::user()->id;

        $array = array('slug'=>$slug, 'user'=>$user,  'text' => Input::get('text'), 'slika' => $slika, 'user_id' => $user_id,
             'vreme' => $vreme );


             Komentari::insert($array);
              return Redirect::to('/'.$slug);


 }




        public function naobjavu($id)
    {

    $vreme = date("Y-m-d, H:i");
    $user = Auth::user()->fullname;
      $slika = Auth::user()->slika;
          $user_id = Auth::user()->id;

        $array = array('user'=>$user,  'text' => Input::get('text'),  'slug' => Input::get('slug'), 'slika' => $slika, 'update_id' => Input::get('update_id'),     'user_id' => $user_id,
             'vreme' => $vreme );


             Komentariobjava::insert($array);
            return Redirect::back();


 }

 public function joskomentara() {

                     

         $joskomentara=    Komentari::whereslug(Input::get('slug'))->orderBy('id','DESC')->skip(Input::get('skip'))->take(12)->get();




                       return   \Response::json($joskomentara);
 }


  public function brisanjekomentara() {

     Komentari::whereid(Input::get('id'))->delete();

 }






}
