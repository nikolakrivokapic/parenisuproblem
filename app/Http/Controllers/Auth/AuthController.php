<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Project;
use App\Main;
use App\Poruke;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Socialize;
    use Illuminate\Support\Facades\Input;
  use Illuminate\Support\Facades\Redirect;
use Log;

class AuthController extends Controller
{
protected $redirectTo = './projects';
protected $redirectAfterLogout = './projects';
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fullname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'password' => md5($data['password']),
        ]);
    }


      public function redirectToProvider($provider)
    {
        return Socialize::with($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
       $user = Socialize::with($provider)->user();

        // $user->token;

         if($user1 = User::where('email', '=', $user->email)->first()){

  //  Auth::login($user);
    Auth::login($user1);

// return Redirect::to('/');




$kampanje = Main::whereobjavio($user1->fullname)->get();
 $brojneprocitanih = Poruke::where

    (function ($query) {

    $query->where('receiver', '=', Auth::user()->id)

->orWhere('sender', '=', Auth::user()->id);


})

  ->where('readunread', 'NOT LIKE', '%'.Auth::user()->email .'%')->orderBy('id', 'DESC')->count();



return Redirect::back()->with('kampanje',$kampanje)->with('brojneprocitanih',$brojneprocitanih);



     }

     else {

if($provider=="facebook") {
$slika = 'http://graph.facebook.com/'.$user->id.'/picture';
}
else if($provider=="google") {
$slika = "";
}
 $location = file_get_contents('http://freegeoip.net/json/'.$_SERVER['REMOTE_ADDR']);
$loc = json_decode($location);
         User::insert(
    array(

    'fullname' => $user->name, 'email' => $user->email,'datum_reg' => date("d-m-Y") ,

 'provider_id' => $user->id, 'slika' => $slika, 'grad'=>$loc->city)
);

 $user1 = User::where('email', '=', $user->email)->first();

    Auth::login($user1);
// return Redirect::to('/');


$kampanje = Main::whereobjavio($user1->fullname)->get();
 $brojneprocitanih = Poruke::where

    (function ($query) {

    $query->where('receiver', '=', Auth::user()->id)

->orWhere('sender', '=', Auth::user()->id);


})

  ->where('readunread', 'NOT LIKE', '%'.Auth::user()->email .'%')->orderBy('id', 'DESC')->count();



return Redirect::back()->with('kampanje',$kampanje)->with('brojneprocitanih',$brojneprocitanih);



     }



    }


          public function reminder()
    {

            return view('auth.password');

    }


    public function registracija() {

 $location = file_get_contents('http://freegeoip.net/json/'.$_SERVER['REMOTE_ADDR']);

$loc = json_decode($location);


 $user=   User::insert(
    array('fullname' =>  Input::get('fullname')  , 'email' =>  Input::get('email')  ,
    'password' =>    password_hash ( Input::get('password'), PASSWORD_DEFAULT) , 'datum_reg' => date("d-m-Y"), 'grad'=> $loc->city )
    );

   $user = User::whereemail(Input::get('email'))->first();

   Auth::login($user);
   return Redirect::back();   


    }



        public function logovanje() {


 //  $matchThese = ['email' => Input::get('email')];

   $user = User::whereemail(Input::get('email'))->first();
   if(password_verify(Input::get('password'), $user->password)) {

   Auth::login($user);
$kampanje = Main::whereobjavio($user->fullname)->get();
 $brojneprocitanih = Poruke::where

    (function ($query) {

    $query->where('receiver', '=', Auth::user()->id)

->orWhere('sender', '=', Auth::user()->id);


})

  ->where('readunread', 'NOT LIKE', '%'.Auth::user()->email .'%')->orderBy('id', 'DESC')->count();

        return Redirect::back()->with('kampanje',$kampanje)->with('brojneprocitanih',$brojneprocitanih);
   }
   else {
        return view('users.wrongpass');
   }



    }




}
