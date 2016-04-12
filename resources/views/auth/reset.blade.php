@extends('layout')
@include('head')
@include('header_pages')
@section('content')
<!-- resources/views/auth/reset.blade.php -->
<div style="padding-top:100px;padding-bottom:300px;padding-left:20px;">
Ukucajte novu sifru:
<form method="POST" action="{{ URL::to('/') }}/password/reset">
    {!! csrf_field() !!}
    <input type="hidden" name="token" value="{{ $token }}">

    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
<br>
    <div style="width:300px;">
        Email:
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div style="width:300px;">
        Nova sifra:
        <input type="password" name="password">
    </div>

    <div style="width:300px;">
       Ponovi novu sifru:
        <input type="password" name="password_confirmation">
    </div>

    <div style="padding-top:5px;">
        <button class="f-button primary f-fw-bold f-fc-black" type="submit">

            Sacuvaj
        </button>
    </div>
</form>
</div>
@endsection