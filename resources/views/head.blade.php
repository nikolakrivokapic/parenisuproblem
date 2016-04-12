<head>
<script type="text/javascript">var NREUMQ=NREUMQ||[];NREUMQ.push(["mark","firstbyte",new Date().getTime()]);</script>
<title>Pare Nisu Problem</title>
<meta charset='utf-8'>
<meta content='width=1000' name='viewport'>

<meta name="csrf-token" content="{{ csrf_token() }}" />

<meta
	content='Doniranje novca i prikupljanje sredstava za razne projekte, za lijecenje kao i druge vidove pomoci.'
	name='description'>

<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<script src="{{URL::to('/')}}/js/js.js"></script>


@if(isset($kampanja))
<meta content='Pare Nisu Problem' property='og:site_name'>
<meta content='parenisuproblem:kampanje' property='og:type'>
<meta content="Klikni na podržiš {{$kampanja->naslov}}"
	property='og:title'>
<meta content='https://parenisuproblem.com/{{$kampanja->slug}}'
	property='og:url'>
<meta content='{{str_replace(" ","%20",$kampanja->slika)}}'
	property='og:image'>

<meta content="{{$kampanja->text}}..." property='og:description'>
@else
<meta property="og:image" content="{{URL::to('/')}}/assets/200200.jpg" />
<meta property="og:title" content="Pare Nisu Problem" />
<meta content='{{URL::to(' /')}}' property='og:url'>
<meta property="og:description"
	content="Regionalni portal za pomoć u akcijama i kampanjama za doniranje novca za pojedince i organizacije." />
@endif


<!-- End Facebook OpenGraph metadata -->


@if(Auth::check() && isset($brojneprocitanih))
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

<link href="{{URL::to('/')}}/css/style-53a92.css" media="screen"
	rel="stylesheet" type="text/css" />

<link href="{{ URL::to('/') }}/css/Site.css" rel="stylesheet"
	type="text/css" />

<script>
 function show(target) {
    document.getElementById(target).style.display = 'block';
}

function hide(target) {
    document.getElementById(target).style.display = 'none';
}

    //  Bind the event handler to the "submit" JavaScript event



</script>


<style id='theme-styles'>
.f-fc-primary, .f-fc-hover-primary:hover {
	color: #ff8b5d;
}

.f-bg-primary, .f-bg-hover-primary {
	background-color: #ff8b5d;
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
</head>