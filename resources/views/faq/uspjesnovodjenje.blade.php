@extends('layout')

@section('content')

@include('header_pages')

<div class='f-width-100' style='height: 63px'></div>
<div class="f-b-light f-b-b f-p-y-xlarge f-tc">
<div class="f-page-container responsive f-p-x-large">
<h1 class="f-ilb f-b-xlight f-b-b f-fc-black f-p-b-xsmall">Kako uspješno voditi kampanju</h1>
<div class="f-m-t-small f-p-x-large">
<p class="f-fw-thin f-font-condensed f-fc-dark f-fs-large">Bitno je da vršite redovna ažuriranja</p>
</div>
</div>
</div>

@include('faq.sidebar')
<div class="js-seo-content f-content-section f-m-b-xlarge"><p>
          </p><p>
          </p><p>
          </p><h2>Platforma omogućava redovna ažuriranja</h2><p>Napravili smo sistem za lako korišćenje i mogućnost redovnog ažuriranja putem unutrašnjeg djela sajta za uređivanje stranice. Savjetujemo da
          što češće obavještavate javnost i posjetioce o napretku vezanom za situaciju o kojoj se radi. Pored informacija postavite i sliku koja će pratiti samu vijest. </br> Što više posjetioci
          saznaju o vašoj situaciji, veća je mogućnost da će podržati kampanju i donirati novac. Posjetioci imaju mogućnost da vide istoriju ažuriranja u svakom momentu kao i da komentarišu na svakom od njih.</p>
         <h2> <b>Pišite o napretku</b></h2><p>Obavjestite ljude o tome kako napreduje situacija, i šta mogu da očekuju u doglednoj budućnosti.        </p>
                 <h2>  <b>Gdje ide novac?</b></h2><p> Pišite o tome gdje se ulaže novac, koliko je još neophodno i iznesite ostale detalje o tome.     </p>
                       <h2>  <b>Slike</b></h2><p>Ubacujte slike pri svakom ažuriranju, one mnogo znače posjetiocima. </p>
        </p><p>
        </p><p>
        </p></div>
</div>
</div>
</div>
</div>

 <div class='f-width-100 f-p-y-xlarge f-fc-black f-bg-swatchtwo-o-light f-b-light f-b-b f-tc'>
<h2 class='f-fc-black f-p-t-large'>Pokrenite vašu kampanju</h2>
<p class='f-fw-light f-font-condensed f-fs-xlarge f-fc-dark'>Lako podesite vašu stranicu i počnite sakupljati sredstva.</p>
<p class='f-fw-light f-font-condensed f-fs-xlarge f-fc-xdark f-m-t-small f-fw-bold'>Našu platformu već ima veliki broj članova.</p>
<a alt='Start Free Campaign' class='f-button primary f-fw-bold f-fs-large f-m-t-medium f-m-b-xlarge' href='{{ URL::to('/') }}/kampanje/nova'>
Pokreni Besplatnu Kampanju
</a>
</div>
@endsection