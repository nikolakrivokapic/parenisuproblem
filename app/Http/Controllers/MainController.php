<?php
namespace App\Http\Controllers;

// use Illuminate\Http\Request;
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
use App\Komentariobjava;
use Request;
use View;
use Session;

class MainController extends Controller
{

    public function index()
    {
        $projects = Main::orderBy('id', 'DESC')->wherelive('da')->paginate(9);
        $count = Main::count();
        
        if (Request::ajax()) {
            return \Response::json(View::make('posts', array(
                'projects' => $projects
            ))->render());
        }
        
        if (Auth::check()) {
            $user = Auth::user();
            $kampanje = Main::whereobjavio($user->fullname)->get();
            
            $brojneprocitanih = Poruke::where(

            function ($query) {
                
                $query->where('receiver', '=', Auth::user()->id)->

                orWhere('sender', '=', Auth::user()->id);
            })->

            where('readunread', 'NOT LIKE', '%' . Auth::user()->email . '%')
                ->orderBy('id', 'DESC')
                ->count();
            
            return view('users.home', compact('projects', 'count', 'user', 'kampanje', 'brojneprocitanih', 'lokacije'));
        } 

        else {
            return view('main.index', compact('projects', 'count'));
        }
    }

    public function kategorija($kategorija)
    {
        $projects = Main::wherekategorija($kategorija)->orderBy('id', 'DESC')
            ->wherelive('da')
            ->paginate(9);
        $count = Main::count();
        
        if (Request::ajax()) {
            
            return \Response::json([
                View::make('posts', array(
                    'projects' => $projects
                ))->render()
            ]);
        }
        
        if (Auth::check()) {
            $user = Auth::user();
            $kampanje = Main::whereobjavio($user->fullname)->get();
            
            $brojneprocitanih = Poruke::where(

            function ($query) {
                
                $query->where('receiver', '=', Auth::user()->id)->

                orWhere('sender', '=', Auth::user()->id);
            })->

            where('readunread', 'NOT LIKE', '%' . Auth::user()->email . '%')
                ->orderBy('id', 'DESC')
                ->count();
            
            return view('users.home', compact('projects', 'count', 'user', 'kampanje', 'brojneprocitanih'));
        } 

        else {
            return view('main.index', compact('projects', 'count'));
        }
    }

    public function lokacija($lokacija)
    {
        $projects = Main::wherelokacija($lokacija)->wherelive('da')
            ->orderBy('id', 'DESC')
            ->paginate(9);
        $count = Main::count();
        if (Auth::check()) {
            $user = Auth::user();
            $kampanje = Main::whereobjavio($user->fullname)->get();
            
            $brojneprocitanih = Poruke::where(

            function ($query) {
                
                $query->where('receiver', '=', Auth::user()->id)->

                orWhere('sender', '=', Auth::user()->id);
            })->

            where('readunread', 'NOT LIKE', '%' . Auth::user()->email . '%')
                ->orderBy('id', 'DESC')
                ->count();
            
            return view('users.home', compact('projects', 'count', 'user', 'kampanje', 'brojneprocitanih'));
        } 

        else {
            return view('main.index', compact('projects', 'count'));
        }
    }

    public function oznaka($oznaka)
    {
        $projects = Main::whereoznaka($oznaka)->orderBy('id', 'DESC')
            ->wherelive('da')
            ->paginate(9);
        $count = Main::count();
        if (Request::ajax()) {
            return \Response::json(View::make('posts', array(
                'projects' => $projects
            ))->render());
        }
        if (Auth::check()) {
            $user = Auth::user();
            $kampanje = Main::whereobjavio($user->fullname)->get();
            
            $brojneprocitanih = Poruke::where(

            function ($query) {
                
                $query->where('receiver', '=', Auth::user()->id)->

                orWhere('sender', '=', Auth::user()->id);
            })->

            where('readunread', 'NOT LIKE', '%' . Auth::user()->email . '%')
                ->orderBy('id', 'DESC')
                ->count();
            
            return view('users.home', compact('projects', 'count', 'user', 'kampanje', 'brojneprocitanih'));
        } 

        else {
            return view('main.index', compact('projects', 'count'));
        }
    }

    public function show($slug)
    {
        $projects = Main::orderBy('lokacija', 'ASC')->wherelive('da')->get(array(
            'lokacija'
        ));
        $project = Main::whereslug($slug)->first();
        // $mjesta= Main::wherelokacija($project->lokacija)->orderBy('id', 'DESC')->paginate(5);
        $objavio = User::wherefullname($project->objavio)->first();
        $updates = Updates::whereslug($slug)->with('komentariobjava')
            ->orderBy('id', 'DESC')
            ->get();
        $last_update = Updates::whereslug($slug)->orderBy('id', 'desc')->first();
        $komentari = Komentari::orderBy('id', 'DESC')->whereslug($slug)
            ->take(12)
            ->get();
        Session::set('loaded_komentari', 12);
        $komentari_objave = Komentariobjava::with('updates')->orderBy('id', 'DESC')
            ->whereslug($slug)
            ->get();
        $donatori = Donatori::orderBy('iznos', 'DESC')->whereslug($slug)->get();
        $podrska = Podrska::whereslug($slug)->get();
        $count = Komentari::whereslug($slug)->count();
        $podrska1 = json_encode($podrska);
        $brojneprocitanih = 0;
        if (Auth::check()) {
            $brojneprocitanih = Poruke::where(

            function ($query) {
                
                $query->where('receiver', '=', Auth::user()->id)->

                orWhere('sender', '=', Auth::user()->id);
            })->

            where('readunread', 'NOT LIKE', '%' . Auth::user()->email . '%')
                ->orderBy('id', 'DESC')
                ->count();
            
            $kampanje = Main::whereobjavio(Auth::user()->fullname)->get();
        }
        return view('kampanje.index_kampanje', compact('project', 'updates', 'last_update', 'count', 'komentari', 'donatori', 'podrska', 'projects', 'komentari_objave', 'brojneprocitanih', 'objavio', 'kampanje', 'mjesta'));
    }

    public function nova()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $kampanje = Main::whereobjavio($user->fullname)->get();
            
            $brojneprocitanih = Poruke::where(

            function ($query) {
                
                $query->where('receiver', '=', Auth::user()->id)->

                orWhere('sender', '=', Auth::user()->id);
            })->

            where('readunread', 'NOT LIKE', '%'.Auth::user()->email .'%')->orderBy('id', 'DESC')->count();


            return view('users.nova',compact('user','kampanje','brojneprocitanih'));
            }

     else  {  	return view('kampanje.nova');
     }

    }


}
