@extends('layout')

@section('content')


  <style>
  html, body { height: 100%;  overflow:hidden;  }

</style>
@include('header_pages
')
<div class='f-width-100' style='height: 63px'></div>

<style>
  .js-page .hint--top:after {
    width: 200px;
    white-space: normal;
    text-align: left;
  }
</style>
<div class='f-pos-rel f-of-hidden' style='height: 100%'>
<div class='f-fullbleed f-bg-center' style='background-image: url(http://localhost:8000/donacije/public/assets/back.jpg); background-repeat: no-repeat; background-position: center; background-size: cover'></div>

<div class='f-bg-black-o-xlight f-fullbleed'></div>
<div class='js-campaign-creation f-fullbleed f-tc f-fc-white' style='min-width: 960px'>
<div class='js-track f-height-100 f-of-hidden'>
<div class='js-train'>
<div class='js-page f-flex-center f-p-y-xlarge' data-step='join' style='height:450px'>
@include('main.naslovno')

</div>

  </div>   </div>   </div>   </div>

@endsection