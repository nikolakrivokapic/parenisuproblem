@extends('layout')
@include('head')
@include('header_pages')

@section('content')
<div style="padding-top:100px;padding-bottom:300px;padding-left:20px;">
<form method="POST" action="{{ URL::to('/') }}/password/email">
    {!! csrf_field() !!}

@if (Session::get('errors'))

        <ul>
            @foreach (Session::get('errors')->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    @endif
<br>
    <div style="width:300px;">
        Email:
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div style="padding-top:5px;">
        <button class="f-button primary f-fw-bold f-fc-black" type="submit">
            Pošalji link za resetovanje šifre
        </button>
    </div>
</form>
   </div>
@endsection