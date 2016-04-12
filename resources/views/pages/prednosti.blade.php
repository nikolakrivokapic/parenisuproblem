@extends('layout')

@section('content')

@include('header_pages')

<div class='f-width-100' style='height: 63px'></div>
<div class="f-b-light f-b-b f-p-y-xlarge f-tc">
<div class="f-page-container responsive f-p-x-large">
<h1 class="f-ilb f-b-xlight f-b-b f-fc-black f-p-b-xsmall">Prednosti korišćenja našeg servisa</h1>
<div class="f-m-t-small f-p-x-large">
<p class="f-fw-thin f-font-condensed f-fc-dark f-fs-large">Ovaj servis zamišljen je kao savremeni način lakog stupanja u kontakt sa donatorima, i namjenjen je svima onima koji su u trenutnoj potrebi za finansijama. Zamišljen je kao asistencija i pomoć svima onima koji žele da se povežu sa donatorima ali i mjesto gdje će humani pojedinci i institucije saznati kome je preko potrebna pomoć.</p>
</div>
</div>
</div>

@include('pages.sidebar')
<div class="js-seo-content f-content-section f-m-b-xlarge"><p>
          </p><p>
          </p><p>
          </p><h2>Vaši prijetelji, kolege, sugrađani i humani ljudi širom svijeta mogu obezbjediti finansijska sredstva za ono što vama predstavlja hitnu potrebu</h2><p><b>Veliki broj donatora saznaje za kampanje putem socijalnih mreža</b></p><p>Povezani smo sa socijalnim mrežama, prije svega Facebook-om i na taj način omogućavamo lakši prenos informacija putem šerovanja, postovanja, a ugrađena je i mogućnost integrisane prijave na sajt putem Facebook naloga. U današnjem vremenu platforme kao što je Facebook mogu da igraju odlučujuću ulogu kada je u pitanju pomoć ugroženima.</p><p><b>Vaši prijatelji mogu vam pomoći</b></p><p>Cilj ovog websajta je da vašim poznanicima i prijateljima omogući da učestvuju u prikupljanju sredstava tako što će na jednostavan način šerovati stranicu vaše kampanje, slati linkove, i biti u toku sa svim novostima na zvaničnoj stranici vaše kampanje koju će te sami održatavati ili neko koga vi ovlastite.</p><h2><br></h2><h2>Vaša priča biće dočarana i dostupna svima i svugdje na internetu</h2><p><img data-src="{{URL::to('/')}}/assets/demo.jpg" data-scrollspy="150" data-width="parent" src="https://images.fundly.com/uploads/7408c667-c412-43bb-bc1a-6d79e905c465.jpg?w=671" style="width: 671px;"></p><p><b>Uređujte vašu kampanju/stranicu</b></p><p>Na stranici vaše kampanje bićete u mogućnosti da postavljate slike, poslednje novosti, da obavještavate zainteresovane i javnost o trenutnoj situaciji, sakupljenim sredstvima, napretku koji se odvija vezan za vašu kampanju, da primate komentare, budete kontaktirani i mnogo toga drugog.</p><p><b>Prilagođeni smo za sve uređaje</b></p><p>Vaša stranica izgledaće jednako dobro na svim uređajima, uključujući mobilne, tablete, desktop računare, a tu je i naša Android aplikacija za mobilne uređaje sa ovim sistemom.</p><p>
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