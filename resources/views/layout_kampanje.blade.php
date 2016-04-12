
<!DOCTYPE html>
<html lang='en'>
<head>
<script type="text/javascript">var NREUMQ=NREUMQ||[];NREUMQ.push(["mark","firstbyte",new Date().getTime()]);</script>
<title>{{$project->naslov}} | Pare nisu problem</title>
<meta charset='utf-8'>
<meta content='width=1000' name='viewport'>
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript"
	src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

<meta content="{{$project->text}}" name='description'>
<script src="{{URL::to('/')}}/js/js.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- Facebook OpenGraph metadata -->
<meta content='Pare Nisu Problem' property='og:site_name'>
<meta content='parenisuproblem:kampanje' property='og:type'>
<meta content="Klikni na podržiš {{$project->naslov}}"
	property='og:title'>
<meta content='https://parenisuproblem.com/{{$project->slug}}'
	property='og:url'>
<meta content='{{str_replace(" ","%20",$project->slika)}}'
	property='og:image'>

<meta content="{{$project->text}}..." property='og:description'>

<meta content='148669528535835' property='fb:app_id'>
<!-- End Facebook OpenGraph metadata -->



<link rel="apple-touch-icon" sizes="57x57"
	href="{{ URL::to('/') }}/assets/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60"
	href="{{ URL::to('/') }}/assets/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72"
	href="{{ URL::to('/') }}/assets/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76"
	href="{{ URL::to('/') }}/assets/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114"
	href="{{ URL::to('/') }}/assets/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120"
	href="{{ URL::to('/') }}/assets/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144"
	href="{{ URL::to('/') }}/assets/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152"
	href="{{ URL::to('/') }}/assets/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180"
	href="{{ URL::to('/') }}/assets/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"
	href="{{ URL::to('/') }}/assets/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32"
	href="{{ URL::to('/') }}/assets/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96"
	href="{{ URL::to('/') }}/assets/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16"
	href="{{ URL::to('/') }}/assets/favicon-16x16.png">
<link rel="manifest" href="{{ URL::to('/') }}/assets/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

<link
	href="//fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic|Roboto+Condensed:300,300italic,400,400italic,700,700italic"
	media="screen" rel="stylesheet" type="text/css" />

<link href="{{URL::to('/')}}/css/js-image-slider.css" rel="stylesheet"
	type="text/css" />





<link href="{{URL::to('/')}}/css/style-53a92.css" media="screen"
	rel="stylesheet" type="text/css" />
<link href="{{ URL::to('/') }}/css/Site.css" rel="stylesheet">
<style id='theme-styles'>
.f-fc-primary, .f-fc-hover-primary:hover {
	color: #ff8b5d;
}

.f-bg-primary, .f-bg-hover-primary {
	color: #fff;
}

.f-b-primary, .f-hr-primary {
	border-color: #ff8b5d;
}

.f-button.primary {
	background-color: #ff8b5d;
	color: #fff;
}

.f-app-ribbon {
	background-color: #ffffff;
	color: #000;
}
</style>

<!--[if lte IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" type="text/javascript"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js" type="text/javascript"></script>
<![endif]-->
@if(Auth::check())
<script src="//js.pusher.com/2.2/pusher.min.js"></script>
<script>
    var pusher = new Pusher("{{env("PUSHER_KEY")}}");


( function( $, pusher ) {

var itemActionChannel = pusher.subscribe( 'itemAction' );

itemActionChannel.bind( "App\\Events\\ItemCreated", function( data ) {




if(data["comment"].receiver== "{{Auth::user()->id}}"){



$("#zeleni").css("color","green");
$('#zeleni').text('NOVA PORUKA!');
$('#brojnepro').text( parseInt("{{$brojneprocitanih}}",10) + 1);
}



} );


} )( jQuery, pusher);

</script>

@endif

</head>

  <?php
$bojica = invert_colour($project->boja);

function invert_colour($start_colour)
{
    $colour_red = hexdec(substr($start_colour, 1, 2));
    $colour_green = hexdec(substr($start_colour, 3, 2));
    $colour_blue = hexdec(substr($start_colour, 5, 2));
    
    $new_red = dechex(255 - $colour_red);
    $new_green = dechex(255 - $colour_green);
    $new_blue = dechex(255 - $colour_blue);
    
    if (strlen($new_red) == 1) {
        $new_red .= '0';
    }
    if (strlen($new_green) == 1) {
        $new_green .= '0';
    }
    if (strlen($new_blue) == 1) {
        $new_blue .= '0';
    }
    
    $new_colour = '#' . $new_red . $new_green . $new_blue;
    
    return $new_colour;
}
?>

<body style="padding-bottom: 0px;">








	<!--<style>


 /* If the viewport width <= 480 pixels ... */

@media screen and (max-width: 1200px) {

  body {
    margin: 0;
  }

  #header .inner {
    padding-top: 5px;
    padding-bottom: 5px;
  }

  #header .inner, #content, #nav, #sidebar {
    margin-bottom: 5px;
  }

  #nav ul {
    padding: 5px 7px;
  }

  #leftsidebar {
    display: none;
  }

    #rightsidebar {
    display: none;
  }
}


</style>




 <div id="leftsidebar" style="position:absolute;       z-index: 1;
    top:0; bottom:0; left:0;
    width:17%;
    background:{{$project->boja}};text-align:center;padding-top:120px;color:{{$bojica}};"><div class='f-grid-row' style="width:100%;"> <div class='f-grid-11of12'>











    </div></div>   </div>

 <div id="rightsidebar" style="position:absolute; -moz-user-select: text;   z-index: 1;
    top:0; bottom:0; right:0;
    width:17%;
    background:{{$project->boja}};text-align:center;padding-top:120px;color:{{$bojica}};"><div class='f-grid-row' style="width:100%;">

<div class='f-grid-11of12'>    <i class='fa fa-heart f-fc-light'></i>
<h5>Uputstvo za uplatu:</h5>
<p style="-moz-user-select: text; " >{!! htmlspecialchars_decode( (nl2br($project->uputstvo)) ) !!}</p>
</div></div></div>

-->








	<div class='f-bg-xlight f-height-100'
		style="background-color: {{$project-&gt;boja">
















		<div class='f-fullbleed' style='position: fixed;'></div>
		<div class='f-pos-fix f-width-100 f-z-appribbon'>
			<div class='js-appribbon f-pos-rel' data-mode='activity'>
				<div class='f-b-primary f-b-b three'>
					<div class='f-app-ribbon f-pos-rel'>
						<div class='f-page-container'>
							<div class='brand'>
								<div class='js-brand' data-height='20'>
									<a class='f-ilb' data-fallback='/assets/logo.png'
										href='{{ URL::to('/') }}'>
										<style>
.knockout svg #background-circle {
	fill: transparent
}

.knockout svg #knockout-heart path {
	fill: #f2f2f4
}

.knockout svg #fund-text path {
	fill: #f2f2f4
}
</style> <img src="{{ URL::to('/') }}/assets/logo.png" alt="">
									</a>
								</div>

							</div>

							@if(Auth::check()) @include('users.middle') @endif
							<div class='right js-links'>
								<div class='f-p-r-xlarge f-ilb'>
									<a class='f-anchor' data-mp-action='Start Campaign Click'
										data-mp-position='App Ribbon' href='{{ URL::to('/') }}/kampanje/nova'>Pokrenite
										kampanju</a> <a class='f-p-l-large'
										data-mp-action='Search Click' data-mp-position='App Ribbon'
										href='{{URL::to('/')}}/pretraga'>Pretraga</a>
								</div>
								@if(!Auth::check()) <a
									class='f-button white f-m-r-small f-fw-bold f-fs-small'
									href='#' onclick="show('signin1')">Uloguj se</a> @endif

								@if(Auth::check())
								<div class='right'>
									<div class='f-fr'>
										<div
											class='js-user-dropdown f-bg-white f-br-small f-b-light f-clickable f-pos-rel f-hover-show f-tl'
											style='min-width: 135px'>
											<div
												class='js-avatar f-ilb f-br-xsmall f-br-none-tr f-br-none-br f-bg-contain'
												style='height: 30px; width: 30px; background-image: url({{ Auth :: user()-&gt;slika'></div>
											<div
												class='f-ilb f-font-condensed f-caps f-fs-small f-fw-bold f-p-l-xsmall'
												id="zeleni">{{Auth::user()->fullname}}</div>
											<div class='f-ilb f-p-l-xsmall f-p-r-xsmall'
												style='line-height: 30px'>
												<i class='fa fa-chevron-down f-fs-medium'></i>
											</div>
											<div
												class='f-hover-show f-pos-abs f-z-top f-bg-white f-b-light f-font-condensed f-fs-small f-width-100'>
												<ul class='f-list f-fc-black f-b-white'>
													@if(isset($brojneprocitanih)) @if($brojneprocitanih > 0)
													<script>
 $("#zeleni").css("color","green");
$('#zeleni').text('NOVE PORUKE!({{$brojneprocitanih}})');
</script>
													@endif

													<li style='display: block'><a href='{{URL::to('/')}}/users/poruke/{{Auth::user()->id}}'><i
															class='f-fc-medium fa fa-envelope fa-fw f-m-r-xsmall'></i><span>Poruke
																(<span id='brojnepro'>{{$brojneprocitanih}}</span>)
														</span>
													</a></li> @endif
													<li style='display: block'><a href='{{URL::to('/')}}/users/podesavanja'><i
															class='fa fa-fw fa-cog f-m-r-xsmall'></i><span>Podešavanja</span>
													</a></li>
													<li style='display: block'><a href='{{URL::to('/')}}/users/{{Auth::user()->id}}'><i
															class='fa fa-fw fa-user f-m-r-xsmall'></i><span>Moj
																Profil</span>
													</a></li>
													<li style='display: block'></li>
													<div class='f-hr'></div>
													<li style='display: block'><a href='{{URL::to('/')}}/auth/logout'><i
															class='fa fa-fw fa-sign-out f-m-r-xsmall'></i><span>Odjavljivanje</span>
													</a></li>
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



			<script>
 function show(target) {
    document.getElementById(target).style.display = 'block';
}

function hide(target) {
    document.getElementById(target).style.display = 'none';
}

</script>
			@include('users.signin1') @yield('content')









			<script src="{{URL::to('/')}}/js/js-image-slider.js"
				type="text/javascript"></script>

</body>

@include('footer')
</html>