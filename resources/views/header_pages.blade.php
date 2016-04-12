<div class='f-pos-fix f-width-100 f-z-appribbon'>
<div class='js-appribbon f-pos-rel' data-mode='homepage'>
<div class='f-b-primary f-b-b three'>
<div class='f-app-ribbon'>
<div class='f-page-container responsive'>
<div class='js-collapse-icon collapse-icon f-p-l-medium f-clickable'>
<i class='fa fa-bars fa-lg f-fc-dark f-fc-hover-black'></i>
</div>

<div class='brand'>
<div class='js-brand' data-height='20'>
<a class='f-ilb' data-fallback='/assets/logo.png' href='{{ URL::to('/') }}'>
<style>
  .knockout svg #background-circle { fill: transparent }
  .knockout svg #knockout-heart path { fill: #f2f2f4 }
  .knockout svg #fund-text path { fill: #f2f2f4 }
</style>

<img src="{{ URL::to('/') }}/assets/logo.png" alt="">
</a>
</div>

</div>
@if(!Auth::check())
<ul class='middle js-collapse-show f-z-appribbon'>
<li class='f-font-condensed f-bg-hover-xlight f-p-xsmall f-m-r-xsmall f-br-small'>
<a href='{{URL::to('/')}}/prednosti'>Prednosti</a>
</li>
<li class='f-font-condensed f-bg-hover-xlight f-p-xsmall f-m-r-xsmall f-br-small'>
<a href='{{URL::to('/')}}/kakofunkcionisemo'>Kako funkcionišemo</a>
</li>
<li class='f-font-condensed f-bg-hover-xlight f-p-xsmall f-m-r-xsmall f-br-small'>
<a href='{{URL::to('/')}}/ideje'>Ideje za prikupljanje novca</a>
</li>
<li class='f-font-condensed f-bg-hover-xlight f-p-xsmall f-m-r-xsmall f-br-small'>
<a href='{{URL::to('/')}}/blog'>Blog</a>
</li>
<li class='f-font-condensed f-bg-hover-xlight f-p-xsmall f-m-r-xsmall f-br-small'>
<a href='{{URL::to('/')}}/pretraga'>Pretraga</a>
</li>

<li class='f-font-condensed f-bg-hover-xlight f-p-xsmall f-m-r-xsmall f-br-small'>
<a href='{{URL::to('/')}}/o-nama'>O Nama</a>
</li>

</ul>
<div class='js-links f-fs-small right'>

<a class='f-button white f-m-r-small f-fw-bold' href="#" onclick="show('signin1')">Ulogujte se</a>



 <script>
 function show(target) {
    document.getElementById(target).style.display = 'block';
}

function hide(target) {
    document.getElementById(target).style.display = 'none';
}

</script>



@include('users.signin1')




<a class='f-button primary f-fw-bold' href='{{URL::to('/')}}/kampanje/nova'>Pokrenite kampanju</a>


@else


<ul class='middle js-collapse-show f-z-appribbon'>
<li class='f-font-condensed f-bg-hover-xlight f-p-xsmall f-m-r-xsmall f-br-small'>
<a href='{{URL::to('/')}}/prednosti'>Prednosti</a>
</li>
<li class='f-font-condensed f-bg-hover-xlight f-p-xsmall f-m-r-xsmall f-br-small'>
<a href='{{URL::to('/')}}/kakofunkcionisemo'>Kako funkcionišemo</a>
</li>
<li class='f-font-condensed f-bg-hover-xlight f-p-xsmall f-m-r-xsmall f-br-small'>
<a href='{{URL::to('/')}}/ideje'>Ideje za prikupljanje novca</a>
</li>
<li class='f-font-condensed f-bg-hover-xlight f-p-xsmall f-m-r-xsmall f-br-small'>
<a href='{{URL::to('/')}}/blog'>Blog</a>
</li>
<li class='f-font-condensed f-bg-hover-xlight f-p-xsmall f-m-r-xsmall f-br-small'>
<a href='{{URL::to('/')}}/pretraga'>Pretraga</a>
</li>

<li class='f-font-condensed f-bg-hover-xlight f-p-xsmall f-m-r-xsmall f-br-small'>
<a href='{{URL::to('/')}}/o-nama'>O Nama</a>
</li>

</ul>





<div class='right' style="margin-right:0px;">
<div class='f-fr'>
<div class='js-user-dropdown f-bg-white f-br-small f-b-light f-clickable f-pos-rel f-hover-show f-tl' style='min-width:135px' >
<div class='js-avatar f-ilb f-br-xsmall f-br-none-tr f-br-none-br f-bg-contain' style='height:30px; width:30px; background-image: url({{Auth::user()->slika}}?width=60&amp;height=60)'></div>
<div class='f-ilb f-font-condensed f-caps f-fs-small f-fw-bold f-p-l-xsmall'  id="zeleni">
{{Auth::user()->fullname}}
</div>
<div class='f-ilb f-p-l-xsmall f-p-r-xsmall' style='line-height:30px'>
<i class='fa fa-chevron-down f-fs-medium'></i>
</div>
<div class='f-hover-show f-pos-abs f-z-top f-bg-white f-b-light f-font-condensed f-fs-small f-width-100'>
<ul class='f-list f-fc-black f-b-white'>  @if (Session::has('brojneprocitanih'))
 @if(Session::get('brojneprocitanih') > 0)
 <script>
 $("#zeleni").css("color","green");
$('#zeleni').text('NOVE PORUKE!({{Session::get("brojneprocitanih")}})');
</script>
@endif

<li style='display:block'>
<a href='{{URL::to('/')}}/users/poruke/{{Auth::user()->id}}'><i class='f-fc-medium fa fa-envelope fa-fw f-m-r-xsmall'></i><span>Poruke (<span id='brojnepro'>{{Session::get('brojneprocitanih')}}</span>)</span>
</a>
</li>    @endif
<li style='display:block'>
<a href='{{URL::to('/')}}/users/podesavanja'><i class='fa fa-fw fa-cog f-m-r-xsmall'></i><span>Podešavanja</span>
</a>
</li>
<li style='display:block'>
<a href='{{URL::to('/')}}/users/{{Auth::user()->id}}'><i class='fa fa-fw fa-user f-m-r-xsmall'></i><span>Moj Profil</span>
</a>
</li>
<li style='display:block'>
</li>
<div class='f-hr'></div>
<li style='display:block'>
<a href='{{URL::to('/')}}/auth/logout'><i class='fa fa-fw fa-sign-out f-m-r-xsmall'></i><span>Odjavljivanje</span>
</a>
</li>
</ul>
</div>
</div>

</div>
</div>


@endif

</div>
</div>
</div>
</div>

</div>

</div>