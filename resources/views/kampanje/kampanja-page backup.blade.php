
<div class='f-page-container  f-pos-rel'>




<div class='f-b-light'>
<div class='js-above-the-fold f-bg-white'>
<div class='f-pos-rel f-bg-white'>
<div class='js-top-content f-bg-white f-tl'>
<div class='f-tc f-p-medium f-bg-white f-b-xlight f-b-b'>
<h1 class='f-normal-caps f-fc-black f-lh-small f-text-truncate' style='font-size:40px'>
<span class='js-campaign-title-target'>{{$project->naslov}} </span>
</h1>


</div>
<div class='f-p-l-large f-p-r-large f-p-t-medium f-p-b-medium'>
<div class='f-grid-row'>
<div class='f-grid-8of12'>
<div class='f-pos-rel' id='gallery' style='height: 400px; width: 600px'>


<div class="js-gallery f-gallery f-fs-medium f-tc f-bg-white f-hover-fade-in" style="height: 400px; width: 600px">
<div class="js-loading f-height-100 f-width-100 f-flex-center f-fullbleed" style="display: none;">
<div class="f-spinner-lifepreserver f-fs-xlarge"></div>
</div>
<div class="js-images f-pos-rel f-height-100" style="height: 400px; width: 600px; margin: 0px auto; transition-duration: 600ms; transition-timing-function: ease-in-out; transform: translate3d(0px, 0px, 0px);">
     <div id="slider" style="height: 400px; width: 600px; margin: 0px 0px 0px 0px; transition-duration: 600ms; transition-timing-function: ease-in-out; transform: translate3d(0px, 0px, 0px);">
     @if($project->slika != "" )  <img src="{{$project->slika}}" />  @endif
       @if($project->slika2 != "" )                     <img src="{{$project->slika2}}"  />   @endif
         @if($project->slika3 != "")                       <img src="{{$project->slika3}}"/>     @endif



        </div>
</div>

<a class="js-left-area f-gallery-leftarea f-hover-fade-in f-no-underline" onclick="imageSlider.previous()" class="group1-Prev"></a>

<a class="js-right-area f-gallery-rightarea f-hover-fade-in f-no-underline" onclick="imageSlider.next()" class="group1-Next"></a>

<div class="js-balls f-balls f-align-bc f-p-small f-fs-xsmall" style="width: 72px;"><a href="#gallery/1" class="selected"></a><a href="#gallery/2" class=""></a><a href="#gallery/3"></a></div>
</div>
</div>

</div>
<div class='f-grid-4of12 f-p-l-large'>
<a class='f-button f-fs-xlarge f-fw-bold f-tc f-text-truncate f-width-100 js-cta-donate primary' data-mp-action='Donate' data-mp-position='Primary CTA' href='#donate/35'  onclick="show('doniraj')" id='mp-cta-donate' rel='nofollow'>
DONIRAJ
</a>
<a class='f-button facebook1 f-width-100 f-m-t-small f-tc f-fs-large' data-button-source='Secondary CTA' data-facebook-action='share' data-facebook-ft-src='fbshare'>Podjeli na Facebook-u</a>





<div id='doniraj' class="popup-instance f-style-guide overlay" style="display:none;position:fixed;z-index:9;" ><div class="f-fs-medium f-popup f-z-popup" >
  <div class="f-bg-black f-opacity-medium f-popup-overlay" style="height: 3581px;"></div>
  <div class="f-anim-fadeinup-fast f-bg-xlight f-br-medium f-fc-xdark f-popup-container f-pos-rel f-tl" style="width: 490px; position: fixed; margin-left: -245px;margin-top: -142px; top: 50%; left: 50%; height: 485px;">
    <i class="f-align-tr f-clickable f-fc-hover-dark f-fc-medium f-fs-xlarge f-m-medium f-popup-close fa fa-times" style="z-index: 100;" onclick="hide('doniraj')"></i>
    <div class="f-p-medium f-tl">
  <h3 class="f-fc-black f-lh-small">Kako da uplatite pomoć?</h3>
</div>


<div class="f-grid-row f-p-large f-tl">

  <div class="f-grid-7of12 f-p-r-medium f-pos-rel">
   <textarea id="textbox" maxlength="500px" name="text" style="height: 300px; width:400px;resize: none" readonly>{{$project->uputstvo}}</textarea>

    <div class="f-input-decorator">



   <button class="f-button f-flex-align-left f-fw-bold js-submit primary" onclick="hide('doniraj')" style="margin-top:10px;">Zatvori</button>

    </div>
  </div>

</div>
  </div>
</div></div>






<div class='f-fc-black f-m-b-medium'>
<div class='f-p-t-medium'>
<h3 class='f-lh-xsmall' style='font-size: 45px'>
{{$podrska->count()}}
</h3>
<a class='scroll f-font-condensed f-caps f-fw-bold' href='#donors'>
Podržali
</a>
</div>
<div class='f-m-t-medium'>
<h3 class='f-m-t-small f-lh-xsmall js-raise' style='font-size: 45px'>
€{{$project->skupljeno}}
</h3>
<p class='f-font-condensed f-ilb f-caps f-fw-bold'>
Donirano
<span>
(EUR)
</span>
</p>
</div>
<?php
     $now = time(); // or your date as well
     $your_date = strtotime($project->datumisteka);
     $ostalodana = $your_date-$now;
     $ostalodana= floor($ostalodana/(60*60*24));

?>

<div class='f-m-t-medium'>
<div class='f-thermometer f-m-b-xsmall'>
<div class='f-mercury f-bg-primary' @if($project->cilj != 0) style='width: {{$percentage = ($project->skupljeno / $project->cilj) * 100}}%' @endif></div>
</div>
<div class='f-fr f-font-condensed f-fc-black'>
@if($project->datumisteka)
<span class='f-fw-bold'>
Ostalo Dana:
</span>
<span class='js-days-left-target'>{{$ostalodana}} </span>
@else
<span class='f-fw-bold'>
Ostalo Dana:
</span>
<span class='js-days-left-target'>Nije postavljeno</span>
@endif
</div>
<div class='f-font-condensed f-fc-black'>
@if($project->cilj != 0)
<span class='f-fw-bold'>
Cilj:
</span>
<span class='js-campaign-goal-target'>
€{{$project->cilj}}
</span>
@else
   <span class='f-fw-bold'>
Cilj:
</span>
<span class='js-campaign-goal-target'>
N/A
</span>
@endif
</div>
 <a style="margin-top:10px;"class='f-button f-fs-xlarge f-fw-bold f-tc f-text-truncate f-width-100 js-cta-donate primary' data-mp-action='Donate' data-mp-position='Primary CTA'  onclick=@if(Auth::check())"podrzi()"@else"show('signin1')"@endif id='mp-cta-donate' rel='nofollow'>
Podrži
</a>
</div>
</div>

</div>
</div>
</div>
 @if(Auth::check())
 <script>
 function podrzi() {
             var token = $('meta[name="csrf-token"]').attr('content');

             var msg_id = $(this).attr("msg_id");
             var dataString = 'ime_suportera='+ "{{Auth::user()->fullname}}" + '&slug=' + "{{$project->slug}}" + "&slika=" + "{{Auth::user()->slika}}" + '&_token=' + token ;

                $.ajax({
                type: "POST",
                url: '{{URL::to('/')}}/podrzi',
                data: dataString,
                cache: false,

                success: function(html)
                {
         show('hvala');

                },
                    error   : function(resp){
          alert('Već ste podržali ovu kampanju!');
                  }

                });

 }


 </script>
   @endif

<div id='hvala' class="popup-instance f-style-guide overlay" style="display:none;position:fixed;z-index:9;" ><div class="f-fs-medium f-popup f-z-popup" >
  <div class="f-bg-black f-opacity-medium f-popup-overlay" style="height: 3581px;"></div>
  <div class="f-anim-fadeinup-fast f-bg-xlight f-br-medium f-fc-xdark f-popup-container f-pos-rel f-tl" style="width: 490px; position: absolute; margin-top: 0px; top: 150px; left: 600px; height: 235px;">
    <i class="f-align-tr f-clickable f-fc-hover-dark f-fc-medium f-fs-xlarge f-m-medium f-popup-close fa fa-times" style="z-index: 100;" onclick="hide('hvala')"></i>
    <div class="f-p-medium f-tl">
  <p class="f-fc-black f-lh-small">Hvala na podršci! Dodati ste u listu korisnika koji podržavaju ovu kampanju. <br><br> Donirajte sredstva u skladu sa svojim mogućnostima. Instrukcije saznajte putem klika na dugme "Doniraj".</p>
</div>


<div class="f-grid-row f-p-large f-tl">

  <div class="f-grid-7of12 f-p-r-medium f-pos-rel">

    <div class="f-input-decorator">



   <button class="f-button f-flex-align-left f-fw-bold js-submit primary" onclick="hide('hvala')" style="margin-top:10px;">Zatvori</button>

    </div>
  </div>

</div>
  </div>
</div></div>




<div class='f-p-t-medium f-p-b-medium f-p-l-large f-p-r-large f-bg-white f-b-t f-b-xlight'>
<div class='f-grid-row'>
<div class='f-grid-8of12'>
<div class='f-grid-row'>
<h3 class='f-ilb f-normal-caps f-fc-black f-flex-center-y'>
<span>Objavio {{$project->objavio}}</span>
<div class='f-ilb f-fs-small f-p-l-xsmall'>
<div class='f-bg-xlight f-pos-rel' style='border-radius: 50px; line-height: 1em'>
<div class='f-bg-facebook f-br-circle f-fl' style='padding: 0.6em 0.5em'>
<i class='f-fc-white fa fa-facebook fa-fw' style='font-size: 100%'></i>
</div>
<div class='f-fr' style='padding: 0.6em 0.5em 0.6em 0.2em'>
<i class='fa fa-check fa-fw' style='color: #61C791; font-size: 100%'></i>
</div>
<div style='clear: both'></div>
</div>

</div>
</h3>
<p class='js-campaign-summary-target f-font-condensed f-fs-xlarge f-fc-xdark f-p-t-xsmall'>{!! htmlspecialchars_decode( (nl2br($project->text)) ) !!}</p>
@if($project->videourl != "" )
<video width="620" height="320" controls>
  <source src="{{$project->videourl}}" type="video/mp4">

</video>
 @endif



</div>
 <div style="margin-top:15px;padding-right:0px;padding-bottom:0px;">
<div class='f-grid-row' style="width:100%;">

<div class='f-grid-11of12'>

<h5 class='f-anchor' onclick="show('pretplati')" style=" cursor: pointer;"  >Novosti na email</h5>
<p>Upišite se i dobijajte na email sve novosti u vezi ove kampanje!</p>
</div>
</div>
</div>
</div>
   <script>
$('#read_more').click(function(){
    $('#my_text').toggleClass('ellipsis');
});
</script>

<div class='f-grid-4of12 f-p-l-large'>
<div class='f-b-light f-bg-xlight-o-xlight f-p-small f-br-small f-fc-black'>
<div class='f-grid-row'>
<div class='f-grid-4of12'>
<div class='js-profile-img f-fl f-pos-rel f-avatar-square-medium' style='height: 75px; width: 75px; background-image: url({{$objavio->slika}}?s=75)'>
</div>
</div>
<div class='f-grid-8of12 f-p-l-xsmall'>
<a href="{{URL::to('/')}}/users/{{$project->objavio}}"><h4>{{$project->objavio}}</h4>     </a>
<i class='fa fa-envelope f-fc-medium f-m-r-xsmall'></i>
 @if(Auth::check())
<a class='f-fw-bold' href='#contact'onclick="show('contact')" >
@else
 <a class='f-fw-bold' href='#contact' onclick="show('signin1')" >
@endif
Kontakt
</a>
</div>
</div>




<div class='f-grid-row f-p-y-xsmall'>
<i class='f-icon-location f-fc-medium f-m-r-xsmall f-fs-large'></i>
<a class='js-location-target f-fw-bold' href='{{URL::to('/')}}/lokacija/{{$project->lokacija}}'>
{{$project->lokacija}}
</a>
</div>
<div class='f-grid-row f-p-b-xsmall'>
<i class='f-fc-medium f-fs-large f-icon-health f-m-r-xsmall js-category-icon-target'></i>
<a class='js-category-target f-fw-bold' href='{{URL::to('/')}}/kategorija/{{$project->kategorija}}'>
{{$project->kategorija}}
</a>
</div>
<div class='f-grid-row' onclick="javascript:this.getElementsByTagName('input')[0].select()">
<i class='fa fa-link f-fc-medium f-m-r-xsmall f-fs-large'></i>
<input class='f-fs-small f-fc-xdark' style='width: 210px' type='text' value='{{ URL::to('/') }}/{{$project->slug}} '>   <span style="font-size: 9px;"><center>Kopirajte adresu stranice i pošaljite prijateljima!</center>  </span>
</div>


</div>

<!-- <div style="margin-top:5px;" >  <a id="popup-trigger1"><div> <i class='fa fa-heart f-fc-light'></i> Uputstvo za uplatu</div> </a>
 <div class="popup">
  Madrid is a city in Europe and the capital and largest city of Spain. The population of the city is almost 3.2 million and that of the Madrid metropolitan area, around 6.3 million. <br><br>It is the third-largest city in the European Union, after London and Berlin, and its metropolitan area is the third-largest in the European Union after Paris and London. The city spans a total of 604.3 km2 (233.3 sq mi).
  <span class="popup-btn-close">close</span>
</div>
 </div>-->

 <div style="margin-top:15px;padding-right:0px;">

</div>



</div>




</div>




<div class='f-grid-row f-p-t-medium'>
<div class='f-grid-8of12 f-p-l-xsmall'>
<div class='f-grid-row'>
<div class='f-ilb f-m-r-xsmall'>
<div class='js-fb-share f-flex-center'>
<a class='js-fb-button f-fs-medium f-fw-bold f-button facebook1 f-width-100 f-tc' data-button-source='Minimal Share' data-facebook-action='share' data-facebook-ft-src='fbshare' style='width: 110px; height: 42px; line-height: 42px'>Podjeli</a>
<div class='f-ilb f-m-l-xsmall'>
<div class='js-fb-count f-b-medium f-bg-xlight f-arrow-left-small f-flex-center f-p-t-xsmall f-p-b-xsmall f-p-l-small f-p-r-small f-fw-bold f-fc-facebook f-br-small f-hide f-fs-large' data-facebook-action='count' data-scrollspy='0'></div>
</div>
</div>
</div>
<div class='f-ilb f-m-r-xsmall'>
<div class='js-twitter-share f-flex-center'>
<a class='js-twitter-button f-fs-medium f-fw-bold f-button twitter f-width-100 f-tc'    href="https://twitter.com/intent/tweet?url=<?=urlencode(URL::to('/'))?>/{{$project->slug}}" style='width: 110px; height: 42px; line-height: 42px'>Tvituj</a>
<div class='f-ilb f-m-l-xsmall'>
<div class='js-twitter-count f-b-medium f-bg-xlight f-arrow-left-small f-flex-center f-p-t-xsmall f-p-b-xsmall f-p-l-small f-p-r-small f-fw-bold f-fc-twitter f-br-small f-hide f-fs-large' data-scrollspy='0' data-twitter-action='count'></div>
</div>
</div>
</div>

</div>

</div>




@include('kampanje.slanjeporuke')








 <div id="email" class="f-anim-fadeinup-fast f-bg-xlight f-br-medium f-fc-xdark f-popup-container f-pos-rel f-tl" style="display:none;width: 415px; position: absolute; margin-top: 0px; top: 555px; left: 593px; height: 483px;">
    <i class="f-align-tr f-clickable f-fc-hover-dark f-fc-medium f-fs-xlarge f-m-medium f-popup-close fa fa-times" onlclick="hide('email')" style="z-index: 100;"></i>
    <div class="f-p-medium">
  <h3>Podjeli kampanju emailom</h3>
</div>
<div class="f-hr"></div>
<div class="f-font-condensed f-p-medium">
  <h5 class="f-caps">Your Name</h5>
  <div class="f-m-b-small f-spaced-grid-2-small">
    <input type="text" name="first_name" placeholder="First Name" value="">
    <input type="text" name="last_name" placeholder="Last Name" value="">
  </div>
  <h5 class="f-caps f-m-t-medium">Your Email
    <input type="text" name="email" placeholder="Email" value="">
    <input class="f-hide" type="text" name="phone" placeholder="Phone">
  </h5>
  <h5 class="f-m-t-medium">Who do you want to send this to?</h5>
  <textarea name="recipients" style="height: 100px"></textarea>
  <p class="f-font-condensed f-tr">Like this: example@email.com, example@email.com</p>
</div>
<div class="f-hr"></div>
<div class="f-p-medium">
  <a class="f-button f-fr f-fw-bold js-preview white" href="/brandonov-oporavak/notifications/EmailCampaignShare/preview" target="_blank">
    Preview
  </a>
  <div class="f-button f-fw-bold js-submit swatchthree">Send Email</div>
  <div class="f-m-l-small js-loader" style="display:none">
    <div class="f-bg-light f-fs-small f-spinner-circles"></div>
  </div>
</div>
  </div>

  <script>
  $(document).ready(function() {
    $("#buttonpretplati").click(function(){
        var token = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
    type: "POST",
    data: '_token=' + token + "&email=" + $("#textbox5").val() + "&id=" + "{{$project->id}}",
    url: "{{URL::to('/')}}/pretplati",
    success: function(msg){
    alert("Prijavili ste se za praćenje ove kampanje.");

    },
            error   : function(resp){

            alert("Već ste pretplaćeni na ovu kampanju.");
                    }
});


        hide('pretplati');
    });
});



 </script>


 <div id='pretplati' class="popup-instance f-style-guide overlay" style="display:none;position:fixed;z-index:9;" ><div class="f-fs-medium f-popup f-z-popup" >
  <div class="f-bg-black f-opacity-medium f-popup-overlay" style="height: 3581px;"></div>
  <div class="f-anim-fadeinup-fast f-bg-xlight f-br-medium f-fc-xdark f-popup-container f-pos-rel f-tl" style="width: 490px; position: absolute; margin-top: 0px; top: 150px; left: 600px; height: 235px;">
    <i class="f-align-tr f-clickable f-fc-hover-dark f-fc-medium f-fs-xlarge f-m-medium f-popup-close fa fa-times" style="z-index: 100;" onclick="hide('pretplati')"></i>
    <div class="f-p-medium f-tl">
  <p class="f-fc-black f-lh-small">Unesite svoj email kako bi ste se upisali u listu pretplatnika koji će biti obavještavani o novostima i ažuriranjima vezanim za ovu kampanju.</p>
</div>


<div class="f-grid-row f-p-large f-tl">

  <div class="f-grid-7of12 f-p-r-medium f-pos-rel">
   <textarea id="textbox5" name="email" style="height: 40px; width:300px;resize: none" type="email" placeholder="Unesite email adresu..">@if(Auth::check()) {{Auth::user()->email}} @endif</textarea>

    <div class="f-input-decorator">



   <button id="buttonpretplati" class="f-button f-flex-align-left f-fw-bold js-submit primary" style="margin-top:10px;">Potvrđujem</button>

    </div>
  </div>

</div>
  </div>
</div></div>




</div>
</div>
</div>
</div>

</div>
<div class='js-tabs f-bg-white'>
<div class='js-routeable-tabs js-rt-parent f-fc-black f-b-light f-b-t' data-easing='ease-in-out' data-push-state data-speed='600'>
<div class='js-tab-nav f-p-medium f-bg-xlight f-clearfix f-b-light f-b-b' data-selected='f-bg-light f-fc-black' data-unselected='f-bg-xlight'>
<div class='f-content-spacing-xlarge f-fs-large f-fw-bold'>
<div class='f-ilb'>
<a class='f-db f-font-condensed f-fc-dark f-bg-light f-p-xsmall f-br-small' href='#home'><span>POČETNA</span></a>
</div>
<div class='f-ilb'>
<a class='f-db f-font-condensed f-fc-dark f-bg-light f-p-xsmall f-br-small' href='{{URL::to('/')}}/{{$project->slug}}/updates'><span>NOVOSTI</span><div class='f-badge inline f-bg-white f-fc-dark f-m-l-xsmall'>
{{$updates->count()}}
</div>
</a>
</div>
<div class='f-ilb'>
<a class='f-db f-font-condensed f-fc-dark f-bg-light f-p-xsmall f-br-small' href='{{URL::to('/')}}/{{$project->slug}}/comments'><span>KOMENTARI</span><div class='f-badge inline f-bg-white f-fc-dark f-m-l-xsmall'>
{{$count}}
</div>
</a>
</div>
<div class='f-ilb'>
<a class='f-db f-font-condensed f-fc-dark f-bg-light f-p-xsmall f-br-small' href='{{URL::to('/')}}/{{$project->slug}}/supporters'><span>PODRŽALI</span><div class='f-badge inline f-bg-white f-fc-dark f-m-l-xsmall'>
{{$podrska->count()}}
</div>
</a>
</div>
<div class='f-ilb'>
<a class='f-db f-font-condensed f-fc-dark f-bg-light f-p-xsmall f-br-small' href='{{URL::to('/')}}/{{$project->slug}}/map'><span>LOKACIJA</span></a>
</div>

</div>
</div>
<div class='js-routeable-tab' data-route='home'>
<div class='js-home-tab'>
<div class='js-home-tab'>
<div class='f-grid-row f-flex'>
<div class='f-grid-8of12 f-p-xlarge f-b-light f-b-r f-flex-self-stretch'>
<div class='f-p-l-large f-p-r-large'>
<div class='f-grid-row f-p-b-small f-b-b f-b-light'>
<div class='f-grid-6of12'>
<h4><i>Poslednje objave</i></h4>
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
@if($last_update->slika!="")
<div class='f-grid-row f-p-t-small'>
<div class='f-bg-center f-bg-contain f-height-100' style='height: 344px; background-image: url({{$last_update->slika}}?w=516&amp;h=344); background-position: 50% 50%; background-repeat: no-repeat; width: 516px'></div>
</div>
@endif
<div class='f-grid-row'>

<div class='f-content-section' style="word-wrap: break-word;">

{!! htmlspecialchars_decode( (nl2br($last_update->update)) ) !!}



</div>
</div>     @endif
<div class='f-grid-row f-tc f-p-t-large'>   @if(isset($last_update))
<a class='f-anchor' href='#updates'>Pogledaj sve ({{$updates->count()}})</a>    @else    <p ><i>Nema novih ažuriranja.</i></p>        @endif
</div>
<div class='f-b-xlight f-b-b f-p-b-small f-width-100'></div>

<div class='f-m-t-small' style="margin-bottom:0px;">
<h2 style="width:100%;">
<i>Opširnije</i>
</h2>
<div class='js-more-info f-content-section'  style="margin-bottom:8px;margin-top:-14px;">
<p >  {!! htmlspecialchars_decode ( (nl2br($project->opsirnije) ) )!!}</p>
<div class='f-hr-xlight -b-b f-p-b-small f-width-100' ></div>
</div>

</div>

<h3 id='koment'  class='f-b-xlight f-b-b f-p-b-small f-p-t-small f-width-100' >
<center><i>Otvoreni zid kampanje </i> </center>
</h3>



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
        <button class="js-update f-button primary" onclick="joskomentara('{{$project->slug}}', 'divkomentari1','')">Učitaj još komentara... </button>    </div>
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



<a class='f-anchor f-fr f-fs-small f-m-t-xsmall' href='#supporters'>Pogledaj sve</a>
<h3 class='f-m-b-medium'>Podržali</h3>
<div class='columns-1 listing-container' data-limit='10' data-list='donors' data-total='196'>
<div class='items'>

 {{--*/ $var = 0 /*--}}
@foreach ($podrska->slice(0, 10) as $donator)

   <a class="js-list-item f-grid-row f-m-b-medium f-db" href="{{URL::to('/')}}/users/{{$donator->ime_suportera}}" target="_top">
<div class="f-grid-1of12 f-height-100">{{ $var=$var+1}}</div>
<div class="f-grid-3of12">
<div class="f-avatar-small" data-background-image="{{URL::to('/')}}/assets/044fd3a47a31f2606080275edf070028.png?s=60" data-scrollspy="0" style="background-image: url(&quot;{{URL::to('/')}}/assets/044fd3a47a31f2606080275edf070028.png?s=60&quot;);"></div>
</div>
<div class="f-grid-8of12 f-p-l-xsmall f-font-condensed">
<div class="f-grid-row">
<h5 class="f-text-truncate">{{$donator->ime_suportera}}</h5>
<div class="f-fw-normal f-fc-black f-m-t-xsmall">
$150
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
</div>










<div class='js-routeable-tab' data-route='updates' >
<div>
<div class='f-grid-row f-flex'>
<div class='f-grid-8of12 f-p-xlarge f-b-light f-b-r f-flex-self-stretch'>

@foreach($updates as $update)
<div class='js-blog-post-container'>
<div class='js-blog-post bp-post f-grid-row f-m-b-large f-p-t-large f-b-xlight f-b-t' discussion_id='42697' id='updates/blog/update_16-42697'>
<div class='f-grid-2of12 f-tl'>
<a class='f-avatar-small f-fl fb' data-background-image='{{$update->avatar}}?s=60' data-scrollspy='0' href='{{URL::to('/')}}/users/{{$update->user_id}}'></a>
</div>
<div class='f-grid-10of12 f-bg-white'  id="{{$update->id}}" >
<h5 class='f-ilb'>
<a class='f-fc-swatchone' href='{{URL::to('/')}}/users/{{$update->user_id}}'  >
{{$project->objavio}}
</a>
<span class='f-fc-medium f-fw-normal f-fc-dark'>je ažurirao:</span>
</h5>
<span class='f-ilb f-fr f-lh-large f-fw-normal f-font-condensed f-fc-light f-fs-small'>
{{$update->datum}}
</span>
@if($update->slika)
<div class='f-m-t-small f-bg-center' data-background-image='{{$update->slika}}' data-scrollspy='0' style='height: 313px; background-size: contain; background-repeat: no-repeat;'></div>      @endif
<div class='f-fs-large f-fw-normal f-lh-small f-m-t-large f-m-b-xsmall' >
<h3 class='f-fc-black'>{{$update->naslov}}</h3>
<div class='f-content-section' style="word-wrap: break-word;">

{!! htmlspecialchars_decode( (nl2br($update->update)) ) !!}


</div>
</div>
<div class='f-width-100 f-bg-xlight-o-medium f-fs-small f-font-condensed'></div>
<!--<div class='f-grid-row f-m-t-medium f-fs-small'>
<div class='f-grid-6of12'>
<a class='js-blog-like like-item f-clickable f-b-medium f-br-small f-p-xsmall f-ilb f-bg-hover-xlight' data-endpoint='discussions' data-item-id='42697'><i class='fa fa-fw fa-heart f-fc-primary color' style='margin-right:2px'></i><span>0</span>
</a>
<a cb_commentable_id='42697' class='f-m-l-xsmall f-clickable f-b-medium f-br-small f-p-xsmall f-ilb f-bg-hover-xlight' href='#updates/blog/update_16-42697'><i class='fa fa-fw fa-comments f-fc-xdark' style='margin-right:2px'></i><span class='js-blog-comment-count' data-id='42697'>0</span>
</a>
</div>
<div class='f-grid-6of12 f-tr'>
</div>
</div>-->
</div>
</div>




<div class="f-m-b-large f-grid-row">
<div class="f-grid-10of12 f-grid-2of12-offset">



@foreach($update->komentariobjava as $komentar_objava)


<div class="js-blog-comments-list-39724">
<div class="js-comment-item f-grid-row f-p-b-large f-b-t f-b-xlight f-p-t-large" data-comment-id="411061">
<div class="f-grid-2of12 f-tl">
<a class="f-avatar-small f-fl fb" data-background-image="{{$komentar_objava->slika}}?width=60&amp;height=60" data-scrollspy="0" href="/users/1288815" style="background-image: url(&quot;{{$komentar_objava->slika}}?width=60&amp;height=60&quot;);"></a>
</div>
<div class="f-grid-10of12 f-bg-white">
<h5 class="f-ilb">
<a class="f-fc-swatchone" href="/users/1288815">{{$komentar_objava->user}}</a>
<span class="f-fc-dark f-fw-normal">je komentarisao</span>
<span class="f-fc-dark f-fw-normal">na ovoj objavi:</span>
</h5>
<span class="f-ilb f-fr f-fs-small f-fw-normal f-font-condensed f-fc-light f-lh-large">
{{$komentar_objava->vreme}}
</span>
<div class="comment f-font-condensed f-fs-large f-fw-medium f-m-t-xsmall f-of-hidden f-lh-small">
{{$komentar_objava->text }}

</div>
<div class="f-grid-row f-m-t-medium f-fs-small">
<div class="f-grid-6of12">
</div>
<div class="f-grid-6of12 f-tr">
</div>
</div>
</div>
</div>

</div>

@endforeach





@if(Auth::check())
<form action="{{URL::to('/')}}/komentar_objava/novi/{{$update->id}}" method="post">
<div class="f-b-xlight f-b-t f-p-t-medium">
<div class="js-post-comment f-grid-row" data-target=".js-blog-comments-list-39724">
<div class="f-grid-2of12 f-tl">
<div class="f-avatar-small f-fl fb" style="background-image: url({{Auth::user()->slika}});"></div>
</div>
<div class="f-grid-10of12 f-bg-xlight-o-light f-b-light f-br-xsmall f-p-small">
<h5 class="f-m-b-xsmall">{{Auth::user()->fullname}}</h5>
<div class="cb-input-comment f-m-b-small">
<textarea class="f-font-condensed f-fs-large f-fw-normal" name="text" maxlength="140" placeholder="Unesite Komentar..."></textarea>
</div>
 <input type="hidden" name="_token" value="{!! csrf_token() !!}">
  <input type="hidden" name="slug" value="{{$project->slug}}">
   <input type="hidden" name="update_id" value="{{$update->id}}">
<button class="js-submit-btn f-button f-fw-bold primary" data-commentable-id="39724" data-ctype="discussions">
Dodaj Komentar
</button>
<div class="js-loader f-ilb f-m-l-small" style="display:none">
<div class="f-spinner-circles f-bg-light f-fs-small"></div>
</div>
</div>
</div>
</div>
</form>
@else
<div class="f-grid-row f-p-b-medium f-m-t-large f-m-b-large">
<div class="f-grid-6of12">
<h4>Uključite se u konverzaciju</h4>
<p class="f-fs-medium f-fw-normal f-font-condensed f-p-t-xsmall f-fc-dark lh-small">
Ulogujte se sa Facebook Nalogom ili vašim
<a class="f-fc-swatchone f-clickable js-signin-with-email" onclick="show('signin1')" >emailom.</a>
</p>
</div>
<div class="f-grid-6of12 f-tr f-font-condensed">  <a href="{{URL::to('/')}}/auth/social/facebook">
<div class="f-button facebook1 ">Uloguj se preko Facebook-a</div> </a>
</div>
</div>
 @endif







</div>
</div>




</div>







        @endforeach











  </div>



<div class='f-grid-4of12'>
<div class='f-p-xlarge'>
<h3 class='f-fc-black f-m-b-small'>Sva Ažuriranja</h3>

<ul class='f-list no-padding f-b-xlight js-blog-post-listing' style="border-color:#FFFFFF;">

@foreach($updates as $update)

<li discussion_id='42697'>
<div class='f-grid-row f-font-condensed f-bg-xlight'>

<div class='f-grid-10of12'>
<a class='f-db f-bg-white f-bg-xlight-hover f-p-xsmall' href='#{{$update->id}}' style='min-height: 60px'>
<h5>{{$update->naslov}}</h5>
<p cb_commentable_id='42697' class='f-fc-medium'>
<b class='js-blog-comment-count' data-id='42697'>{{$update->komentariobjava()->count()}}</b>
komentara
</p>
</a>
</div>
</div>
</li>
 @endforeach


</ul>

</div>
</div>
</div>

</div>
</div>



















<div class='js-routeable-tab' data-route='comments'>



<script>
var skip;
$( document ).ready(function() {
    skip=12;
});
      function joskomentara(slug,divkomentari,style) {



      var token = $('meta[name="csrf-token"]').attr('content');





$.ajax({
    type: "POST",
    async: false,
    data: '_token=' + token + "&slug=" + slug + "&skip=" + skip,
    url: "{{URL::to('/')}}/komentari/joskomentara",
    success: function(msg){


$.each(msg, function(i,item) {

var large = '<div class="js-comment-item f-grid-row f-p-b-large f-b-t f-b-xlight f-p-t-large" data-comment-id="416428" style="'+style+'"><div class="f-grid-2of12 f-tl"><a class="f-avatar-small f-fl fb" data-background-image="'+item.slika+'?width=60&amp;height=60" data-scrollspy="0" href="/users/891647" style="background-image: url(&quot;'+item.slika+'?width=60&amp;height=60&quot;);"></a></div><div class="f-grid-10of12 f-bg-white"><h5 class="f-ilb"><a class="f-fc-swatchone" href="{{URL::to('/')}}/users/'+item.user+'">'+item.user+'</a><span class="f-fc-dark f-fw-normal f-fc-dark"> je komentarisao/la:</span></h5><div class="f-ilb f-fr f-fs-small f-fw-normal f-font-condensed f-fc-light f-lh-large" style="float:right;"><div>'+item.vreme+ '</div>@if( Auth::check() && Auth::user()->fullname == $project->objavio) <div style="float:right;"> <a title="Izbriši?" onclick="izbrisikoment(\''+$.trim(item.id)+'\')"> <i class="js-dismiss fa fa-times f-fc-dark" style="cursor:pointer;margin-right:0px;" ></i> </a> </div> @endif</div><div class="comment f-font-condensed f-fs-large f-fw-medium f-m-t-xsmall f-of-hidden f-lh-small">'+item.text+'</div><div class="f-grid-row f-m-t-medium f-fs-small"><div class="f-grid-6of12"></div><div class="f-grid-6of12 f-tr"></div></div></div></div>';

         $( "."+divkomentari ).append( large);

                });

              skip=skip+12;




    },
            error   : function(resp){
            alert(JSON.stringify(resp));
             //   alert(resp);
                    }
});



          }
</script>

<div class="divkomentari">
@foreach($komentari as $komentar)
<div class="js-comment-item f-grid-row f-p-b-large f-b-t f-b-xlight f-p-t-large komentar{{$komentar->id}}" data-comment-id="416428" style="margin-left:17px;margin-right:13px;">
<div class="f-grid-2of12 f-tl">
<a class="f-avatar-small f-fl fb" data-background-image="{{$komentar->slika}}?width=60&amp;height=60" data-scrollspy="0" href="/users/891647" style="background-image: url(&quot;{{$komentar->slika}}?width=60&amp;height=60&quot;);"></a>
</div>
<div class="f-grid-10of12 f-bg-white">
<h5 class="f-ilb">
<a class="f-fc-swatchone" href="{{URL::to('/')}}/users/{{$komentar->user}}">{{$komentar->user}}</a>
<span class="f-fc-dark f-fw-normal f-fc-dark">je komentarisao/la:</span>
</h5>
<div class="f-ilb f-fr f-fs-small f-fw-normal f-font-condensed f-fc-light f-lh-large" style="float:right;">
<div >{{$komentar->vreme}}  </div>
 @if( Auth::check() && Auth::user()->fullname == $project->objavio) <div style="float:right;"> <a title="Izbriši?" onclick="izbrisikoment('{{$komentar->id}}')"> <i class='js-dismiss fa fa-times f-fc-dark' style="cursor:pointer;margin-right:0px;" ></i> </a> </div>        @endif
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
  </div>
  @if($komentari->count() > 11)
   <div style="text-align:center;margin-bottom:20px;">

        <button class="js-update f-button primary" onclick="joskomentara('{{$project->slug}}','divkomentari','margin-left:17px;margin-right:13px;margin-top:10px;')">Učitaj još komentara... </button>    </div>
                                   {{--  str_replace('/?', '?',$komentari->fragment('comments')->render()) --}}
                                             @endif



</div>











<div class='js-routeable-tab' data-route='supporters'>
<div class='js-supporters-tab'>
<style>
  .f-spaced-grid-3-medium>*:nth-child(3n+4){margin-left:0}
</style>
<div class='js-routeable-tabs' data-easing='ease-in-out' data-speed='600'>
<div class='js-tab-nav f-p-medium f-b-xlight f-b-b' data-selected='light' data-unselected='white'>
<div class='f-grid-row f-flex-center-y'>
<div class='f-grid-9of12'>
<div class='f-content-spacing-xsmall'>
<div class='f-fl'>
<a class='f-button white f-fs-small'>
Podržali
<i class='f-badge inline f-bg-dark'>{{$podrska->count()}}</i>
</a>
</div>
<!--<div class='f-fl'>
<a class='f-button white f-fs-small' href='#supporters/donors'>
Donirali
<i class='f-badge inline f-bg-dark'>196</i>
</a>
</div>-->
</div>
</div>
<div class='f-grid-3of12'>
<div class='js-search f-fr f-input-decorator f-pos-rel'>
<input class='f-font-condensed' placeholder='Pretraga' type='search'>
<div class='f-decorator f-bg-xlight'>
<i class='fa fa-search'></i>
</div>
<a class='js-clear-search f-pos-abs f-hide' style='top: 8px; right: 40px'>
<i class='fa fa-times-circle fa-lg f-fc-medium f-fc-hover-black f-clickable'></i>
</a>
</div>
</div>
</div>
</div>


<div class='js-routeable-tab f-p-large' data-route='supporters' >











  <div class="js-supporters-tab">
<div class="f-m-b-large f-spaced-grid-3-medium f-width-100 js-list js-participants-list-supporters">

 @foreach($podrska as $podrzao)
<a class="js-list-item f-grid-row f-m-b-medium f-db zahov" data-search="TatyanaMizun" href="{{URL::to('/')}}/users/{{$podrzao->ime_suportera}}" target="_top">
<div class="f-grid-1of12 f-height-100"></div>
<div class="f-grid-3of12">
<div class="f-avatar-small" data-background-image="{{$podrzao->slika}}" data-scrollspy="0" style="background-image: url("{{$podrzao->slika}}");"></div>
</div>
<div class="f-grid-8of12 f-p-l-xsmall f-font-condensed">
<div class="f-grid-row">
<h5 class="f-text-truncate">{{$podrzao->ime_suportera}}</h5>
<div class="f-fw-normal f-fc-black f-m-t-xsmall">Podrška</div>
</div>
</div>
</a>

   @endforeach

</div>


<div class='js-spinner f-tc f-width-100'>
<div class='f-ilb f-fs-large f-m-t-xlarge'>

</div>
</div>
<div class='f-font-condensed f-fs-large f-hide f-tc f-width-100 js-load-more' data-add-method='append' data-limit='24' data-page='1' data-target='.js-participants-list-supporters'>
<a class='f-fw-bold f-fc-medium f-fc-hover-black f-clickable'>
Load More
</a>
<div class='js-processing f-ilb f-hide'>

</div>
</div>

</div>               </div>
<div class='js-routeable-tab f-p-large' data-route='donors' >


<div class='f-m-b-large f-spaced-grid-3-medium f-width-100 js-list js-participants-list-donors'>



@foreach($donatori as $donator)
<a class="js-list-item f-grid-row f-m-b-medium f-db" data-search="Joseph Bilios" href="/users/1159121" target="_top">
<div class="f-grid-1of12 f-height-100"></div>
<div class="f-grid-3of12">
<div class="f-avatar-small" data-background-image="{{$donator->slika}}" data-scrollspy="0" style="background-image: url("{{$donator->slika}}");"></div>
</div>
<div class="f-grid-8of12 f-p-l-xsmall f-font-condensed">
<div class="f-grid-row">
<h5 class="f-text-truncate">{{$donator->ime_donatora}}</h5>
<div class="f-fw-normal f-fc-black f-m-t-xsmall">
€{{$donator->iznos}}
<span class="f-fc-light">Donacija</span>
</div>
</div>
</div>
</a>
@endforeach



</div>

<div class='js-spinner f-tc f-width-100'>
<div class='f-ilb f-fs-large f-m-t-xlarge'>

</div>
</div>


</div>
</div>


</div>
</div>




















<div class='js-routeable-tab' data-route='map'>
<div>
<!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d23548.750113519607!2d18.520248106676117!3d42.45765882969947!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x134c3b7bad29fa7d%3A0xd05def2065636e1a!2sHerceg+Novi%2C+Montenegro!5e0!3m2!1sen!2s!4v1456304473505" width="100%" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
-->
<iframe width="100%" height="600" frameborder="0" style="border:0"
src="https://www.google.com/maps/embed/v1/search?q={{$project->lokacija}}&key=AIzaSyAzYru4svpMsF3ZJchpC-saxwfrWsrGIes" allowfullscreen></iframe>


</div>
</div>


</div>

</div>
</div>
</div>

</div>