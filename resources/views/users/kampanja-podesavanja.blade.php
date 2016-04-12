@extends('users.layout' )

@section('bar')
@include('users.edit-bar')
@endsection





 @section('kampanja-podesavanja')

<div class='f-pos-rel'>
<div class='f-page-container'>
<div class="f-grid-row" >
<div class="f-grid-4of12 f-tl"  >
<div class="f-p-t-medium"  id="settings-side-nav"  style="margin-top:-10px;">
<h2 class="f-p-t-large f-p-b-large f-normal-caps f-p-b-small f-m-t-xlarge f-fc-black"  style="margin-top:0px;">Podešavanja</h2>
<div class="f-grid-row f-p-t-medium f-p-b-medium f-b-light f-b-t">
<a class="f-fc-black f-opacity-xdark f-font-condensed f-fs-large f-fw-thin" href="#email" ><div class="fa fa-fw fa-envelope f-fc-light f-m-r-small"></div>Email Obavještenja
</a>
</div>

<div class="f-grid-row f-p-t-medium f-p-b-medium f-b-light f-b-t" >
<a class="f-fc-black f-opacity-xdark f-fc-hover-black f-font-condensed f-fs-large f-fw-thin" href="#comments"><div class="fa fa-fw fa-comments f-fc-light f-m-r-small"></div>Komentari
</a>
</div>


<div class="f-grid-row f-p-t-medium f-p-b-medium f-b-light f-b-t">
<a class="f-fc-black f-opacity-xdark f-fc-hover-black f-font-condensed f-fs-large f-fw-thin" href="#page-settings"><div class="fa fa-fw fa-flag f-fc-light f-m-r-small"></div>Stranica
</a>

</div>

</div>

</div>
<div class="f-grid-8of12 f-tl f-bg-white">

<div id="create-team"></div>

<div class="target">

<script>
$(document).ready(function() {
    //set initial state.

    $('.opcije').change(function() {
         var token = $('meta[name="csrf-token"]').attr('content');
        if($(this).is(":checked")) {

$.ajax({
    type: "POST",
    data: '_token=' + token + "&opcija=" + $(this).attr('id') + "&odabir=1" + "&id=" + "{{$podesavanja->kampanja_id}}",
    url: "{{URL::to('/')}}/opcije",
    success: function(msg){
    //  alert("ok");

    },
            error   : function(resp){

              alert(JSON.stringify(resp));
                    }
});

        }
        else {
               $.ajax({
    type: "POST",
    data: '_token=' + token +  "&opcija=" + $(this).attr('id') + "&odabir=0" + "&id=" + "{{$podesavanja->kampanja_id}}",
    url: "{{URL::to('/')}}/opcije",
    success: function(msg){
       //  alert("ok1");

    },
            error   : function(resp){

             alert(resp);
                    }
});

        }

    });
});

</script>
<div id="comments" class="f-grid-row f-m-l-xlarge f-m-t-xlarge f-p-t-medium" style="min-height:800px;" ><h2 class="f-fc-black f-normal-caps f-p-b-large f-p-b-small f-p-t-large">Komentari</h2>
<div class="f-b-t f-b-xlight f-grid-row f-p-t-small">
  <h5 class="f-caps f-fc-black f-p-b-small f-p-t-xsmall">Komentari na stranici i blog postovima</h5>
  <div class=" f-b-light f-br-small f-font-condensed f-grid-row f-m-b-small js-notification-options">
    <div class="f-grid-row f-p-small">
      Dozvoli komentare
      <input id="komentari" class="opcije f-fr f-fs-large" type="checkbox" data-section="configuration" data-name="allow_commenting" @if($podesavanja->komentari == 1) checked @endif>
    </div>
  </div>
  <div class=" f-grid-row">
    <div class="f-font-condensed f-fw-normal">Možete izbrisati specifične komentare tako što će te kliknuti na "Izbriši" pored komentara.</div>
  </div>
</div></div>


      <div class="f-grid-row f-m-l-xlarge f-m-t-xlarge f-p-t-medium" id="email" style="min-height:800px"><h2 class="f-fc-black f-normal-caps f-p-b-large f-p-t-large">Primaj Emailove</h2>
<div class="f-b-t f-b-xlight f-grid-row f-p-t-small">
  <h5 class="f-caps f-fc-black f-p-b-small f-p-t-xsmall">Izaberite kada hoćete da primite email obavještenje</h5>
  <div class="f-b-light f-br-small f-grid-row f-m-b-xlarge js-notification-options">

    <div class="f-font-condensed f-grid-row f-p-small">
      Nova podrška
      <input id="novipodrzavalac" class="opcije f-fr f-fs-large" type="checkbox" data-section="configuration" data-name="allow_recurring" @if($podesavanja->novipodrzavalac == 1) checked @endif>
    </div>
     <div class="f-b-b f-b-light f-font-condensed f-grid-row f-p-small">
     Novi komentar
      <input id="novikomentar" class="opcije f-fr f-fs-large" type="checkbox" data-section="configuration" data-name="allow_anonymous" @if($podesavanja->novikomentar == 1) checked @endif>
    </div>
  </div>
</div><h2 class="f-fc-black f-normal-caps f-p-b-large f-p-t-large">Slanje emailova</h2>
<div class="f-b-t f-b-xlight f-grid-row f-p-t-small">
  <h5 class="f-caps f-fc-black f-p-b-small f-p-t-xsmall">Automatski ćemo slati emailove vašim podržavaocima kada:</h5>
  <div class="f-b-light f-br-small f-grid-row f-m-b-xlarge js-notification-options">
    <div class="f-b-b f-b-light f-font-condensed f-grid-row f-p-small">
     Postignuto 25% cilja
      <input id="postignuto25" class="opcije f-fr f-fs-large" type="checkbox" data-section="configuration" data-name="allow_anonymous" @if($podesavanja->postignuto25 == 1) checked @endif>
    </div>
    <div class="f-font-condensed f-grid-row f-p-small">
  Postignuto 50% cilja
      <input id="postignuto50" class="opcije f-fr f-fs-large" type="checkbox" data-section="configuration" data-name="allow_recurring" @if($podesavanja->postignuto50 == 1) checked @endif>
    </div>
  </div>
</div><h2 class="f-fc-black f-normal-caps f-p-b-large f-p-t-large">Notifikacije</h2>
<div class="f-b-t f-b-xlight f-grid-row f-p-t-small">
  <h5 class="f-caps f-fc-black f-p-b-small f-p-t-xsmall">Opcije u vezi notifikacija</h5>
  <div class="f-b-light f-br-small f-grid-row f-m-b-xlarge js-notification-options">
    <div class="f-b-b f-b-light f-font-condensed f-grid-row f-p-small">
      Izgasi sve notifikacije
      <input id="notifikacije" class="opcije f-fr f-fs-large" type="checkbox" data-section="configuration" data-name="allow_anonymous" @if($podesavanja->notifikacije == 1) checked @endif>
    </div>

  </div>
</div>

</div>







<div class="f-grid-row f-m-l-xlarge f-m-t-xlarge f-p-t-medium" id="page-settings" style="min-height:1000px">

<h2 class="f-fc-black f-normal-caps f-p-b-small f-p-t-large">Vidljivost kampanje</h2>
<div class="f-b-t f-b-xlight f-grid-row f-p-t-small">
  <!-- / %h5.f-caps.f-p-t-xsmall.f-p-b-small.f-fc-black Allow or disable the following actions on your page: -->
  <div class="f-b-light f-br-small f-grid-row f-m-b-xsmall js-team-options">
    <div class="f-b-b f-b-light f-flex-center f-font-condensed f-grid-row f-p-small">
      <div class="f-grid-8of12">
        Sakrij od servisa za pretragu (Google, Yahoo...)
      </div>
      <div class="f-grid-2of12 f-grid-4of12-offset f-tr">
        <div> <input id="servisi" class="opcije f-fr f-fs-large" type="checkbox" data-section="configuration" @if($podesavanja->servisi == 1) checked @endif>  </div>
      </div>
    </div>
  </div>
</div></div>





</div>

</div>
</div>
</div>
</div>




 @endsection

     @section('footer')
@include('footer')
@endsection