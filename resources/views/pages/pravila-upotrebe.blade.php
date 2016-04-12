@extends('layout')

@section('content')

@include('header_pages')

<div class='f-width-100' style='height: 63px'></div>
<div class="f-b-light f-b-b f-p-y-xlarge f-tc">
<div class="f-page-container responsive f-p-x-large">
<h1 class="f-ilb f-b-xlight f-b-b f-fc-black f-p-b-xsmall">Pravila</h1>
<div class="f-m-t-small f-p-x-large">
<p class="f-fw-thin f-font-condensed f-fc-dark f-fs-large">Osnovna pravila korišćenja našeg servisa</p>
</div>
</div>
</div>


<div class="js-seo-content f-content-section f-m-b-xlarge" style="width:600px; display:inline-block;margin-left:500px;
"><p>
          </p><p>
          </p><p>
          </p><h2>Dobrodošli na portal "Pare nisu problem"</h2><p>Ovaj servis je namjenjen svim zainteresovanim klijentima koji žele besplatno, brzo i lako oglasiti svoju potrebu za finansijskim sredstvima. Kao prvi takvog tipa u Crnoj Gori, portal ima za viziju pomoć ljudima u potrebi kao što su prvenstveno ljudi kojima je novac potreban za liječenje, ali isto tako i za finansiranje grupnih i individualnih projekata i planova iz raznih oblasti kao što su Kultura, Sport, Školovanje, Pomoć Siromašnima, i razne humane akcije.<br> Prije oglašavanja kampanje, pročitajte ova pravila kako bi bili sigurni da je vaša kampanja u skladu sa njima.</p>
        </p><p>
        </p>




        <p>




        Svaka informacija, stav ili mišljenje koje je iznio korisnik Portala ne odražava nužno stavove autora portala. Ne preduzimamo odgovornost za tačnost objavljenih informacija, ideja i mišljenja koje su napisali korisnici i nismo odgovorni za bilo kakva potraživanja, štete ili gubitke nastale zbog takve informacije, ideje ili mišljenja. Kada postavlja informaciju, materijal, sadržaj, ili na drugi način pristupa našim uslugama, korisnik se slaže da neće:
                                         <br><br>
Maltretirati, klevetati, zastrašivati ili ugroziti drugog korisnika;    <br>
Ometati prava na privatnost drugog korisnika;            <br>
Slati materijal koji je klevetnički (i.e., omalovažavajući po ugled pojedinca ili grupa);         <br>
Slati materijal koji je nepristojan, uvrjedljiv ili nepristojan;                                    <br>
Postavljati robne marke, logotipe, materijale zaštićene autorskim pravima ili drugim intelektualnim pravima bez odobrenja vlasnika;         <br>
Reklamirati ili promovisati, direktno ili indirektno sadržaje vezane za lutrije, kockanja, sadržaje za odrasle, pornografske sadržaje ili druge slične sadržaje i aktivnosti;     <br>
Slati materijal koji može oštetiti rad računara;                                                                                         <br>

Tražiti od ostalih korisnika da se pridruže trećim stranama ili web stranicama koje su konkurentne , bez našeg prethodnog odobrenja;     <br>
Neće koristiti naše logotipe i sadržaje zaštićene autorskim pravima;                                                                     <br>

Pokušavati skenirati ili testirati ranjivost sistema ili mreže ili kršiti sigurnosni sistem web sajta na bilo koji način (krađa šifara, dešifrovanja i slično);   <br>
                                                                                                                                             .
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