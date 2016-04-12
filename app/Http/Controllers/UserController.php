<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Main;
use App\User;
use App\Donatori;
use App\Podrska;
use App\Updates;
use App\Komentari;
use App\Poruke;
use App\Poruke1;
use Session;
use Event;

use App\Events\ItemCreated;

use DB;
    use Illuminate\Support\Facades\Input;
  use Illuminate\Support\Facades\Redirect;
  use Illuminate\Support\Facades\URL;
  Use Log;

class UserController extends Controller
{

        public function index()
    {



    }



            public function show($slug)
    {



    }


           public function podesavanja()

    {
        $user=Auth::user();
        $kampanje = Main::whereobjavio($user->fullname)->get();
         	return view('users.podesavanja', compact('user','kampanje'));

    }


               public function snimi($id)
    {


             User::whereid($id)->update(array('grad' =>   Input::get('grad') ));
                   return Redirect::to('/users/podesavanja');
    }


                   public function slika($id)
    {

            Log::info("slika". Input::get('slika')) ;













              $target_dir = "slike/";
$target_file = $target_dir . basename($_FILES["slika"]["name"]);
 Log::info("slika". basename($_FILES["slika"]["name"])) ;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["slika"]["tmp_name"]);
    if($check !== false) {
       echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Fajl nije slika!\n";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
 //   echo "Sorry, file already exists.\n";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["slika"]["size"] > 800000) {
    echo "Slika je prevelike velicine, smanjite kvalitet pa probajte opet.\n";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
//    echo "Samo slike sa JPG, JPEG, PNG & GIF ekstenzijama su dozvoljene.\n";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  //  echo "Jedan od fajlova nije uploadovan.\n";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["slika"]["tmp_name"], $target_file)) {
  //      echo "The file ". basename( $_FILES[$value]["name"]). " has been uploaded.";

 $logo = "http://phplaravel-12652-27729-66788.cloudwaysapps.com/slike/".basename($_FILES["slika"]["name"]);


    } else {
        echo "Greska u slanju slike.\n";
    }

}
  $logo = URL::to('/').'/slike/'.basename($_FILES["slika"]["name"]);




             User::whereid($id)->update(array('slika' =>   $logo));
                   return Redirect::to('/users/podesavanja');
    }




         public function profil($id) {


            $user = User::whereid($id)->first();
           if(!$user) {
            $user =  User::wherefullname($id)->first();
            }


            $prikupio = Main::whereobjavio($user->fullname)->sum('skupljeno');
           // $donirao = Donatori::whereime_donatora($user->fullname)->sum('iznos');
           $podrzao = Podrska::whereime_suportera($user->fullname)->count();
          $kampanje = Main::whereobjavio($user->fullname)->get();
        $brojneprocitanih=0;
    if(Auth::check()) {
           $brojneprocitanih = Poruke::where

    (function ($query) {

    $query->where('receiver', '=', Auth::user()->id)

->orWhere('sender', '=', Auth::user()->id);


})

  ->where('readunread', 'NOT LIKE', '%'.Auth::user()->email .'%')->orderBy('id', 'DESC')->count();
    }
         	return view('users.profile', compact('user','prikupio', 'podrzao', 'kampanje','brojneprocitanih'));


         }



         public function poruke($id) {


            $user = User::whereid($id)->first();
                 $kampanje = Main::whereobjavio($user->fullname)->get();

          $poruke=Poruke::with('poruke1')->where('receiver', $id)->orWhere('sender', $id)->orderBy('id', 'DESC')->take(5)->get()->map(function( $category ){
                $category->poruke1 = $category->poruke1->take(5);

                return $category;
});
          Session::set('loaded', 5);
       $brojneprocitanih = Poruke::where

    (function ($query) {

    $query->where('receiver', '=', Auth::user()->id)

->orWhere('sender', '=', Auth::user()->id);


})

  ->where('readunread', 'NOT LIKE', '%'.Auth::user()->email .'%')->orderBy('id', 'DESC')->count();

        	return view('users.poruke', compact('user','poruke','kampanje','brojneprocitanih'));
      //   var_dump($poruke);
       //Log::info($poruke);

         }



                  public function poruke1($id,$fullname) {


            $user = User::whereid($id)->first();
             $user2 = User::wherefullname($fullname)->first();
                 $kampanje = Main::whereobjavio($user->fullname)->get();
              $id1=$user2->id;
             $porukenove=Poruke1::where(function($query) use ($id,$id1) {
    $query->where('receiver', '=', $id)
          ->where('sender', '=',  $id1);
})->orWhere(function ($query) use ($id,$id1) {
    $query->where('receiver', '=', $id1)
          ->where('sender', '=', $id);
})
->orderBy('id', 'DESC')->take(5)->get();
 $poruke=Poruke::with('poruke1')->where('receiver', $id)->orWhere('sender', $id)->orderBy('id', 'DESC')->take(5)->get()->map(function( $category ){
                $category->poruke1 = $category->poruke1->take(5);

                return $category;
});


$tt = Poruke::where(function($query) use ($id,$id1) {
    $query->where('receiver', '=', $id)
          ->where('sender', '=',  $id1);
})->orWhere(function ($query) use ($id,$id1) {
    $query->where('receiver', '=', $id1)
          ->where('sender', '=', $id);
})->first();

 if(strpos($tt->readunread, Auth::user()->email) === false) {
    $tt->readunread =   $tt->readunread.Auth::user()->email;
    $tt->save();
  }

          Session::set('loaded', 5);

     $autordrugi = "";
         $autormoj =   "";
  if($tt->autor==Auth::user()->fullname) {

         $autordrugi = $tt->autor2;
         $autormoj =    $tt->autor;
         }
         else    {
           $autordrugi = $tt->autor;
         $autormoj =    $tt->autor2;
         }
         $brojneprocitanih = Poruke::where

    (function ($query) {

    $query->where('receiver', '=', Auth::user()->id)

->orWhere('sender', '=', Auth::user()->id);


})

  ->where('readunread', 'NOT LIKE', '%'.Auth::user()->email .'%')->orderBy('id', 'DESC')->count();
        	return view('users.poruke', compact('user','poruke','porukenove','kampanje','tt','autormoj','autordrugi','brojneprocitanih'));
      //   var_dump($poruke);
       //Log::info($poruke);

         }



            public function odgovor() {

           $vreme = date("Y-m-d, H:i:s");



       $idi=    Poruke1::insertGetId(
    array(

    'sender' => Input::get('sender'), 'receiver' => Input::get('receiver'),

 'poruka_id' =>Input::get('poruka_id'),'vreme' => $vreme, 'text' => Input::get('text') )
);

 $podcast = Poruke1::whereid($idi)->first();
 Event::fire(new ItemCreated($podcast));

      $id = Input::get('sender');
      $id1=Input::get('receiver');
       $tt = Poruke::where(function($query) use ($id,$id1) {
    $query->where('receiver', '=', $id)
          ->where('sender', '=',  $id1);
})->orWhere(function ($query) use ($id,$id1) {
    $query->where('receiver', '=', $id1)
          ->where('sender', '=', $id);
})->orderBy('id','DESC')->first();


           $tt->readunread = Auth::user()->email;
    $tt->save();
 if(strpos($tt->readunread, Auth::user()->email)===true) {



  }



         }


               public function loadmore(){



         $poruke=Poruke1::where(function ($query) {
    $query->where('receiver', '=', Input::get('id1'))
          ->where('sender', '=', Input::get('id'));
})->orWhere(function ($query) {
    $query->where('receiver', '=', Input::get('id'))
          ->where('sender', '=', Input::get('id1'));
})
->orderBy('id', 'DESC')->take(Session::get('loaded')+7)->get();

            Session::set('loaded', Session::get('loaded')+7);

            $p= Poruke::where(function ($query) {
    $query->where('receiver', '=', Input::get('id1'))
          ->where('sender', '=', Input::get('id'));
})->orWhere(function ($query) {
    $query->where('receiver', '=', Input::get('id'))
          ->where('sender', '=', Input::get('id1'));
})
->orderBy('id', 'DESC')->first();
         $autor='';
               if($p->autor==Auth::user()->fullname) {

         $autor = $p->autor2;
         }
         else    {
         $autor = $p->autor;
         }

foreach ($poruke as $poruka) {
      $poruka->autor=$autor;

}
      return   \Response::json($poruke);
      //   return $poruke;


         }




                        public function check(){


         $poruke=Poruke::where(function ($query) {
    $query->where('receiver', '=', Input::get('id1'))
          ->where('sender', '=', Input::get('id'));
})->orWhere(function ($query) {
    $query->where('receiver', '=', Input::get('id'))
          ->where('sender', '=', Input::get('id1'));
})
->orderBy('id','DESC')->first();

    $drugi = "";
if( Input::get('id')==Auth::user()->id )
{
    $drugi = Input::get('id1');
}
else {

      $drugi =    Input::get('id');
}
$prvi= Auth::user()->email;
$ostali=Poruke::where(function ($query) use($drugi) {

    $query->where('receiver', '=', Auth::user()->id)
          ->where('sender','!=',$drugi)
->orWhere('sender', '=', Auth::user()->id)
    ->where('receiver','!=', $drugi);

})->where('readunread', 'NOT LIKE', '%'.$prvi .'%')

-> orderBy('id','DESC')->first();
       if(count($ostali)) {
        Log::info($ostali->sender);
        Log::info($ostali->receiver);
          Session::set('sender', $ostali->sender);
              Session::set('receiver', $ostali->receiver);
     }
     else {
        Session::set('sender', "");
        Session::set('receiver', "");

     }
    if( strlen(strstr($poruke->readunread,Auth::user()->email))>0   ) {

        if(count($ostali))  {



        }
    return 0;
     }
     else {

         if($poruke->autor==Auth::user()->fullname) {

         $autor = $poruke->autor2;
         }
         else    {
         $autor = $poruke->autor;
         }
      Session::set('autor', $autor);
         return 1;
     }

        }



              public function loadnew(){

    $id1=    Input::get('id1');
    $id=  Input::get('id');

         $poruke=Poruke1::where(function ($query) {
    $query->where('receiver', '=', Input::get('id1'))
          ->where('sender', '=', Input::get('id'));
})->orWhere(function ($query) {
    $query->where('receiver', '=', Input::get('id'))
          ->where('sender', '=', Input::get('id1'));
})
->orderBy('id','DESC')->first();




       $tt = Poruke::where(function($query) use ($id,$id1) {
    $query->where('receiver', '=', $id)
          ->where('sender', '=',  $id1);
})->orWhere(function ($query) use ($id,$id1) {
    $query->where('receiver', '=', $id1)
          ->where('sender', '=', $id);
})->orderBy('id','DESC')->first();

if( !strlen(strstr($tt->readunread,Auth::user()->email))>0  ) {

          $tt->readunread = $tt->readunread . Auth::user()->email;
    $tt->save();
          return   \Response::json($poruke);

    }



         }



}
