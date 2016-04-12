@extends('layout')

@section('content')

@include('header_pages')

<div class='f-width-100' style='height: 63px'></div>
<div class="f-b-light f-b-b f-p-y-xlarge f-tc">
<div class="f-page-container responsive f-p-x-large">
<h1 class="f-ilb f-b-xlight f-b-b f-fc-black f-p-b-xsmall">Kako vam možemo pomoći?</h1>
<div class="f-m-t-small f-p-x-large">
<p class="f-fw-thin f-font-condensed f-fc-dark f-fs-large">Pored samog portala, dostupni smo i za sve vrste savjeta</p>
</div>
</div>
</div>

@include('faq.sidebar')
<div class="js-seo-content f-content-section f-m-b-xlarge"><p>
          </p><p>
          </p><p>
          </p><h2>Asistiramo vam od prvog koraka kreiranja kampanje </h2><p></p><p>Kreiranjem kampanje ona automatski biva prikazana na naslovnoj strani našeg websajta. Samim tim dostupna je svim posjetiocima a ukoliko se ona nalazi u oblasti liječenja i urgentnog je karaktera, označićemo je kao takvu, i vaša kampanja će biti istaknuta kao posebna. Osim toga, uporedo sa vašim ažuiranjem stranice, pobrinućemo se da za vašu kampanju čuju posjetioci naše fejsbuk stranice a reklamiraćemo je i putem ostalih vidova internet marketinga.</p><p>Tu smo i za sve ostale vidove savjeta i pomoći, a kontaktirajte nas na email info@parenisuproblem.me</p>
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