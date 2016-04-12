 <script>
 function show(target) {
    document.getElementById(target).style.display = 'block';
}

function hide(target) {
    document.getElementById(target).style.display = 'none';
}

</script>





@if(Auth::check())


<div id="contacte" class="f-fs-medium f-popup f-z-popup" style="display:none;height: 6833px;position:fixed;z-index:9;">
<form id="sendforma" action="{{URL::to('/')}}/poruke/slanje" method="post" style="background-color:FFFFFF#">
  <div class="f-bg-black f-opacity-medium f-popup-overlay" style="height: 6833px;"></div>
  <div class="f-anim-fadeinup-fast f-bg-xlight f-br-medium f-fc-xdark f-popup-container f-pos-rel f-tl" style="width: 400px; position: fixed; margin-left: -200px; margin-top: -261px; top: 50%; left: 50%; height: 532px;">
    <i class="f-align-tr f-clickable f-fc-hover-dark f-fc-medium f-fs-xlarge f-m-medium f-popup-close fa fa-times" style="z-index: 100;" onclick="hide('contacte')"></i>
    <script src="https://www.google.com/recaptcha/api.js" async:="" defer:=""></script>
<div class="f-p-medium" style="margin-bottom:0;">
  <p>Ako imate bilo kakva pitanja ili vam treba asistencija<br> pri upotrebi web sajta, kontaktirajte nas privatnom porukom i odgovorićemo vam u najkraćem roku:</p>
</div>
<div class="f-hr"></div>
<div class="f-font-condensed f-p-medium">
  <div class="f-grid-row f-m-b-small">
    <div class="f-grid-6of12 f-p-r-small">
      <h5>Vaše Ime</h5>
      <input type="text" name="name" value="" placeholder="{{Auth::user()->fullname}}" disabled>
    </div>


  </div>
  <h5>Poruka</h5>
  <textarea id="textbox" maxlength="1000" name="text" style="height: 150px; resize: none"></textarea>

  <input type="hidden" name="autor2" value="PNP Portal">
  <input type="hidden" name="sender" value="@if(Auth::check()){{Auth::user()->id}}@endif">
  <input type="hidden" name="autor" value="@if(Auth::check()){{Auth::user()->fullname}}@endif">


</div>
  <input type="hidden" name="_token" value="{!! csrf_token() !!}">

<div class="f-flex-center-y f-p-medium">

     <button class="f-button f-flex-align-left js-submit primary" type="submit">Pošalji PORUKU</button>
       </div>
       <div class="f-hr"></div>
  <div class="f-m-l-small js-loader" style="margin-top:10px;">   Odgovore provjerite u <b>Inbox</b>-u, putem Meni-ja u gornjem desnom uglu sajta.


</div>
  </div>
  </form>  
</div>

  @endif


<div id="uvTab" style="border-top-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-style: solid none solid solid; border-top-color: rgb(255, 255, 255); border-bottom-color: rgb(255, 255, 255); border-left-color: rgb(255, 255, 255); border-radius: 4px 0px 0px 4px; box-shadow: rgba(255, 255, 255, 0.247059) 1px 1px 1px inset, rgba(0, 0, 0, 0.498039) 0px 1px 2px; font-style: normal; font-variant: normal; font-weight: bold; font-stretch: normal; font-size: 14px; line-height: 1em; font-family: Arial, sans-serif; position: fixed; right: 0px; top: 65%; z-index: 9999; margin-top: -87px; background: url(&quot;http://widget.uservoice.com/pkg/clients/widget2/tab-right-dark-da2413549ce324fc421ae86a0e5881ee.png&quot;) 50% 0px no-repeat rgb(255, 139, 93);" class="uv-tab uv-slide-right ">
<a id="uvTabLabel" style="background-color: transparent; display:block;padding:39px 5px 10px 5px;text-decoration:none;" href="{{URL::to('/')}}/faq" target="_blank"><img src="http://widget.uservoice.com/dcache/widget/feedback-tab.png?t=Česta pitanja;c=ffffff&amp;r=90" alt="Pitanja &amp; Pomoć" style="padding:0; margin:0;"></a></div>

<div id="uvTab" style="border-top-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-style: solid none solid solid; border-top-color: rgb(255, 255, 255); border-bottom-color: rgb(255, 255, 255); border-left-color: rgb(255, 255, 255); border-radius: 4px 0px 0px 4px; box-shadow: rgba(255, 255, 255, 0.247059) 1px 1px 1px inset, rgba(0, 0, 0, 0.498039) 0px 1px 2px; font-style: normal; font-variant: normal; font-stretch: normal; font-size: 14px; line-height: 1em; font-family: Arial, sans-serif; position: fixed; right: 0px; top: 35%; z-index: 9999; margin-top: -87px; background: url(&quot;http://widget.uservoice.com/pkg/clients/widget2/tab-right-dark-da2413549ce324fc421ae86a0e5881ee.png&quot;) 50% 0px no-repeat rgb(255, 139, 93);" class="uv-tab uv-slide-right ">
<a id="uvTabLabel" style="background-color: transparent; display:block;padding:39px 5px 10px 5px;text-decoration:none;cursor:pointer;" @if(!Auth::check()) onclick="show('signin1')" @else onclick="show('contacte')" @endif ><img src="http://widget.uservoice.com/dcache/widget/feedback-tab.png?t=Pomoć;c=ffffff&amp;r=90" alt="Pitajte nas!" style="border:0; background-color: transparent; padding:0; margin:0;"></a></div>


<footer id="futke" style="margin-bottom:-30px; -webkit-transform: translateZ(0);"><div class='f-pos-rel'>
<div class='f-style-guide f-bg-white'>
<div class='f-font-condensed f-bg-black-o-dark f-p-t-large'>
<div class='f-page-container f-p-t-xlarge f-r-tablet-hide f-r-phone-hide'>
<div class='f-grid-row f-tl'>
<div class='f-grid-6of12'>
<div class='f-m-b-medium f-normal-caps'>
<a class='f-fs-large f-opacity-dark f-fc-light f-fc-hover-light'>Kategorije</a>
</div>
<div class='f-grid-row'>
<div class='f-grid-4of12'>
<ul>

<li class='f-p-b-xsmall'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' href='{{URL::to('/')}}/kategorija/liječenje'>Liječenje</a>
</li>
<li class='f-p-b-xsmall'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' href='{{URL::to('/')}}/kategorija/edukacija'>Školovanje</a>
</li>
<li class='f-p-b-xsmall'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' href='{{URL::to('/')}}/kategorija/kultura'>Kultura</a>
</li>
<li class='f-p-b-xsmall'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' href='{{URL::to('/')}}/kategorija/nevladineorganizacije'>Nevladine Organizacije</a>
</li>
<li class='f-p-b-xsmall'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' href='{{URL::to('/')}}/kategorija/sport'>Sport</a>
</li>
</ul>
</div>
<div class='f-grid-4of12'>
<ul>
<li class='f-p-b-xsmall'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' href='{{URL::to('/')}}/kategorija/kluboviorganizacije'>Klubovi i Organizacije</a>
</li>
<li class='f-p-b-xsmall'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' href='{{URL::to('/')}}/kategorija/životinje'>Životinje</a>
</li>
<li class='f-p-b-xsmall'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' href='{{URL::to('/')}}/kategorija/religijskeorganizacije'>Religijske organizacije</a>
</li>
<li class='f-p-b-xsmall'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' href='{{URL::to('/')}}/kategorija/putovanja'>Putovanja </a>
</li>
<li class='f-p-b-xsmall'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' href='{{URL::to('/')}}/kategorija/memorijali'>Memorijali</a>
</li>

</ul>
</div>
<div class='f-grid-4of12'>
<ul>
<li class='f-p-b-xsmall'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' href='{{URL::to('/')}}/kategorija/politika'>Politika</a>
</li>
<li class='f-p-b-xsmall'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' href='{{URL::to('/')}}'>Sve</a>
</li>

</ul>
</div>
</div>
</div>
<div class='f-grid-4of12 f-p-l-xlarge'>
<div class='f-fs-large f-m-b-medium f-opacity-dark f-normal-caps f-fc-light'>
O Nama
</div>
<div class='f-grid-row'>
<div class='f-grid-8of12 f-p-r-xlarge'>
<ul>
<li class='f-p-b-xsmall'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' data-event='FooterLink' href='{{URL::to('/')}}/ideje'>
Ideje za Fundraising
</a>
</li>
<li class='f-p-b-xsmall'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' data-event='FooterLink' href='{{URL::to('/')}}/kakofunkcionisemo'>
Kako funkcionišemo
</a>
</li>
<li class='f-p-b-xsmall'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' data-event='FooterLink' href='{{URL::to('/')}}/blog'>
 Blog
</a>
</li>
<li class='f-p-b-xsmall'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' data-event='FooterLink' href='{{URL::to('/')}}/pravila-upotrebe'>
Pravila
</a>
</li>

</ul>
</div>
<div class='f-grid-4of12'>
<ul>
<li class='f-p-b-xsmall'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' data-event='FooterLink' href='{{URL::to('/')}}/faq'>
FAQ
</a>
</li>
<li class='f-p-b-xsmall'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' data-event='FooterLink' href='{{URL::to('/')}}/o-nama'>
O nama
</a>
</li>
<li class='f-p-b-xsmall'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' data-event='FooterLink' href='mailto:info@parenisuproblem.me'>
Kontaktirajte nas
</a>
</li>


</ul>
</div>
</div>
</div>
<div class='f-grid-2of12 f-p-l-xlarge'>
<div class='f-fs-large f-m-b-medium f-opacity-dark f-normal-caps f-fc-light'>
Pratite nas
</div>
<div class='f-grid-row'>
<ul>
<li class='f-p-b-small'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' href='http://facebook.com/parenisuproblem' target='_blank'>
<i class='fa fa-fw fa-facebook'></i>
Facebook
</a>
</li>
<li class='f-p-b-small'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' href='http://www.twitter.com/parenisuproblem' target='_blank'>
<i class='fa fa-fw fa-twitter'></i>
Twitter
</a>
</li>
<li class='f-p-b-small'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' href='http://www.instagram.com/parenisuproblem' target='_blank'>
<i class='fa fa-fw fa-instagram'></i>
Instagram
</a>
</li>
<li class='f-p-b-small'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' href='http://plus.google.com' target='_blank'>
<i class='fa fa-fw fa-google-plus'></i>
Google+
</a>
</li>
<li class='f-p-b-small'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' href='http://pinterest.com/parenisuproblem' target='_blank'>
<i class='fa fa-fw fa-pinterest'></i>
Pinterest
</a>
</li>
<li class='f-p-b-small'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' href='{{URL::to('/')}}/blog' target='_blank'>
<i class='fa fa-fw fa-comments'></i>
Blog
</a>
</li>
</ul>
</div>
</div>
</div>
<div class='f-grid-row f-tl f-m-t-medium'>
<div class='f-fs-large f-m-b-large f-opacity-dark f-normal-caps f-fc-light' style='display: inline'>
Lokacije projekata
</div>
<ul class='footer-locations f-lh-large' style='display: inline'>
 @if(isset($lokacije))
@foreach($lokacije as $project)
<li class='f-p-l-xsmall f-p-r-xsmall' style='display: inline'>
<a class='f-fc-dark f-lh-xsmall f-opacity-light f-fw-normal f-fc-hover-light' href='{{URL::to('/')}}/lokacija/{{$project->lokacija}}'>{{$project->lokacija}}</a>
</li>

 @endforeach

 @endif


</ul>
</div>

</div>
<div class='f-page-container responsive f-r-desktop-hide f-tc f-m-t-large f-font-condensed'>
<p>Pare Nisu Problem</p>
<p class='f-fs-large'>
<a class='f-fc-primary' href='{{ URL::to('/') }}/kampanje/nova'>Pokrenite kampanju besplatno</a>
</p>
</div>
<div class='f-page-container responsive f-tc f-m-t-small f-p-b-xlarge'>
<a class='powered-by knockout' href='http://parenisuproblem.me'>
<style>
  .knockout svg #background-circle { fill: transparent }
  .knockout svg #knockout-heart path { fill: #f2f2f4 }
  .knockout svg #fund-text path { fill: #f2f2f4 }
</style>

<img src="{{ URL::to('/') }}/assets/footer.gif" alt="" width="90px" height="90px";>
</a>
</div>
</div>
</div>

</div>



<script>
  !function(a){var b,c,d,e;b=this,c=[],d=function(c,d,e){if("function"==typeof c)c.call(a),e.call(b);else{var f=document.createElement("script");f.src=c,d&&(f.onload=function(){e.call(b)},f.onreadystatechange=function(){"complete"===this.readyState&&e.call(b)}),document.body.appendChild(f),d||e.call(b)}},e=function(){if(c.length>0){var a=c.shift();d(a.f,a.b,e)}},a.jsOnload=function(a,b){c.push({f:a,b:b||!1})},a.addEventListener?a.addEventListener("load",e,!1):a.onload=e}(window);
</script>

<script>
  jsOnload("{{URL::to('/')}}/js/sentinel_base-797f9e3bcc6eee1ed77caf2237a18774.js", true);
</script>

<script>
  jsOnload(function(){
    var e = document.createEvent('Event');
    e.initEvent('sentinel:load', true, true);
    document.dispatchEvent(e);
  });
</script>



<script>
  window.HOMEPAGE_VERSION = 'three';
  jsOnload("{{URL::to('/')}}/js/homepage-v3-b643dd628dcefa2351e0d2d836e38cbe.js", false);
  jsOnload(function(){
    var sentinel = Backbone.Sentinel.getInstance();
    sentinel.env.countries = [{"name":"United States","country":"us","currency":"USD","currency_name":"US Dollars","currency_symbol":"$","currency_separator":".","currency_delimiter":",","postal_code_regex":"[0-9]{5}","postal_code_maxlen":5},{"name":"Canada","country":"ca","currency":"CAD","currency_name":"Canadian Dollars","currency_symbol":"$","currency_separator":".","currency_delimiter":",","postal_code_regex":"^[ABCEGHJKLMNPRSTVXY]{1}\\d{1}[A-Z]{1} *\\d{1}[A-Z]{1}\\d{1}$","postal_code_maxlen":7},{"name":"United Kingdom","country":"gb","currency":"GBP","currency_name":"British Pounds","currency_symbol":"\u00a3","currency_separator":".","currency_delimiter":",","postal_code_regex":"^(GIR 0AA)|((([ABCDEFGHIJKLMNOPRSTUWYZ][0-9][0-9]?)|(([ABCDEFGHIJKLMNOPRSTUWYZ][ABCDEFGHKLMNOPQRSTUVWXY][0-9][0-9]?)|(([ABCDEFGHIJKLMNOPRSTUWYZ][0-9][ABCDEFGHJKSTUW])|([ABCDEFGHIJKLMNOPRSTUWYZ][ABCDEFGHKLMNOPQRSTUVWXY][0-9][ABEHMNPRVWXY])))) [0-9][ABDEFGHJLNPQRSTUWXYZ]{2})$","postal_code_maxlen":8},{"name":"Australia","country":"au","currency":"AUD","currency_name":"Australian Dollars","currency_symbol":"$","currency_separator":".","currency_delimiter":",","postal_code_regex":"[0-9]{4}$","postal_code_maxlen":4}];
  });
</script>


<!--[if IE 9]>
<script>
  window.IE_VERSION = 9;
</script>
<![endif]-->
<!--[if lt IE 9]>
<script>
  window.IE_LOW = true;
</script>
<![endif]-->





 </footer>