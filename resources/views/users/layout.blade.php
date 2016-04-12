<html lang='en' xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://ogp.me/ns/fb#">
@include('head')
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="{{URL::to('/')}}/js/jqueryuploadPreview.js"></script>
<script type="text/javascript" src="{{URL::to('/')}}/js/bootstrap-wysiwyg.js"></script>
  	<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/index.css">
	<link id="colorPickerMod" rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/mod.css">
	<script type="text/javascript" src="{{URL::to('/')}}/js/jqColorPicker.min.js"></script>
  	<script type="text/javascript" src="{{URL::to('/')}}/js/index.js"></script>
    <link href="{{URL::to('/')}}/css/js-image-slider.css" rel="stylesheet" type="text/css" />
    <script src="{{URL::to('/')}}/js/js-image-slider.js" type="text/javascript"></script>




    

@if(isset($kampanja))
<body style="background-color:{{$kampanja->boja}}" >
@else   <body>     @endif



<div class='f-pos-fix f-width-100 f-z-appribbon'>
<div class='js-appribbon f-pos-rel' data-mode='homepage'>
<div class='f-b-primary f-b-b three'>
<div class='f-app-ribbon'>
<div class='f-page-container responsive'>
<div class='brand'>
<div class='js-brand' data-height='20'>
<a class='f-ilb' data-fallback='/assets/logo.png' href='{{URL::to('/')}}'>
<style>
  .knockout svg #background-circle { fill: transparent }
  .knockout svg #knockout-heart path { fill: #f2f2f4 }
  .knockout svg #fund-text path { fill: #f2f2f4 }
</style>

<img src="{{ URL::to('/') }}/assets/logo.png" alt="">
</a>
</div>

</div>
@include('users.middle')
<div class='right'>
<div class='f-fr'>
<div class='js-user-dropdown f-bg-white f-br-small f-b-light f-clickable f-pos-rel f-hover-show f-tl' style='min-width:135px' >
<div class='js-avatar f-ilb f-br-xsmall f-br-none-tr f-br-none-br f-bg-contain' style='height:30px; width:30px; background-image: url({{$user->slika}}?width=60&amp;height=60)'></div>
<div class='f-ilb f-font-condensed f-caps f-fs-small f-fw-bold f-p-l-xsmall'  id="zeleni">
{{$user->fullname}}
</div>
<div class='f-ilb f-p-l-xsmall f-p-r-xsmall' style='line-height:30px'>
<i class='fa fa-chevron-down f-fs-medium'></i>
</div>
<div class='f-hover-show f-pos-abs f-z-top f-bg-white f-b-light f-font-condensed f-fs-small f-width-100'>
<ul class='f-list f-fc-black f-b-white'>  @if(isset($brojneprocitanih))
 @if($brojneprocitanih > 0)
 <script>
 $("#zeleni").css("color","green");
$('#zeleni').text('NOVE PORUKE!({{$brojneprocitanih}})');
</script>
@endif

<li style='display:block'>
<a href='{{URL::to('/')}}/users/poruke/{{$user->id}}'><i class='f-fc-medium fa fa-envelope fa-fw f-m-r-xsmall'></i><span>Poruke (<span id='brojnepro'>{{$brojneprocitanih}}</span>)</span>
</a>
</li>    @endif
<li style='display:block'>
<a href='{{URL::to('/')}}/users/podesavanja'><i class='fa fa-fw fa-cog f-m-r-xsmall'></i><span>Podešavanja</span>
</a>
</li>
<li style='display:block'>
<a href='{{URL::to('/')}}/users/{{$user->id}}'><i class='fa fa-fw fa-user f-m-r-xsmall'></i><span>Moj Profil</span>
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
</div>
</div>
</div>

</div>

</div>


<div class='f-width-100' style='height: 63px'></div>

<!-- TODO: This probably shouldn't be here and instead should live in a controller... -->
<style>
  .js-page .hint--top:after {
    width: 200px;
    white-space: normal;
    text-align: left;
  }
</style>
@yield('bar')
@yield('create-container')

@yield('srednji-container')
@yield('profile-container')



@yield('edit-page')
@yield('kampanja-podesavanja')

 @include('footer')