@extends('layout')

@section('content')

@include('header_pages')

<div class='f-width-100' style='height: 63px'></div>
<div class="f-b-light f-b-b f-p-y-xlarge f-tc">
<div class="f-page-container responsive f-p-x-large">
<h1 class="f-ilb f-b-xlight f-b-b f-fc-black f-p-b-xsmall">Kako da sakupite što više sredstava</h1>
<div class="f-m-t-small f-p-x-large">
<p class="f-fw-thin f-font-condensed f-fc-dark f-fs-large">Smjernice</p>
</div>
</div>
</div>

@include('faq.sidebar')
<div class="js-seo-content f-content-section f-m-b-xlarge"><p>
          </p><p>
          </p><p>
          </p><h2>Neke smjernice o uspješnom sakupljanju sredstava</h2><p></p><p>Kao što znamo, sakupljanje sredstava nije lako. Marketing igra veliku ulogu u tom poduhvatu. Zato smo tu da vam pomognemo, i ne samo nudeći vam mjesto na našem web sajtu, već i savjetima
          i marketing metodama kojim pozicioniramo vašu stranicu na internetu. Ovdje ćemo vam ponuditi nekoliko savjeta koje možete pratiti kako bi vaša kampanja bila što uspješnija.</p>  </br>
          <p id="prica" style="top:-300px;"><b>Ispričajte vašu priču</b></p><p>  Iznesite razlog kreiranja kampanje. Budite konkretni i detaljni. Svi znamo da nije lako tražiti novac od ljudi ali u najvećem broju slučajeva postoji
          jak razlog za to. Zato, nemojte se bojati da budete iskreni i konkretni jer je to ono što krasni uspješne kampanje. Ako se radi o zdravstvenim problemima, možete ispričati
          kako je došlo do razboljevanja i redovno ažurirati sadržaj obavještavajući posjetioce o napretku kampanje i pojedinca o kom se radi. Za bilo kakvu asistenciju tu smo da pomognemo.
        </p><p>

         <p><b>Angažujte familiju i prijatelje</b></p><p>  Oni su tu da vam pomognu u startu vaše kampanje, na način što će djeliti linkove, slati emailove, kontaktirati moguće donatore i slično.
         Oslonite se na njih na samom početku.
        </p><p>

         <p id="mreze"><b>Socijalne mreže</b></p><p>
         Facebook je danas nezaobilazno sredstvo za marketing u svakoj sferi pa i ovoj. Naš sajt je prilagođen socijalnim mrežama i veoma je lako povezati se na sajt preko Facebook-a, djeliti materijal
         i sve ostalo što ide uz to. Djelite sadržaj, i nezaboravite da postavljate slike jer jedna slika vrijedi hiljadu riječi. Redovno se zahvaljujte podržavaocima i donatorima!
        </p><p>
              <p><b>Tretirajte donatore kao familiju</b></p><p>
        Pokušajte da ostvarite blizak odnos sa javnošću i donatorima. Podjelite sa njima što više i dobrih i loših vijesti. Redovno ih informišite, šaljite emailove i podsjetite na pomoć
        koja vam se potrebna.
        </p><p>

                <p><b>Pokušajte da dođete do medija</b></p><p>
     Naša stranica prilagođena je za lako djelenje. Savjetujemo vam da pokušate da dođete do što više medija i pošaljete im link ka vašoj stranici kako bi se upoznali sa situacijom
     i eventualno prenijeli vijesti o kampanji. Naravno, možete i direktno kontaktirati novinare i redakcije pitajući ih za pomoć u prezentovanju vaše kampanje.
        </p><p>

          <p><b>Postavljanje cilja</b></p><p>
Uvijek postavite finansijski cilj, i neka on bude dostižan, realan, i neka to bude cifra koja je minimalno neophodna. Naša platforma će vam pomoći u vođenju evidencije o tome,
ali na vama je da unosite i upravljate podacima koji će biti dostupni posjetiocima i javnosti. Možete postaviti i krajnji datum do kojega je neophodno prikupiti sredstva.
        </p><p>

              <p><b>Uvijek odgovarajte na privatne poruke</b></p><p>
Naš sajt nudi mogućnost interne komunikacije između korisnika. Ako budete kontaktirani, blagovremeno odgovorite svim posjetiocima, zahvalite se na podršci i slično.
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