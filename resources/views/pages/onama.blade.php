@extends('layout')

@section('content')

@include('header_pages')

<div class='f-width-100' style='height: 63px'></div>
<div class="f-pos-rel f-bg-black" style="height: 450px">
<div class="f-height-100 f-bg-center f-bg-norepeat f-fullbleed f-opacity-dark" data-background-image="{{URL::to('/')}}/assets/onama.jpg" data-defer="" data-scrollspy="0" style="background-image: url(&quot;{{URL::to('/')}}/assets/onama.jpg&quot;);"></div>
<div class="f-bg-black-o-medium f-fullbleed"></div>
<div class="f-page-container responsive f-pos-rel f-tc f-flex-center f-height-100">
<div class="f-width-100">
<h1 class="f-fc-swatchtwo f-font-main" style="font-size: 40px">
Sajt sa humanom misijom pomoći drugima
</h1>
<div class="f-grid-row f-m-large f-opacity-xlight">
<div class="f-grid-2of12-offset f-grid-3of12">
<div class="f-hr"></div>
</div>
<div class="f-grid-2of12">
<div class="f-hr"></div>
</div>
<div class="f-grid-3of12">
<div class="f-hr"></div>
</div>
</div>
<div class="f-grid-row f-r-phone-hide">
<div class="f-grid-8of12 f-grid-2of12-offset">
<p class="f-fw-thin f-fs-large f-fc-white f-p-x-large f-r-phone-show">
U zemljama gdje se jedni razmeću milionima, a drugi muče da obezbjede sredstva za osnovne životne uslove, pare više ne bi trebalo da budu problem.
</p>
</div>
</div>
<p class="f-fw-thin f-fs-large f-fc-white f-p-x-large f-r-phone-show f-r-desktop-hide f-r-tablet-hide">
U zemlji sa 600 hiljada stanovnika, za liječenje i spašavanje života, pare ne bi trebalo da budu problem.
</p>
<a class="f-button primary f-fs-large f-m-t-large" href="#mission">Kako smo nastali?</a>
</div>
</div>
</div>



<div class="f-page-container responsive f-tc f-p-y-xlarge">
<h1 class="f-font-main f-fc-black f-m-b-medium f-p-x-medium" id="mission">Kako je nastao portal <i>Pare Nisu Problem</i></h1>
<p class="f-fw-thin f-fs-xlarge f-fc-dark f-p-x-large">
Sajt je nastao kao plod ideje malog tima za web programiranje iz Herceg Novog, <a href="http://3hercegnovi.me/bokaestate/portfolio/sr">BokaEstate</a>, na čijem čelu se nalazi programer Nikola Krivokapić. Uočivši veliki broj ljudi u urgnetnoj potrebi za finansijskim sredstvima, uglavnom zbog liječenja i sličnih hitnih situacija, shvatili smo da ljudi bivaju ostavljeni sami sebi na milost i nemilost da se snalaze i prikupljaju sredstva kako znaju i umiju.
</br></br>Mnogima od nas 10 ili 20 ili mnogo više hiljada eura ne predstavljaju ništa, a nekim ljudima to može spasiti život. Zato smo smatrali da treba da poklonimo ovakvu jednu platformu Crnoj Gori i regionu, uz pomoć koje će posredstvom savremene tehnologije biti omogućeno lakše prikupljanje neophodnih sredstava svima koji su u urgnetnoj potrebi za njima. Sajt je absolutno besplatan za korišćenje.</br></br>Pored liječenja na koje smo najviše fokusirani, sajt smo zamislili i kao platformu za finansiranje i drugih oblasti kao što su sport, kultura, i slično.
</br></br>Za sva dodatna pitanja pišite nam na email info@parenisuproblem.me
</p>

</div>


@endsection