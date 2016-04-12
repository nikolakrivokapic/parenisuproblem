@foreach( $projects as $project )

<div class='f-b-light one f-ilb f-m-r-xsmall f-m-l-xsmall f-m-b-medium'
	style='width: 220px; border-radius: 4px'>
	<div class='f-p-small'>
		<a class='f-bg-cover f-bg-no-repeat f-bg-center'
			data-background-image='{{str_replace(" ","%20",$project->slika)}}'
			data-scrollspy='150' href='{{ URL::to(' /') }}/{{$project->slug}}'
			style='background-image:url({{str_replace("
			","%20",$project->slika)}});height:192px;width:192px; display:
			block;'></a>
		<div class='f-thermometer f-m-t-small f-m-b-xsmall'
			style='height: 6px'>
			<div class='f-mercury f-bg-primary' @if($project->cilj == 0)
				style='width:0px' @else style='width:{{$percentage =
				($project->skupljeno / $project->cilj) * 100}}%' @endif></div>
		</div>
		<div class='f-tc'>
			<h2>€{{$project->skupljeno}}</h2>
		</div>
		<div class='f-tc f-m-b-xsmall'>
			<div
				style='height: 45px; word-wrap: break-word; font-size: 16px; overflow: hidden; text-overflow: ellipsis;'>
				<a class='f-db f-fc-xdark' href='{{ URL::to(' /') }}/{{$project->slug}}'>{{$project->naslov}}</a>
			</div>
		</div>
		<div class='f-grid-row f-m-b-xsmall'>
			<div class='f-grid-2of12 f-flex-center-y'>
				<i class='f-icon-location f-m-r-xsmall f-fs-large f-fc-light'
					style='margin-left: -2px'></i>
			</div>
			<div class='f-grid-10of12 f-flex-center-y'>
				<a class='f-fc-light f-fs-xsmall' href='{{URL::to('
					/')}}/lokacija/{{$project->lokacija}}' style='margin-left:
					-5px;color:#5c5d5e;'> {{$project->lokacija}} </a>
			</div>
		</div>
		<div class='f-grid-row'>
			<div class='f-grid-2of12 f-flex-center-y'>
				<i class='f-fc-light f-icon-health f-m-r-xsmall'></i>
			</div>
			<div class='f-grid-10of12 f-flex-center-y'>
				<a class='f-fc-light f-fs-xsmall' href='{{URL::to('
					/')}}/kategorija/{{$project->kategorija}}' style='margin-left:
					-5px;color:#5c5d5e;'> {{$project->kategorija}} </a>
			</div>
		</div>
	</div>
</div>




@endforeach
