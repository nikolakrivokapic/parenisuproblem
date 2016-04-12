@extends('layout')

@section('content')

@include('header_pages')

<div class='f-width-100' style='height: 63px'></div>
<div class="f-b-light f-b-b f-p-y-xlarge f-tc">
<div class="f-page-container responsive f-p-x-large">
<h1 class="f-ilb f-b-xlight f-b-b f-fc-black f-p-b-xsmall">Kako sajt funkcioniše?</h1>
<div class="f-m-t-small f-p-x-large">
<p class="f-fw-thin f-font-condensed f-fc-dark f-fs-large">Naša platforma je jednostavna za korišćenje, sigurna i predviđena prije svega da pomogne ljudima u potrebi.</p>
</div>
</div>
</div>

@include('pages.sidebar')
<div class="js-seo-content f-content-section f-m-b-xlarge"><p>
          </p><p>
          </p><p>
          </p><h2>Ispričajte vašu priču i povežite se sa donatorima</h2><p><b><img data-src="{{URL::to('/')}}/assets/demo1.jpg" data-scrollspy="150" data-width="parent" src="{{URL::to('/')}}/assets/demo1.jpg?w=671" style="width: 671px;"><br></b></p><p><b>Fotografije, video, djeljenje informacija</b></p><p>Obezbjedili smo mogućnost foto galerije, postavljanja i ažuriranja stranice, novosti i još mnogo toga.</p><p><b>Stranica je poput Bloga</b></p><p>Stranica vaše kampanje izgleda poput Bloga na kojem će te predstaviti vašu situaciju, upoznati posjetioce sa problemom, obavještavati ih o novostima, ažurirati sadržaj i komunicirati sa njima putem komentara i privatnih poruka. Takođe na njoj će se donatori upoznati sa načinima uplate sredstava i te informacije će im biti na dohvat ruke.</p><h2><br></h2><h2>Upravljajte vašom kampanjom putem bilo kojeg uređaja</h2><p><b>Mobilna aplikacija</b></p><p>Putem Android aplikacije bićete u mogućnosti da upravljate vašom kampanjom putem mobilnog uređaja, da ostanete u kontatku sa donatorima, podržavaocima i ažurirate informacije.</p><p><b>Pomoći ćemo vam u marketingu</b></p><p>Tu smo za vas da pomognemo u marketingu, putem našeg Facebook Page-a kao i isticanjem prioritenih kampanja vezanih za liječenje životno ugroženih u rubrici Hitno.</p><p><b>Redovno informisanje</b></p><p>Nakon što objavite kampanju, bićete redovno obavještavani putem emaila o svim događajima na stranici, novim podržavaocima, komentarima i slično. Na stranici će biti izlistani svi podržavaoci koje će svako moći vidjeti. A donacije će te biti u prilici da unosite sami putem djela sajta za podešavanje, gdje će te voditi javnu evidenciju o prikupljenim sredstvima. Tako će posjetioci znati koliko još sredstava hvali da bi se dostigao postavljeni cilj.</p></p>
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