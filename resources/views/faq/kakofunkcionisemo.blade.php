@extends('layout')

@section('content')

@include('header_pages')

<div class='f-width-100' style='height: 63px'></div>
<div class="f-b-light f-b-b f-p-y-xlarge f-tc">
<div class="f-page-container responsive f-p-x-large">
<h1 class="f-ilb f-b-xlight f-b-b f-fc-black f-p-b-xsmall">Kako <i>Pare Nisu Problem</i> funkcioniše</h1>
<div class="f-m-t-small f-p-x-large">
<p class="f-fw-thin f-font-condensed f-fc-dark f-fs-large">Portal je jednostavan, besplatan i lak za korišćenje</p>
</div>
</div>
</div>

@include('faq.sidebar')
<div class="js-seo-content f-content-section f-m-b-xlarge"><p>
          </p><p>
          </p><p>
          </p><h2>Funkcionišemo jednostavno i prilagođeno korisnicima</h2><p></p><p>Uvjerili ste se da je korišćenje našeg websajta veoma lako. Cilj nam je da omogućimo lak i jednostavan dolazak do humanih ljudi koji će pomoći i donirati sredstva u skladu sa svojim mogućnostima. Sajt je absolutno besplatan i nijedna od usluga se ne naplaćuje. Ukratko: zainteresovani korisnik kreira kampanju, opisuje svoj problem, razloge prikupljanje sredstava, postavlja cilj, i djeli te informacije sa posjetiocima putem vlastite stranice koju može ažurirati u svakom trenutku. Na taj način u stalnoj je komunikaciji sa posjetiocima, donatorima, uz pomoć komentara i privatnih poruka. </br></br>Posjetioci su u mogućnosti da u svakom trenutku pogledaju podatke i načine na koje mogu donirati novac, kao što su bankovni računi, instrukcije za plaćanje i slično. Kreator kampanje vodi evidenciju o uplaćenim sredstvima.</p>
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