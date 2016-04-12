@extends('layout')

@section('content')

@include('header_pages')


<div class="js-search f-bg-xlight-o-medium f-tc f-font-condensed f-p-large">
<div class="f-ilb f-m-t-medium"   style="margin-top:70px;">
<div class="f-input-decorator f-pos-rel f-z-bottom" style="width:280px">
<input class="f-fw-bold f-fs-large" name="search" type="text">
<i class="js-clear-search fa fa-times fa-lg f-fc-medium f-fc-hover-black f-pos-abs f-clickable" style="right:60px;top:18px"></i>
<div class="f-decorator f-clickable large">
<i class="fa fa-search fa-lg"></i>
</div>
</div>
</div>
</div>

 <div class="f-bg-white" >
<div class="f-page-container responsive f-tc">
<div class="f-fc-dark f-fs-xlarge f-m-t-large" style="height: 220px;">
Pretraga kampanja ili ljudi po imenu.
</div>
</div>
<div class="f-page-container responsive f-tc f-p-large">
<div class="f-content-spacing-xsmall f-fs-large" data-last="25">
<div class="f-ilb f-bg-hover-xlight">
<a class="f-p-xsmall f-lh-xlarge f-fc-medium f-fw-bold f-fc-hover-black" href="/search" rel="prev">
<i class="fa fa-angle-double-left"></i>
</a>
</div>
<div class="f-ilb f-bg-hover-xlight">
<a class="f-p-xsmall f-lh-xlarge f-fc-medium f-fw-bold f-fc-hover-black" href="/search" rel="prev">
<i class="fa fa-angle-left"></i>
</a>
</div>
<div class="f-ilb f-bg-hover-xlight">
<a class="f-fc-hover-black f-fc-primary f-fw-bold f-lh-xlarge f-p-xsmall" href="/search?page=2">2</a>
</div>
<div class="f-ilb f-bg-hover-xlight">
<a class="f-fc-hover-black f-fc-medium f-fw-bold f-lh-xlarge f-p-xsmall" href="/search?page=3">3</a>
</div>
<div class="f-ilb f-bg-hover-xlight">
<a class="f-fc-hover-black f-fc-medium f-fw-bold f-lh-xlarge f-p-xsmall" href="/search?page=4">4</a>
</div>
<div class="f-ilb f-bg-hover-xlight">
<a class="f-fc-hover-black f-fc-medium f-fw-bold f-lh-xlarge f-p-xsmall" href="/search?page=5">5</a>
</div>
<div class="f-ilb f-bg-hover-xlight">
<a class="f-fc-hover-black f-fc-medium f-fw-bold f-lh-xlarge f-p-xsmall" href="/search?page=6">6</a>
</div>
<div class="f-ilb f-bg-hover-xlight">
<a class="f-fc-hover-black f-fc-medium f-fw-bold f-lh-xlarge f-p-xsmall" href="/search?page=7">7</a>
</div>
<div class="f-ilb f-bg-hover-xlight">
<a class="f-p-xsmall f-lh-xlarge f-fc-medium f-fw-bold f-fc-hover-black" href="/search?page=3">
<i class="fa fa-angle-right"></i>
</a>
</div>
<div class="f-ilb f-bg-hover-xlight">
<a class="f-p-xsmall f-lh-xlarge f-fc-medium f-fw-bold f-fc-hover-black" href="/search?page=25" rel="next">
<i class="fa fa-angle-double-right"></i>
</a>
</div>
</div>

</div>
</div>

@endsection
