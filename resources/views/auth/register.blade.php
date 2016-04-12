<!-- resources/views/auth/register.blade.php -->
 @extends('layout1')

@section('content')

<form method="POST" action="./register">
    {!! csrf_field() !!}

        Vaše ime:<br>
    <div>
        <input type="text" name="fullname" value="{{ old('fullname') }}">
    </div>

        Email:<br>
    <div>
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

        Šifra:<br>
    <div>
        <input type="password" name="password">
    </div>

        Ponovite Šifru:<br>
    <div>
        <input type="password" name="password_confirmation">
    </div>

    <div>
        <button type="submit">Registracija</button>
    </div>
</form>
@endsection