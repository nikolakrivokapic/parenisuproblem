@if(Auth::check())

<form id="sendform" action="{{URL::to('/')}}/poruke/slanje" method="post">
<div id="contact" class="f-fs-medium f-popup f-z-popup" style="display:none;height: 6833px;position:fixed;z-index:9;">
  <div class="f-bg-black f-opacity-medium f-popup-overlay" style="height: 6833px;"></div>
  <div class="f-anim-fadeinup-fast f-bg-xlight f-br-medium f-fc-xdark f-popup-container f-pos-rel f-tl" style="width: 400px; position: fixed; margin-left: -200px; margin-top: -261px; top: 50%; left: 50%; height: 532px;">
    <i class="f-align-tr f-clickable f-fc-hover-dark f-fc-medium f-fs-xlarge f-m-medium f-popup-close fa fa-times" style="z-index: 100;" onclick="hide('contact')"></i>
    <script src="https://www.google.com/recaptcha/api.js" async:="" defer:=""></script>
<div class="f-p-medium">
  <h3>Kontaktiraj {{$project->objavio}} privatnom porukom</h3>
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
  <textarea id="textbox" name="text" style="height: 150px; resize: none"></textarea>

  <input type="hidden" name="autor2" value="{{$project->objavio}}">
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