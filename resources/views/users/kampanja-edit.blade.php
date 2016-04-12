@extends('users.layout' )

@section('bar')
@include('users.edit-bar')
@endsection





 @section('edit-page')


<div class='f-pos-rel'>
<div class='f-page-container'>
<div class='f-grid-row'>

<div class='f-page-container f-m-b-xlarge f-fw-light f-p-t-xlarge f-m-t-xlarge' id='dashboard-home'>
<div class='f-grid-row f-m-b-large'>
<div class='f-grid-8of12 f-p-r-small'>
<div class='f-m-b-xlarge'>
<h4 class='f-p-b-xsmall'>Postavite Novu Vijest!</h4>
<p class='f-p-b-medium'>
Postavljajući novosti, ažurirate vašu stranicu i obavještavate potencijalne donatore o progresu u vezi sa vašom kampanjom. Ovi postovi biće prikazani na vašoj stranici.
</p>





   <div>
  <form accept-charset="UTF-8" action="{{URL::to('/')}}/update/{{$kampanja->slug}}" method="POST" enctype="multipart/form-data">
    <div class="f-b-b f-b-light"></div>
    <div class="f-p-large"  style="padding-left: 0px;padding-top: 0px;" >
      <div id="update-modal" ><div class="f-pos-rel js-post-container">
  <div class="f-bg-xlight f-height-100 f-pos-abs f-width-100 js-success" style="display: none; z-index: 2">
    <div class="f-grid-row f-p-t-xlarge f-tc">
      <i class="f-db f-p-b-xsmall fa fa-4x fa-check" style="color: #61C791"></i>
      <h2 class="f-fc-black f-p-b-xsmall">Post Successful!</h2>
      <a class="f-fc-swatchone js-update-link" href="/kdfs-sdfdsf#updates/blog">View Post</a>
    </div>
  </div>
  <textarea maxlength="9999"  name="update" class="f-fw-thin js-update-body" style="resize: none; padding-right: 30px; height: 245px" placeholder="Imate novosti u vezi kampanje, nove informacije koje želite podjeliti sa donatorima i posjetiocima? Poželjno je da stranicu ažurirate što češće kako bi oni bili obavješteni o svemu."></textarea>







  <label name="slika" for="files">Kliknite ovdje ako želite da prikačite sliku koja će pratiti</label>
     <input type="file" name="slika">



  <div class="f-b-medium f-b-nt f-bg-xlight f-of-hidden js-controls" >
    <div class="f-flex-center f-grid-row f-p-small">
      <div class="f-fs-small f-grid-9of12 f-tl">
        <input class="f-fs-large js-vendor" id="#update-modal-facebook-post" type="checkbox" value="facebook">
        <label class="f-clickable f-fc-xdark f-ilb f-p-l-xsmall f-p-r-large" for="#update-modal-facebook-post">
          Facebook
        </label>
        <input class="f-fs-large js-vendor" id="#update-modal-twitter-post" type="checkbox" value="twitter">
        <label class="f-clickable f-fc-xdark f-ilb f-p-l-xsmall f-p-r-large" for="#update-modal-twitter-post">
          Twitter
        </label>
        <input class="f-fs-large js-vendor" id="#update-modal-email-post" type="checkbox" value="email" checked="">
        <label class="f-clickable f-fc-xdark f-ilb f-p-l-xsmall f-p-r-large" for="#update-modal-email-post">
          Pošalji podržavaocima
        </label>
      </div>
      <div class="f-grid-3of12 f-tr">
        <button class="f-button f-tc js-post-update primary" style="width: 100px" type="submit">Postavi</button>
      </div>
    </div>
     <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="f-fs-small f-grid-row f-p-b-small f-p-l-small js-reach-reminder f-hide">
      <div class="f-fl f-ilb" style="padding: 2px 12px 0 3px">
        <i class="f-fc-error f-fs-large fa fa-exclamation-circle"></i>
      </div>
      <p class="f-grid-9of12 f-tl">
       Izaberite opcije za facebook i Google kako bi ste postavili ažuriranje i na njima.
      </p>
    </div>
  </div>

  </div>
   </form>
</div>


    </div>
   </div>



<p class='f-tl f-m-t-xsmall'>
<a class='f-anchor' href='{{URL::to('/')}}/kako-voditi-kampanju' target='_blank'>O čemu bih mogao pisati?</a>
</p>
</div>
<div class='f-m-b-xlarge'>
<div id='js-recent-activity'>
<h4 class='f-p-b-xsmall'>Prošle objave</h4>
<div class='f-hide js-no-more'>
Nema poslednjih zbivanja
</div>
<ul class='f-recent-activity'>
@foreach($updates as $update)
<li class='f-recent-activity-item' data-id='3266116' style=" margin: 5px 0;">
<!--<i class='f-recent-activity-item-left-icon fa fa-calendar' task_name='first_week_update'></i>  -->
<a onclick="updejt('{{$update->naslov}}', '{{  json_encode($update->update) }}' , '{{$update->id}}' )" style="cursor:pointer;">{{$update->naslov}}</a><a onclick="deleteupdejt('{{$update->id}}')">&nbsp;&nbsp;&nbsp;<i class='js-dismiss fa fa-times' style="cursor:pointer;"></i></a> <br>
 </li>
@endforeach
 <br>
<div class='f-recent-activity-item-content'>
<div class='f-lh-medium'>
Ovo su vaše prošle objave.<br>
Kliknite na objavu da je izmjenite ili na dugme pored da je izbrišete.

</div>
</div>

</ul>
</div>

</div>

</div>

<script>

function deleteupdejt($id) {

    if (confirm("Da li ste sigurni da želite izbrisati ovu objavu?")) {
      var token = $('meta[name="csrf-token"]').attr('content');

$.ajax({
    type: "POST",
    data: '_token=' + token + "&id=" + $id ,
    url: "{{URL::to('/')}}/updatedelete",
    success: function(msg){
     location.reload();

    },
            error   : function(resp){
                   alert('Došlo je do greške');
                    }
});
    }
}

      function trimChar(string, charToRemove) {
    while(string.charAt(0)==charToRemove) {
        string = string.substring(1);
    }

    while(string.charAt(string.length-1)==charToRemove) {
        string = string.substring(0,string.length-1);
    }

    return string;
}

    function updejt(naslov,text,id) {


$('#naslovobjave').text(naslov);
$('#textbox7').val(trimChar(text, '"'));
$('#updateid').val(id);
 show('update');
 }

function snimiobjavu() {
var token = $('meta[name="csrf-token"]').attr('content');
var isLoggedIn = 0;
$.ajax({
    type: "POST",
    data: '_token=' + token + "&id=" + $('#updateid').val() + "&update=" + $('#textbox7').val() ,
    url: "{{URL::to('/')}}/updateizmenasnimi",
    success: function(msg){
     location.reload();

    },
            error   : function(resp){
                   alert('Došlo je do greške');
                    }
});

}

</script>
 <div id="update" class="f-fs-medium f-popup f-z-popup" style="display: none; height: 6833px; position: fixed; z-index: 9;">
  <div class="f-bg-black f-opacity-medium f-popup-overlay" style="height: 6833px;"></div>
  <div class="f-anim-fadeinup-fast f-bg-xlight f-br-medium f-fc-xdark f-popup-container f-pos-rel f-tl" style="width: 400px;  position: fixed; margin-left: -200px;margin-top: -266px; top: 50%; left: 50%;  height: 532px;">
    <i class="f-align-tr f-clickable f-fc-hover-dark f-fc-medium f-fs-xlarge f-m-medium f-popup-close fa fa-times" style="z-index: 100;" onclick="hide('update')"></i>
    <script src="https://www.google.com/recaptcha/api.js" async:="" defer:=""></script>
<div class="f-p-medium">
  <h3>Izmjena objave</h3>
</div>
<div class="f-hr"></div>
<div class="f-font-condensed f-p-medium">
  <div >
  <h5 id="naslovobjave"></h5>   </div>
  <textarea maxlength="10000" id="textbox7" name="text" style="height: 150px; resize: none"></textarea>
  <textarea id="updateid" name="text" style="height: 150px; resize: none;display:none"></textarea>
  <input type="hidden" name="id" value="{{$kampanja->id}}">



</div>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="f-hr"></div>
<div class="f-flex-center-y f-p-medium">

     <button class="f-button f-flex-align-left js-submit primary" type="submit" onclick="snimiobjavu()">SAČUVAJ</button>
  <div class="f-m-l-small js-loader" style="display:none">
    <div class="f-bg-light f-fs-small f-spinner-circles"></div>
  </div>
</div>
  </div>
</div>


<div class='f-grid-4of12 f-p-l-small'>
<div class='f-grid-row f-m-b-xlarge'>
<div class='f-flex-center-y f-p-b-xsmall'>
<div class='f-grid-7of12'>
<h4>Status Kampanje</h4>
</div>
<div class='f-grid-5of12 f-tr f-fs-small'>


</div>
</div>
<div class='f-bg-white f-p-l-large f-p-r-large f-p-b-large f-p-t-small f-b-light f-fc-black f-br-medium'>
<h3 class='f-lh-xsmall' style='font-size: 45px'>
{{$podrska}}
</h3>
<div class='scroll f-caps f-fw-bold f-opacity-medium'>
Podržali
(<a class='f-anchor' href='{{URL::to('/')}}/{{$kampanja->slug}}#supporters'>Pogledaj</a>)
</div>
<div class='f-m-t-large'>
<h3 class='f-m-t-small f-lh-xsmall js-raise' style='font-size: 45px'>
€{{$prikupljeno}}
</h3>
<p class='f-ilb f-caps f-fw-bold f-opacity-medium'>
Prikupljeno
<span>
(EUR)
</span>
</p>
</div>
<div class='f-m-t-large'>
<div class='f-thermometer f-m-b-xsmall'>
<div class='f-mercury f-bg-primary' style='width: 0%'></div>
</div>
<div class='f-fr f-fc-black'>
<span class='f-fw-bold f-caps'>
Ostalo dana:
</span>
<span class='js-days-left-target'>{{$ostalodana}}</span>
</div>
<div class='f-fc-black'>
<span class='f-fw-bold f-caps'>
Cilj:
</span>
<span class='js-campaign-goal-target'>
€{{$kampanja->cilj}}
</span>
</div>
</div>
<div class='f-p-t-xlarge f-p-b-small'>
<a class='f-fs-medium f-button facebook1 f-width-100 f-tc' data-facebook-action='share' data-facebook-ft-src='fbshare_dash'>Šeruj kampanju na FAcebook-u</a>
</div>

</div>
</div>

 <script>
 function show(target) {
    document.getElementById(target).style.display = 'block';
}

function hide(target) {
    document.getElementById(target).style.display = 'none';
}

    //  Bind the event handler to the "submit" JavaScript event



</script>






  <!--
<a class="f-button f-fs-xlarge f-fw-bold f-tc f-text-truncate f-width-100 js-cta-donate primary" onclick="show('uplate')" data-mp-position="Primary CTA" href="#"  id="mp-cta-donate" rel="nofollow">
UPUTSTVO ZA UPLATU
</a>




<form id="sendform" action="{{URL::to('/')}}/uplate/snimi" method="post">
<div id="uplate" class="f-fs-medium f-popup f-z-popup" style="display: none; height: 6833px; position: fixed; z-index: 9;">
  <div class="f-bg-black f-opacity-medium f-popup-overlay" style="height: 6833px;"></div>
  <div class="f-anim-fadeinup-fast f-bg-xlight f-br-medium f-fc-xdark f-popup-container f-pos-rel f-tl" style="width: 400px; position: fixed; margin-left: -200px;margin-top: -266px; top: 50%; left: 50%; height: 532px;">
    <i class="f-align-tr f-clickable f-fc-hover-dark f-fc-medium f-fs-xlarge f-m-medium f-popup-close fa fa-times" style="z-index: 100;" onclick="hide('uplate')"></i>
    <script src="https://www.google.com/recaptcha/api.js" async:="" defer:=""></script>
<div class="f-p-medium">
  <h4>Ovdje unesite sve relevantne informacije o načinima uplate/prenosa/doniranja, koje će posjedioci moći da vide kada kliknu na dugme "Doniraj"</h4>
</div>
<div class="f-hr"></div>
<div class="f-font-condensed f-p-medium">

  <h5>Kako uplatiti/donirati novac?</h5>
  <textarea  maxlength="1000" id="textbox" name="text" style="height: 150px; resize: none" placeholder="@if($kampanja->uputstvo=="")Možete unijeti podatke kao što su brojevi bankovnih računa, instrukcije za plaćanje iz inostranstva i slično. Budite kratki i konkretni.@endif">@if($kampanja->uputstvo!=""){{$kampanja->uputstvo}}@endif</textarea>
   (do 500 karaktera)
  <input type="hidden" name="id" value="{{$kampanja->id}}">



</div>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="f-hr"></div>
<div class="f-flex-center-y f-p-medium">

     <button class="f-button f-flex-align-left js-submit primary" type="submit">SAČUVAJ</button>
  <div class="f-m-l-small js-loader" style="display:none">
    <div class="f-bg-light f-fs-small f-spinner-circles"></div>
  </div>
</div>
  </div>
</div>
</form>-->







<div class='f-grid-row f-m-b-xlarge' style="margin-top:27px;">
<h4>Adresa vaše stranice URL</h4>
<p class='f-p-b-xsmall'>Kopiraj i pošalji link prijateljima!</p>
<div class='f-input-decorator f-fs-small f-lh-regular f-br-small' onclick="javascript:this.getElementsByTagName('input')[0].select()">
<div class='f-decorator f-bg-xlight medium f-fc-medium f-clickable'>
<i class='fa fa-link f-fc-xdark'></i>
</div>
<input class='f-fw-light' type='text' value='{{URL::to('/')}}/{{$kampanja->slug}}'>
</div>
<div class='f-tr f-m-t-xsmall'>
<!--<a class='f-anchor' href='#edit/campaign-title'>Edit URL</a>  -->
</div>
</div>

<div class='f-grid-row f-p-t-large'>
<h4 class='f-p-b-xsmall'>Uputstva</h4>
<ul class='f-list bulleted no-hover'>
<li>
<a class='f-anchor' href='{{URL::to('/')}}/kako-sakupiti-sredstva' target='_blank'>Kako da sakupite što više sredstava?</a>
</li>
<li>
<a class='f-anchor' href='{{URL::to('/')}}/kako-voditi-kampanju' target='_blank'>Kako uspješno voditi kampanju</a>
</li>
<li>
<a class='f-anchor' href='{{URL::to('/')}}/kako-vam-mozemo-pomoci' target='_blank'>Kako vam možemo pomoći</a>
</li>
<li>
<a class='f-anchor' href='{{URL::to('/')}}/kako-sakupiti-sredstva#prica' target='_blank'>Ispričajte priču</a>
</li>
<li>
<a class='f-anchor' href='{{URL::to('/')}}/kako-sakupiti-sredstva#mreze' target='_blank' >Socijalne mreže</a>
</li>

<li>
<a class='f-anchor' href='{{URL::to('/')}}/ideje' target='_blank' >Neke od ideja za kampanje</a>
</li>

</ul>
</div>
</div>
</div>
</div>

</div>
</div>
</div>



<div id='activate-payment-gateway-modal'></div>
<div id='popup-target'></div>
<div id='onboarding'></div>
<div id='campaign-status-modal'></div>
<div id='inplace-editor'></div>

<script>
  !function(a){var b,c,d,e;b=this,c=[],d=function(c,d,e){if("function"==typeof c)c.call(a),e.call(b);else{var f=document.createElement("script");f.src=c,d&&(f.onload=function(){e.call(b)},f.onreadystatechange=function(){"complete"===this.readyState&&e.call(b)}),document.body.appendChild(f),d||e.call(b)}},e=function(){if(c.length>0){var a=c.shift();d(a.f,a.b,e)}},a.jsOnload=function(a,b){c.push({f:a,b:b||!1})},a.addEventListener?a.addEventListener("load",e,!1):a.onload=e}(window);
</script>



 @endsection

     @section('footer')
@include('footer')
@endsection
