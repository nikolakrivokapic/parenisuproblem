<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Main;
use App\User;
use App\Email;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
Use Log;

class EmailController extends Controller
{

    public function pretplati()
    {
        Email::insert([
            'email' => Input::get('email'),
            'kampanja_id' => Input::get('id')
        ]);
    }
}
