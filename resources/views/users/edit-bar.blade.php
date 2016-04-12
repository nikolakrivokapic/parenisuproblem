<div style='background-color: white'>
<div class='f-page-container'>
<div class='f-grid-row f-fs-medium f-font-condensed f-lh-large f-p-t-xsmall' style='padding-bottom: 2px'>
<div class='f-grid-8of12 f-tl'>
<h3 class='js-cta-title f-fc-black f-fl f-text-truncate' style='max-width: 90%'>
{{$kampanja->naslov}}
</h3>
<div class='f-fl f-p-l-xsmall f-m-t-small f-fs-medium f-lh-small'>
<p data-mp-CTA='Status' data-mp-action='Dashboard Click' data-mp-type='Your Page'>
<i class='fa fa-circle' style='color: #ff8b5d'></i>
skica
</p>
</div>
</div>
<div class='f-grid-4of12 f-tr'>
<!--<a class='f-button primary f-m-r-xsmall f-tc f-text-truncate' href='/kdfs-sdfdsf/edit' id='mp-cta-share' mp_position='Campaign Bar' rel='nofollow' style='max-width: 60%;'>SAČUVAJ</a>   -->
@if($kampanja->live == "ne")
<a class='js-edit-launch f-button f-m-r-xsmall f-tc f-text-truncate' onclick="show('objavi')" id='mp-cta-share' mp_position='Campaign Bar' rel='nofollow' style='color: white; background-color: #4bc276; max-width: 60%;'>OBJAVI KAMPANJU</a>
@else
<a class='js-edit-launch f-button f-m-r-xsmall f-tc f-text-truncate' onclick="show('pauziraj')" id='mp-cta-share' mp_position='Campaign Bar' rel='nofollow' style='color: white; background-color: #4bc276; max-width: 60%;'>PAUZIRAJ KAMPANJU</a>
@endif
</div>
</div>
</div>
</div>

 <script>
 function objavi() {
             var token = $('meta[name="csrf-token"]').attr('content');

             var msg_id = $(this).attr("msg_id");
             var dataString = 'id=' + '{{$kampanja->id}}' + '&_token=' + token ;

                $.ajax({
                type: "POST",
                url: '{{URL::to('/')}}/objavi',
                data: dataString,
                cache: false,

                success: function(html)
                {


                 hide('objavi');
                 location.reload();
                },
                    error   : function(resp){
          alert('Greska.');
                  }

                });

 }


  function pauziraj() {
             var token = $('meta[name="csrf-token"]').attr('content');

             var msg_id = $(this).attr("msg_id");
             var dataString = 'id=' + '{{$kampanja->id}}' + '&_token=' + token ;

                $.ajax({
                type: "POST",
                url: '{{URL::to('/')}}/pauziraj',
                data: dataString,
                cache: false,

                success: function(html)
                {


                 hide('pauziraj');
                 location.reload();
                },
                    error   : function(resp){
          alert('Greska.');
                  }

                });

 }


 </script>
  <div id='objavi' class="popup-instance f-style-guide overlay" style="display:none;position:fixed;z-index:9;" ><div class="f-fs-medium f-popup f-z-popup" >
  <div class="f-bg-black f-opacity-medium f-popup-overlay" style="height: 3581px;"></div>
  <div class="f-anim-fadeinup-fast f-bg-xlight f-br-medium f-fc-xdark f-popup-container f-pos-rel f-tl" style="width: 490px; position: absolute; margin-top: 0px; top: 150px; left: 600px; height: 335px;">
    <i class="f-align-tr f-clickable f-fc-hover-dark f-fc-medium f-fs-xlarge f-m-medium f-popup-close fa fa-times" style="z-index: 100;" onclick="hide('objavi')"></i>
    <div class="f-p-medium f-tl">
  <p class="f-fc-black f-lh-small">Vaša kampanja će sada biti objavljena i zvanično dostupna na našem sajtu! <br><br> Preporučujemo vam da još jednom provjerite da li ste unijeli sve relevantne informacije putem linka "Izmjenite Stranicu", kako bi posjetioci bili što bolje informisani o detaljima kampanje.<br><br>Ukoliko ste sigurni da ste unijeli sve informacije, kliknite na dugme "Objavi" kako bi ste zvanično objavili kampanju. </p>
</div>


<div class="f-grid-row f-p-large f-tl">

  <div class="f-grid-7of12 f-p-r-medium f-pos-rel">

    <div class="f-input-decorator">



   <button class="f-button f-flex-align-left f-fw-bold js-submit primary" onclick="objavi()" style="margin-top:10px;">Objavi</button>
   <button class="f-button f-flex-align-left f-fw-bold js-submit primary" onclick="hide('objavi')" style="margin-left:30px;">Odustani</button>
    </div>
  </div>

</div>
  </div>
</div></div>

<div id='pauziraj' class="popup-instance f-style-guide overlay" style="display:none;position:fixed;z-index:9;" ><div class="f-fs-medium f-popup f-z-popup" >
  <div class="f-bg-black f-opacity-medium f-popup-overlay" style="height: 3581px;"></div>
  <div class="f-anim-fadeinup-fast f-bg-xlight f-br-medium f-fc-xdark f-popup-container f-pos-rel f-tl" style="width: 490px; position: absolute; margin-top: 0px; top: 150px; left: 600px; height: 335px;">
    <i class="f-align-tr f-clickable f-fc-hover-dark f-fc-medium f-fs-xlarge f-m-medium f-popup-close fa fa-times" style="z-index: 100;" onclick="hide('objavi')"></i>
    <div class="f-p-medium f-tl">
  <p class="f-fc-black f-lh-small">Da li ste sigurni da želite pauzirati kampanju i učiniti je nedostupnom na našem sajtu? <br><br> Svi dosadašnji detalji kampanje, ažuriranja i komentari i dalje će vam biti dostupni i kampanju će te moći opet učiniti dostupnom u svakom momentu. </p>
</div>


<div class="f-grid-row f-p-large f-tl">

  <div class="f-grid-7of12 f-p-r-medium f-pos-rel">

    <div class="f-input-decorator">



   <button class="f-button f-flex-align-left f-fw-bold js-submit primary" onclick="pauziraj()" style="margin-top:10px;">Pauziraj</button>
   <button class="f-button f-flex-align-left f-fw-bold js-submit primary" onclick="hide('pauziraj')" style="margin-left:30px;">Odustani</button>
    </div>
  </div>

</div>
  </div>
</div></div>


<div style='background-color: #25292b'>
<div class='f-page-container'>
<div class='f-grid-row f-caps f-fs-medium f-font-condensed f-lh-large'>
<div class='f-grid-7of12 f-tl'>
<ul>
<li class='f-ilb f-p-r-medium'>
<a class='f-fc-hover-primary f-fc-primary f-fc-white f-fw-bold f-pos-rel' data-page='dash' href='{{URL::to('/')}}/dash/{{$kampanja->slug}}'><i class='fa fa-home f-fs-large f-p-r-xsmall'></i>SAŽETAK
<div class='f-ilb f-pos-abs' style='top: -1em; right: -1em'>
<i class='f-badge inline f-bg-primary'>1</i>
</div>
</a>
</li>
<li class='f-ilb f-p-large'>
<a class='f-fc-hover-primary f-fc-white f-fw-bold' data-page='kdfs-sdfdsf' href='{{URL::to('/')}}/page-view/{{$kampanja->slug}}'><i class='fa fa-flag f-fs-large f-p-r-xsmall'></i>Stranica
</a>
</li>
<li class='f-ilb f-p-large f-fs-medium f-fw-bold'>
<a class='f-fc-hover-primary f-fc-white js-edit-page' data-page='edit' href='{{URL::to('/')}}/page-edit/{{$kampanja->slug}}'><i class='fa fa-pencil f-fs-large f-p-r-xsmall'></i>Izmjenite Stranicu
</a>
</li>
<!--<li class='f-ilb f-p-large f-fs-medium f-fw-bold'>
<a class='f-fc-hover-primary f-fc-white f-pos-rel js-email-link' data-page='email, email-history' href='/kdfs-sdfdsf/email'><i class='fa fa-envelope f-fs-large f-p-r-xsmall'></i>Email
</a>
</li>-->
</ul>
</div>
<div class='f-grid-5of12 f-tr'>
<ul>
<!--<li class='f-ilb f-p-large f-fs-medium f-fw-bold'>
<a class='f-fc-hover-primary f-fc-white' data-page='tools' href='/kdfs-sdfdsf/tools'>Embedovanje</a>
</li>-->
<li class='f-ilb f-p-large f-fs-medium f-fw-bold'>
<a class='f-fc-hover-primary f-fc-white' data-page='settings' href='{{URL::to('/')}}/podesavanja/{{$kampanja->slug}}'>Podešavanja</a>
</li>
<!--<li class='f-ilb f-p-l-medium f-fs-medium f-fw-bold'>
<a class='f-fc-hover-primary f-fc-white' data-page='funds' href='{{URL::to('/')}}/sredstva/{{$kampanja->slug}}'>Sredstva</a>
</li>-->
</ul>
</div>
</div>
</div>
</div>