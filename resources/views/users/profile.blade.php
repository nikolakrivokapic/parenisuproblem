@extends('users.layout')

@section('profile-container')
 <script>
 function show(target) {
    document.getElementById(target).style.display = 'block';
}

function hide(target) {
    document.getElementById(target).style.display = 'none';
}

</script>

@if(Auth::check())

<form action="{{URL::to('/')}}/poruke/slanje" method="post">
<div id="contact" class="f-fs-medium f-popup f-z-popup" style="display:none;height: 6833px;position:fixed;z-index:9;">
  <div class="f-bg-black f-opacity-medium f-popup-overlay" style="height: 6833px;"></div>
  <div class="f-anim-fadeinup-fast f-bg-xlight f-br-medium f-fc-xdark f-popup-container f-pos-rel f-tl" style="width: 400px;position: fixed; margin-left: -200px;margin-top: -261px; top: 50%; left: 50%; height: 532px;">
    <i class="f-align-tr f-clickable f-fc-hover-dark f-fc-medium f-fs-xlarge f-m-medium f-popup-close fa fa-times" style="z-index: 100;" onclick="hide('contact')"></i>
    <script src="https://www.google.com/recaptcha/api.js" async:="" defer:=""></script>
<div class="f-p-medium">
  <h3>Kontaktiraj {{$user->fullname}} privatnom porukom</h3>
</div>
<div class="f-hr"></div>
<div class="f-font-condensed f-p-medium">
  <div class="f-grid-row f-m-b-small">
    <div class="f-grid-6of12 f-p-r-small">
      <h5>Vaše Ime</h5>
      <input type="text" name="name" value="" placeholder="{{Auth::user()->fullname}}" disabled>
    </div>
    <div class="f-grid-6of12 f-p-l-small">
      <h5>Email</h5>
      <input type="email" name="email" value="" placeholder="{{Auth::user()->email}}" disabled>
    </div>

  </div>
  <h5>Poruka</h5>
  <textarea name="text" style="height: 150px; resize: none"></textarea>

  <input type="hidden" name="autor2" value="{{$user->fullname}}">
  <input type="hidden" name="sender" value="@if(Auth::check()){{Auth::user()->id}}@endif">
  <input type="hidden" name="autor" value="@if(Auth::check()){{Auth::user()->fullname}}@endif">


</div>
  <input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="f-hr"></div>
<div class="f-flex-center-y f-p-medium">

     <button class="f-button f-flex-align-left js-submit primary" type="submit">Pošalji PORUKU</button>
  <div class="f-m-l-small js-loader" style="display:none">
    <div class="f-bg-light f-fs-small f-spinner-circles"></div>
  </div>
</div>
  </div>
</div>
</form>
  @endif



 <div class='f-width-100' style='height: 63px'></div>
<div class='f-page-container f-pos-rel f-p-t-xlarge f-p-b-xlarge f-font-condensed'>
<div class='f-grid-row'  >
<div class='f-grid-2of12 f-m-r-medium'>
<div class='f-avatar-large' style='background-image: url({{$user->slika}}?s=150)'></div>
<h3 class='f-caps  f-p-t-xsmall'>{{$user->fullname}}</h3>
<div class='f-fc-dark f-p-b-xsmall'>
{{$user->grad}}
</div>
@if($user->id != Auth::user()->id)
<div class='f-grid-row'>
<a class='f-button swatchone f-width-100 f-tc f-m-t-xsmall' href="#" onclick="show('contact')">Kontakt</a>
</div>
@endif
<div class='f-fc-dark f-p-t-xsmall f-p-b-xsmall'>
Registrovao se {{$user->datum_reg}}
</div>
<div class='f-grid-row'>
<div class='f-grid-row f-p-b-xsmall'>
<div class='f-ilb'>
<div class='f-bg-white f-pos-rel' style='border-radius: 50px; line-height: 1em'>
<div class='f-bg-facebook f-br-circle f-fl' style='padding: 0.6em 0.5em'>
<i class='f-fc-white fa fa-facebook fa-fw' style='font-size: 100%'></i>
</div>
<div class='f-fr' style='padding: 0.6em 0.5em 0.6em 0.2em'>
<i class='fa fa-check fa-fw' style='color: #61C791; font-size: 100%'></i>
</div>
<div style='clear: both'></div>
</div>

</div>
</div>
</div>
<div class='f-grid-row f-m-t-medium'>
<a href='{{URL::to('/')}}/users/podesavanja'>
<i class='fa fa-fw fa-gear'></i>
Podešavanja
</a>
</div>
</div>
<div class='f-grid-9of12 f-p-l-xlarge f-b-l f-b-light'>
<div class='f-bg-white f-p-y-small f-p-x-medium f-grid-row f-tl f-flex'>
<div class='f-grid-4of12'>
<h1 class='f-fc-primary'>€{{$prikupio}}</h1>
<span class='f-caps'>Prikupio</span>
</div>
<div class='f-grid-4of12'>
<h1 class='f-fc-primary'>{{$podrzao}} kampanja</h1>
<span class='f-caps'>Podržao</span>
</div>
<div class='f-grid-4of12 f-fs-large f-tr f-flex-center-y f-flex-self-stretch'>
<p class='f-flex-align-right'>
<em class='f-db'>Trebate pomoć od<br> {{$user->fullname}}?</em>
<a class='f-fc-swatchone' href='#' onclick="show('contact')">
Pitajte {{$user->fullname}}
</a>
</p>
</div>
</div>
<div class='f-hr-light f-m-y-xlarge'></div>
</div>
</div>
</div>



 @endsection

@section('footer')
 @include('footer')
 @endsection