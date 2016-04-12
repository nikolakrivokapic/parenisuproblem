<!-- resources/views/auth/login.blade.php -->
@extends('layout1')

@section('content')


<form method="POST" action="./login">
 {!! csrf_field() !!}
<input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div>
       Email:<br>
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Šifra:<br>
        <input type="password" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Zapamti
    </div>                                  <br>

    <a href="{{ URL::to('/') }}/auth/reminder">ZABORAVLJEN PASSWORD?</a>

    <div>      </br>
        <button type="submit">Prijava</button>
    </div>

      <div class="row">
        <div class="col-md-6">
        	<h2>Prijavite se putem socijalnih mreza</h2>
            <a href="{{ URL::to('/') }}/auth/social/facebook">Facebook</a>
            <a href="{{ URL::to('/') }}/auth/social/google">Google</a>
        </div>






    </div>
</form>

@endsection