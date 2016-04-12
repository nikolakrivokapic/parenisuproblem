@extends('users.layout' )

@section('bar')
@include('users.edit-bar')
@endsection





 @section('kampanja-podesavanja')

<div class='f-pos-rel'>
<div class='f-page-container' >
<div class='f-grid-row' >
<div class='f-grid-4of12 f-tl'>
<style>
  .hint--right:after{white-space:normal;width:225px}
</style>
<div class='f-grid-row f-m-t-small f-font-condensed f-m-t-xlarge f-p-t-large' id='email-side-nav' style="margin-top: 0px;">
<h2 class='f-normal-caps f-p-b-small f-p-t-medium f-p-b-large f-fc-black'>Sredstva</h2>
<div class='f-grid-row f-b-light f-b-nr f-b-nl'>
<div class='f-p-t-small'>
<a class='f-fc-black f-fs-large f-fw-bold f-fw-thin f-opacity-xdark' href='/kdfs-sdfdsf/funds'><div class='fa fa-fw fa-money f-fc-light f-m-r-small f-p-b-medium f-p-t-xsmall'></div>Donacije
</a>
</div>
<!--<div class='f-p-t-medium f-p-b-medium f-b-light f-b-t f-pos-rel'>
<a class='f-fc-black f-fs-large f-fw-thin f-opacity-xdark' href='/kdfs-sdfdsf/withdrawals'><div class='fa fa-fw fa-download f-fc-light f-m-r-small f-fw-thin'></div>Podizanje
</a>
</div>-->
</div>
<div class='f-m-t-large' id='funds-side-nav'>
<div class='f-grid-row' id='funds_gateway_info'></div>
<div class='f-grid-row' id='funds-basic-info'></div>
<!--<div class='f-grid-row f-p-t-xlarge f-fc-black'>
<h4 class='f-normal-caps f-p-b-xsmall'>Donor Data</h4>
<p class='f-p-b-xsmall f-fs-medium f-fw-normal f-font-condensed f-fc-dark'>Download a CSV with donor information.</p>
<a class='f-button white f-fs-small f-caps f-fc-black f-fw-bold js-download-data' data-type='contributions'>
Download Donor Data
</a>
</div>-->



<div id='dodajiznos' class="popup-instance f-style-guide overlay" style="display:none;position:fixed;z-index:9;" ><div class="f-fs-medium f-popup f-z-popup" >
  <div class="f-bg-black f-opacity-medium f-popup-overlay" style="height: 3581px;"></div>
  <div class="f-anim-fadeinup-fast f-bg-xlight f-br-medium f-fc-xdark f-popup-container f-pos-rel f-tl" style="width: 490px; position: absolute; margin-top: 0px; top: 150px; left: 600px; height: 235px;">
    <i class="f-align-tr f-clickable f-fc-hover-dark f-fc-medium f-fs-xlarge f-m-medium f-popup-close fa fa-times" style="z-index: 100;" onclick="hide('dodajiznos')"></i>
    <div class="f-p-medium f-tl">
  <h3 class="f-fc-black f-lh-small">Unesite iznos koji želite dodati u statistiku</h3>
</div>


<div class="f-grid-row f-p-large f-tl">

  <div class="f-grid-7of12 f-p-r-medium f-pos-rel">
   <textarea id="textbox" name="text" style="height: 40px; width:300px;resize: none" placeholder="Unesite cifru u evrima.."></textarea>

    <div class="f-input-decorator">



   <button class="f-button f-flex-align-left f-fw-bold js-submit primary" onclick="hide('doniraj')" style="margin-top:10px;">Dodaj iznos</button>

    </div>
  </div>

</div>
  </div>
</div></div>



<div id='dodajdonaciju' class="popup-instance f-style-guide overlay" style="display:none;position:fixed;z-index:9;" ><div class="f-fs-medium f-popup f-z-popup" >
  <div class="f-bg-black f-opacity-medium f-popup-overlay" style="height: 3581px;"></div>
  <div class="f-anim-fadeinup-fast f-bg-xlight f-br-medium f-fc-xdark f-popup-container f-pos-rel f-tl" style="width: 490px; position: absolute; margin-top: 0px; top: 150px; left: 600px; height: 235px;">
    <i class="f-align-tr f-clickable f-fc-hover-dark f-fc-medium f-fs-xlarge f-m-medium f-popup-close fa fa-times" style="z-index: 100;" onclick="hide('dodajdonaciju')"></i>
    <div class="f-p-medium f-tl"  style="margin-bottom:0px;">
  <h3 class="f-fc-black f-lh-small">Unesite individualnu donaciju</h3>
</div>


<div class="f-grid-row f-p-large f-tl" style="padding-top:0px;">

  <div class="f-grid-7of12 f-p-r-medium f-pos-rel">    Izaberite korisnika:
  <select>
  @foreach ($korisnici as $korisnik)
  <option value="{{$korisnik->fullname}}">{{$korisnik->fullname}}</option>
@endforeach
</select>


     <textarea id="textbox" name="text" style="height: 40px; width:300px;resize: none" placeholder="Unesite cifru u evrima.."></textarea>

    <div class="f-input-decorator">



   <button class="f-button f-flex-align-left f-fw-bold js-submit primary" onclick="hide('doniraj')" style="margin-top:10px;">Dodaj iznos</button>

    </div>
  </div>

</div>
  </div>
</div></div>



<div class='f-grid-row f-p-t-xlarge f-fc-black'>
<h4 class='f-normal-caps f-p-b-xsmall'>Dodaj donacije</h4>
<p class='f-p-b-xsmall f-fs-medium f-fc-medium f-fw-normal f-font-condensed f-fc-dark'>Dodajte donacije koje su izvršene van sajta(kešom, uplatama..), kako bi smo ih uvrstili u statistiku. <br><br>Kako budete dodavali sredstva, ona će automatski biti uvrštena u statistiku i posjetioci vaše stranice će moći u svakom trenutku da provjere koliko je još sredstava neophodno do postavljenog cilja.</p>
<a class='js-add-offline f-button white f-fs-small f-caps f-fc-black f-fw-bold'  onclick="show('dodajdonaciju')">
Dodaj donaciju
</a>

<a class='js-add-offline f-button white f-fs-small f-caps f-fc-black f-fw-bold' onclick="show('dodajiznos')">
Dodaj samo iznos
</a>
<p class='f-p-b-xsmall f-fs-medium f-fc-medium f-fw-normal f-font-condensed f-fc-dark' style="margin-top:10px;">
Imate opciju da dodate donaciju, odnosno konkretnog korisnika koji je donirao i koji će kao takav biti prikazan u rubrici "Donatori" na vašoj stranici. Radi fer poltiike, iznos donacija <b>neće biti javno prikazan</b>,
i svi donatori će biti jednako prikazani nezavisno od toga koliki su iznos donirali. <br><br>Druga opcija je jednostavan unos iznosa koji je pristigao izvan sajta i koji želite da uvrstite u statistiku, ne navodeći
ime donatora.
</p>
</div>

</div>

</div>


</div>
<div class='f-grid-8of12 f-tl f-bg-white' >
<style>
  #funds{min-height:1304px}
</style>
<div class='f-grid-row f-p-l-xlarge f-m-t-large f-height-100 f-m-t-xlarge f-p-t-large' id='funds'  >
<div class='f-grid-row' >
<h2 class='f-normal-caps f-p-t-medium f-p-b-large f-fc-black f-grid-6of12' style="margin-top: -40px;">Donacije</h2>
<div class='f-grid-4of12 f-grid-2of12-offset'>
<div class='f-grid-row f-p-t-large f-font-condensed'>

<div class='js-search-processing f-grid-2of12 f-hide f-fs-small f-fc-medium' style='padding: 5px 0 0 5px'>
<div class='f-ilb f-spinner-lifepreserver'></div>
</div>
</div>
</div>
</div>
<table class='f-fs-medium f-grid-12of12'>
<thead>
<tr class='f-b-xlight f-b-nl f-b-nr f-fw-bold f-fc-dark f-caps f-fs-small f-font-condensed'>
<th class='f-p-t-small f-p-b-small'>
Iznos
</th>
<th>
Tip
</th>
<th>
Datum
</th>
<th class='f-p-l-xsmall'>
Ime
</th>
<th>
Email
</th>
<th>
Status
</th>
</tr>
</thead>
<tbody class='js-donations f-font-condensed f-fs-medium'></tbody>
</table>
<div class='f-grid-12of12 f-tc f-fs-small f-p-t-medium f-p-b-xlarge'>

<div class='f-ilb js-loading f-hide'>
<div class='f-spinner-circles f-fs-small f-bg-light'></div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>




 @endsection

     @section('footer')
@include('footer')
@endsection