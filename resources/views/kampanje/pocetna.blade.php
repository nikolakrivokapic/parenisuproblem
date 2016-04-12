
<div class='js-home-tab'>
<div class='js-home-tab'>
<div class='f-grid-row f-flex'>
<div class='f-grid-8of12 f-p-xlarge f-b-light f-b-r f-flex-self-stretch'>
<div class='f-p-l-large f-p-r-large'>
<div class='f-grid-row f-p-b-small f-b-b f-b-light'>
<div class='' >
      <h4 class="f-b-xlight f-b-b f-p-b-small f-p-t-small f-width-100" style="background-color:#e7eaed;">
<center>POSLEDNJA OBJAVA</center>
</h4>

</div>
</div> @if(isset($last_update))
<div class='f-grid-row f-p-t-small f-flex-center-y'>
<div class='f-grid-6of12'>
<h4>  {{$last_update->naslov}} </h4>
</div>
<div class='f-grid-6of12 f-tr f-fs-small f-fc-dark'>


<?php
     $now = time(); // or your date as well
     $your_date = $last_update->datum;
     $datediff = $your_date-$now;
     $prijekolko= floor($datediff/(60*60*24));

?>
{{$last_update->datum}}
</div>
</div>
@if($last_update->slika!="0")
<div class='f-grid-row f-p-t-small'>
<div class='f-bg-center f-bg-contain f-height-100' style='height: 344px; background-image: url({{$last_update->slika}}?w=516&amp;h=344); background-position: 50% 50%; background-repeat: no-repeat; width: 516px'></div>
</div>
@endif
<div class='f-grid-row'>

<div class='f-content-section' style="word-wrap: break-word;">

<p > {!! htmlspecialchars_decode( (nl2br($last_update->update)) ) !!}    </p>



</div>
</div>     @endif
<div class='f-grid-row f-tc f-p-t-large linknovosti'>   @if(isset($last_update))
<a class='f-anchor' href='#updates'>Pogledaj sve objave ({{$updates->count()}})</a>    @else    <p ><i>Nema novih ažuriranja.</i></p>        @endif
</div>
<div class='f-b-xlight f-b-b f-p-b-small f-width-100'></div>

<div class='f-m-t-small' style="margin-bottom:0px;">
<center> <h4 class="f-b-xlight f-b-b f-p-b-small f-p-t-small f-width-100" style="background-color:#e7eaed;">
<center>OPŠIRNIJE </center>
</h4></center>
<div class='js-more-info f-content-section'  style="margin-bottom:8px;margin-top:-14px;">
<p >  {!! htmlspecialchars_decode ( (nl2br($project->opsirnije) ) )!!}</p>
<div class='f-hr-xlight -b-b f-p-b-small f-width-100' ></div>
</div>

</div>

<h4 id='koment'  class='f-b-xlight f-b-b f-p-b-small f-p-t-small f-width-100' style="background-color:#e7eaed;">
<center>KOMENTARI </center>
</h4>



@if(!Auth::check())
<div class='f-p-t-medium'>
<div class='f-grid-row f-p-b-medium f-m-t-large f-m-b-large'>
<div class='f-grid-6of12'>
<h4>Uključite se u konverzaciju</h4>
<p class='f-fs-medium f-fw-normal f-font-condensed f-p-t-xsmall f-fc-dark lh-small'>
Ulogujte se sa svojim Facebook nalogom ili putem
<a class='f-fc-swatchone f-clickable js-signin-with-email' onclick="show('signin1')" >email-a.</a>
</p>
</div>
<div class='f-grid-6of12 f-tr f-font-condensed'>
<a href="{{URL::to('/')}}/auth/social/facebook">
<div class='f-button facebook1 ' >Prijavi se preko FACEBOOK-a</div>   </a>
</div>
</div>
</div>


@else


<form action="{{URL::to('/')}}/komentar/novi/{{$project->slug}}" method="post">
<div class="f-p-t-medium">
<div class="js-post-comment f-grid-row" data-target=".js-home-tab-feed-list">
<div class="f-grid-2of12 f-tl">
<div class="f-avatar-small f-fl fb" style="background-image: url({{Auth::user()->slika}});"></div>
</div>
<div class="f-grid-10of12 f-bg-xlight-o-light f-b-light f-br-xsmall f-p-small">
<h5 class="f-m-b-xsmall">{{Auth::user()->fullname}}</h5>
<div class="cb-input-comment f-m-b-small">
<textarea class="f-font-condensed f-fs-large f-fw-normal" maxlength="140" name="text" placeholder="Unesite komentar"></textarea>
</div>
<label class="f-fr f-fs-small f-font-condensed f-flex-center-y">

 <input type="hidden" name="_token" value="{!! csrf_token() !!}">


</label>
<button class="js-submit-btn f-button f-fw-bold primary" data-commentable-id="ozasriim" data-ctype="activities" type="submit">
DODAJ KOMENTAR
</button>
<div class="js-loader f-ilb f-m-l-small" style="display:none">
<div class="f-spinner-circles f-bg-light f-fs-small"></div>
</div>
</div>
</div>

</div>
  </form>
  @endif






















  <script>
  function izbrisikoment(id) {
    id=  $.trim(id);
    if (confirm("Da li ste sigurni da želite obrisati ovaj komentar?")) {
  var token = $('meta[name="csrf-token"]').attr('content');
var isLoggedIn = 0;
$.ajax({
    type: "POST",
    data: '_token=' + token + "&id=" + id,
    url: "{{URL::to('/')}}/brisanje/komentara",
    success: function(msg){
            $('.komentar'+id).remove();

    },
            error   : function(resp){
       alert('Došlo je do greške');
             //   alert(resp);
                    }
});

}
 }

  </script>


<div class='js-home-tab-feed-list f-p-t-medium' data-ajax-list='' data-limit='5' data-scrollspy='0'></div>
 <div class="divkomentari1">
 @foreach($komentari as $komentar)
<div class="js-comment-item f-grid-row f-p-b-large f-b-t f-b-xlight f-p-t-large komentar{{$komentar->id}}" data-comment-id="416428" id="komentar{{$komentar->id}}">
<div class="f-grid-2of12 f-tl">
<a class="f-avatar-small f-fl fb" data-background-image="{{$komentar->slika}}?width=60&amp;height=60" data-scrollspy="0" href="{{URL::to('/')}}/users/{{$komentar->user_id}}" style="background-image: url(&quot;{{$komentar->slika}}?width=60&amp;height=60&quot;);"></a>
</div>
<div class="f-grid-10of12 f-bg-white">
<h5 class="f-ilb">
<a class="f-fc-swatchone" href="{{URL::to('/')}}/users/{{$komentar->user_id}}">{{$komentar->user}}</a>
<span class="f-fc-dark f-fw-normal f-fc-dark">je komentarisao/la:</span>
</h5>
<div class="f-ilb f-fr f-fs-small f-fw-normal f-font-condensed f-fc-light f-lh-large" style="float:right;">
<div >{{$komentar->vreme}}  </div>
 @if( Auth::check() && (Auth::user()->fullname == $project->objavio ||  Auth::user()->fullname == "PNP Portal"  )) <div style="float:right;"> <a title="Izbriši?" onclick="izbrisikoment('{{$komentar->id}}')"> <i class='js-dismiss fa fa-times f-fc-dark' style="cursor:pointer;margin-right:0px;" ></i> </a> </div>        @endif
</div>

<div class="comment f-font-condensed f-fs-large f-fw-medium f-m-t-xsmall f-of-hidden f-lh-small">
{{$komentar->text}}
</div>
<div class="f-grid-row f-m-t-medium f-fs-small">
<div class="f-grid-6of12">
</div>
<div class="f-grid-6of12 f-tr">
</div>
</div>
</div>
</div>
  @endforeach

         {{--   str_replace('/?', '?',$komentari->fragment('koment')->render())    --}}
        </div>
        @if($komentari->count() > 11)
                 <div style="text-align:center;margin-bottom:20px;margin-top:10px;">
        <button class="js-update f-button primary" onclick="joskomentara('{{$project->slug}}', 'divkomentari1','')" style="width:100%;">Učitaj još komentara... </button>    </div>
                                                                                                                                                @endif
</div>
<div class='f-m-t-xlarge'>
<div class='f-grid-row f-b-light f-bg-xlight-o-light f-p-small f-br-small f-flex-center'>
<div class='f-grid-8of12'>
<h4>Pomozite {{$project->oglasio}} da dostigne cilj tako što ćete donirati iznos u skladu sa mogućnostima.</h4>
</div>
<div class='f-grid-4of12 f-tr'>
<a class='f-button primary f-fw-bold f-fs-small' data-mp-action='Donate' data-mp-position='Home Bottom' href='#donate/35' rel='nofollow' onclick="show('doniraj')">DONIRAJ</a>
</div>
</div>

</div>
</div>
<div class='f-grid-4of12'>

<div class='f-grid-row f-p-xlarge'>


  <style>
  .zahov:hover {
    color: blue;
}
</style>


<div class="linkpodrzali">
<a class='f-anchor f-fr f-fs-small f-m-t-xsmall' href='#supporters'>Pogledaj sve</a>    </div>
<h3 class='f-m-b-medium'>Podržali</h3>
<div class='columns-1 listing-container' data-limit='10' data-list='donors' data-total='196'>
<div class='items'>

 {{--*/ $var = 0 /*--}}
@foreach ($podrska->slice(0, 10) as $donator)

   <a class="js-list-item f-grid-row f-m-b-medium f-db" href="{{URL::to('/')}}/users/{{$donator->ime_suportera}}" target="_top" style="height:54px;">
<div class="f-grid-1of12 f-height-100">{{ $var=$var+1}}</div>
<div class="f-grid-3of12">
@if($donator->slika=="")
<div class="f-avatar-small" data-background-image="{{URL::to('/')}}/assets/044fd3a47a31f2606080275edf070028.png?s=60" data-scrollspy="0" style="background-image: url(&quot;{{URL::to('/')}}/assets/044fd3a47a31f2606080275edf070028.png?s=60&quot;);"></div>
@else
 <div class="f-avatar-small" data-background-image="{{$donator->slika}}" data-scrollspy="0" style="background-image: url(&quot;{{$donator->slika}}?s=60&quot;);"></div>

@endif
</div>
<div class="f-grid-8of12 f-p-l-xsmall f-font-condensed">
<div class="f-grid-row">
<h5 class="f-text-truncate">{{$donator->ime_suportera}}</h5>
<div class="f-fw-normal f-fc-black f-m-t-xsmall">

<span class="f-fc-light">{{$donator->grad}}</span>
</div>
</div>
</div>
</a>




    @endforeach





</div>
</div>

<div class='link'>
<a class='f-button primary f-fw-bold participants-btn f-width-100 f-tc' data-mp-action='Donate' data-mp-position='Leaderboard' href='#donate/35'   onclick=@if(Auth::check())"podrzi()"@else"show('signin1')"@endif id='mp-cta-donate' rel='nofollow' rel='nofollow'>
Podrži
</a>
</div>
 <div class='link' style="padding-top:3px;">
<a class='f-button primary f-fw-bold participants-btn f-width-100 f-tc' data-mp-action='Donate' data-mp-position='Leaderboard' href='#donate/35'   onclick="show('doniraj')"  rel='nofollow'>
Doniraj
</a>
</div>
</div>

</div>
</div>
</div>

</div>
