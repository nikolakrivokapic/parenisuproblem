@extends('layout_kampanje')

@section('content')
<div class='f-page-container f-pos-rel f-of-hidden' id='campaign-bar'>
<div class='js-content f-grid-row f-bg-white f-b-light f-b-nt f-p-small f-flex-center-y f-pos-abs f-width-100 f-height-100' style='top: -66px; height: 66px'>
<div class='f-grid-8of12'>
<h3 class='f-fc-black'>
{{$project->naslov}}
</h3>
</div>
<div class='f-grid-4of12 f-tr'>
<a class='f-button f-m-r-xsmall f-tc f-text-truncate js-cta-donate primary' data-mp-action='Donate' data-mp-position='Campaign Bar' href='#donate/35' id='mp-cta-donate' rel='nofollow' style='max-width: 60%;'>
DONIRAJ
</a>
<a class='f-button facebook f-tc f-text-truncate' data-button-source='Campaign Bar' data-facebook-action='share' data-facebook-ft-src='fbshare'>Podjeli</a>
</div>
</div>
</div>

</div>
<div class='js-page-buffer f-width-100' style='height: 63px'></div>
@include('kampanje.kampanja-page')

@endsection

