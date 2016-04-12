<div class='middle'>
<div class='f-ilb f-font-condensed f-m-r-small f-caps f-fs-small'>MOJE KAMPANJE:</div>
<div class='f-ilb'>
<div class='js-campaign-dropdown f-hover-show f-pos-rel'>
<div class='f-ilb f-button f-fs-small f-fw-bold f-bg-white'>

<div class='f-ilb f-tl f-text-truncate' style='margin-top: -3px; width: 130px'>
Kampanje

</div>

<i class='fa fa-chevron-down f-m-l-xsmall'></i>
</div>

<div class='f-hover-show f-pos-abs f-bg-white f-width-100 f-font-condensed f-z-top f-b-medium f-br-xsmall' style='width:150%'>
<h5 class='f-p-l-xsmall f-lh-xlarge f-b-light f-b-b f-tl'>Izaberite</h5>
<div class='f-of-scroll' style='max-height: 250px'>
@foreach($kampanje as $kampanja)
<p class='f-tl f-font-condensed f-fs-small f-bg-hover-xlight f-p-l-small f-p-r-small'>
<a class='f-text-truncate f-db f-lh-xlarge' href='{{URL::to('/')}}/dash/{{$kampanja->slug}}'>

<span>{{$kampanja->naslov}}</span>

</a>
</p>
@endforeach
<p class='f-tl f-font-condensed f-fs-small f-bg-hover-light f-p-l-small f-p-r-small f-bg-xlight'>
<a class='f-db f-lh-xlarge' href='{{URL::to('/')}}/kampanje/nova'>Kreiraj Novu Kampanju</a>
</p>

</div>
</div>
</div>

</div>
<div class='f-m-l-small f-ilb'>

</div>
</div>