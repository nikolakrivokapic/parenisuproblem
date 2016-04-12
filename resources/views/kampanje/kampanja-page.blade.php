

 <script>
var skip;
$( document ).ready(function() {
    skip=12;
});
      function joskomentara(slug,divkomentari,style) {



      var token = $('meta[name="csrf-token"]').attr('content');





$.ajax({
    type: "POST",

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
           @if($project->slika4 != "")                       <img src="{{$project->slika4}}"/>     @endif
              @if($project->slika5 != "")                       <img src="{{$project->slika5}}"/>     @endif
                 @if($project->slika6 != "")                       <img src="{{$project->slika6}}"/>     @endif
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

    var geocoder =  new google.maps.Geocoder();
    if( "{{Auth::user()->grad}}" != "") {
                               geocoder.geocode( { 'address':"{{Auth::user()->grad}}"}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {

                         var token = $('meta[name="csrf-token"]').attr('content');

             var msg_id = $(this).attr("msg_id");
             var dataString = 'ime_suportera='+ "{{Auth::user()->fullname}}" + '&slug=' + "{{$project->slug}}" + "&slika=" + "{{Auth::user()->slika}}" + '&_token=' + token +
             "&lat=" +   results[0].geometry.location.lat()  + "&long=" + results[0].geometry.location.lng();

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


          } else {
            alert("Something got wrong " + status);
          }
        });
    }
    else {
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
<div class='js-tabs f-bg-white' style="z-index: 999999;">
<div class='js-routeable-tabs js-rt-parent f-fc-black f-b-light f-b-t' data-easing='ease-in-out' data-push-state data-speed='600'>
<div class='js-tab-nav f-p-medium f-bg-xlight f-clearfix f-b-light f-b-b' data-selected='f-bg-light f-fc-black' data-unselected='f-bg-xlight' >
<div class='f-content-spacing-xlarge f-fs-large f-fw-bold'>

<div class='f-ilb linkpocetna'>
<a class='f-db f-font-condensed f-fc-dark f-bg-light f-p-xsmall f-br-small' style="cursor:pointer;"><span>POČETNA</span></a>
</div>


<div class='f-ilb linknovosti'>
  <a class='f-db f-font-condensed f-fc-dark f-bg-light f-p-xsmall f-br-small' style="cursor:pointer;"><span>NOVOSTI</span>
 <div class='f-badge inline f-bg-white f-fc-dark f-m-l-xsmall'>
{{$updates->count()}}
</div>
  </a>
</div>

<div class='f-ilb linkkomentari'>
<a class='f-db f-font-condensed f-fc-dark f-bg-light f-p-xsmall f-br-small' style="cursor:pointer;"><span>KOMENTARI</span><div class='f-badge inline f-bg-white f-fc-dark f-m-l-xsmall'>
{{$count}}
</div>
</a>
</div>
<div class='f-ilb linkpodrzali'>
<a class='f-db f-font-condensed f-fc-dark f-bg-light f-p-xsmall f-br-small' style="cursor:pointer;"><span>PODRŽALI</span><div class='f-badge inline f-bg-white f-fc-dark f-m-l-xsmall'>
{{$podrska->count()}}
</div>
</a>
</div>
<div class='f-ilb linklokacije'>
<a class='f-db f-font-condensed f-fc-dark f-bg-light f-p-xsmall f-br-small' style="cursor:pointer;"><span>MAPA PODRŠKE</span></a>
</div>

</div>
</div>
<div class='pocetnasegment' data-route='home'>
@include('kampanje.pocetna')
</div>










<div class='updatesegment' data-route='updates' >

</div>

















<div class='komentarisegment' data-route='comments'>
</div>











<div class='podrzalisegment' data-route='supporters'>
</div>



 <div id='lokacija45' >

</div>









<script>
       $(document).ready(function() {

        $(document).on('click', '.linklokacije a', function (e) {

          e.preventDefault();

            $.ajax({
            url : '{{URL::to('/')}}/stranica/getlokacija',
            data: "id="+ "{{$project->id}}",
            async: false,
            dataType: 'json',

            }).done(function (data) {
                   $('.pocetnasegment').empty();
                    $('.updatesegment').empty();
                     $('.komentarisegment').empty();
                        hide('futke');
                        $('.podrzalisegment').empty();
                   $('#lokacija45').hide().html(data).fadeIn('normal');


        });
               show('futke');  
        });


         $(document).on('click', '.linkpocetna a', function (e) {

          e.preventDefault();

            $.ajax({
            url : '{{URL::to('/')}}/stranica/getpocetna',
            data: "id="+ "{{$project->id}}",
             async: false,
            dataType: 'json',

            }).done(function (data) {
                   $('#lokacija45').empty();
                    $('.updatesegment').empty();
                    hide('futke');

                     $('.komentarisegment').empty();
                        $('.podrzalisegment').empty();
                        skip=12;
                   $('.pocetnasegment').hide().html(data).fadeIn('normal');



        });
               show('futke');
        });



             $(document).on('click', '.linkkomentari a', function (e) {

          e.preventDefault();

            $.ajax({
            url : '{{URL::to('/')}}/stranica/getkomentari',
            data: "id="+ "{{$project->id}}",
             async: false,
            dataType: 'json',

            }).done(function (data) {
                   $('#lokacija45').empty();
                    $('.updatesegment').empty();
                       hide('futke');
                     $('.pocetnasegment').empty();
                        $('.podrzalisegment').empty();
                        skip=12;
                   $('.komentarisegment').hide().html(data).fadeIn('normal');



        });

        show('futke');
        });





             $(document).on('click', '.linkpodrzali a', function (e) {

          e.preventDefault();

            $.ajax({
            url : '{{URL::to('/')}}/stranica/getpodrzali',
            data: "id="+ "{{$project->id}}",
             async: false,
            dataType: 'json',

            }).done(function (data) {
                   $('#lokacija45').empty();
                    $('.updatesegment').empty();
                     $('.komentarisegment').empty();
                        hide('futke');
                        $('.pocetnasegment').empty();
                   $('.podrzalisegment').hide().html(data).fadeIn('normal');


        });
               show('futke');
        });




             $(document).on('click', '.linknovosti a', function (e) {

          e.preventDefault();

            $.ajax({
            url : '{{URL::to('/')}}/stranica/getnovosti',
            data: "id="+ "{{$project->id}}",
             async: false,
            dataType: 'json',

            }).done(function (data) {

                   $('#lokacija45').empty();
                    $('.pocetnasegment').empty();
                     $('.komentarisegment').empty();
                        hide('futke');
                        $('.podrzalisegment').empty();
                   $('.updatesegment').hide().html(data).fadeIn('normal');


        });
               show('futke');
        });





       });
</script>









</div>

</div>
</div>
</div>



