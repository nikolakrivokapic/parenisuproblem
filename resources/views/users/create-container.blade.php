<div class='f-pos-rel f-of-hidden' style='height:{{ $visina }}'>
<div class='f-fullbleed f-bg-center' style='background-image: url({{URL::to('/')}}/assets/back.jpg); background-repeat: no-repeat; background-position: center; background-size: cover'></div>
<div class='f-bg-black-o-xlight f-fullbleed'></div>
<div class='js-campaign-creation f-fullbleed f-tc f-fc-white' style='min-width: 650px'>
<div class='js-track f-height-100 f-of-hidden'>
<div class='js-train'>
<div class='js-page f-flex-center f-p-xlarge ' data-step='create' style='{{ $visina }}'>
<input name='externalid' type='hidden'>
<div>
<div class='f-avatar-medium f-b-xlight two' style='background-image:url({{$user->slika}}?width=100&amp;height=100)'></div>


<form action="{{URL::to('/')}}/kampanja/pokreni" method="post">
<div class='create-container' style=''>
<h2 style='font-size: 40px'>
<span class='js-user-fname'>{{$user->fullname}}, </span>
Hajde da napravimo novu kampanju
</h2>
<p class='f-fw-light f-font-condensed f-fs-xlarge f-fc-light'>Samo pratite uputstva</p>
<div class='f-bg-xlight f-p-small f-content-spacing-xsmall f-br-xsmall f-fs-medium f-m-t-medium'>
<div class='f-ilb'>
<input class='f-font-condensed' maxlength='60' name='naslov' placeholder='Naslov kampanje' style='width:240px' type='text'>
</div>
<div class='f-ilb'>
<!--<select class='js-country f-font-condensed' name='country' style='width: 140px'></select> -->
<select name='drzava' style='width: 140px'><option>Crna Gora</option><option>Srbija</option><option>Bosna i Hercegovina</option><option>Hrvatska</option></select>
</div>
<div class='f-ilb'>
<input class='f-font-condensed' name="cilj" pattern='\d*' placeholder='Cilj (EUR)' style='width:100px' type='text'>
</div>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class='f-ilb hint--top' data-hint='Unesite ime grada, kako bi smo lakše pozicionirali vašu stranicu i prilagodili je vašoj lokaciji'>
<div class='f-input-decorator' style='width:125px'>
<input class='f-font-condensed' maxlength='30' placeholder='Grad' type='text' name="lokacija">
<div class='f-decorator f-bg-white f-clickable'>
<i class='fa fa-info f-fc-medium'></i>
</div>
</div>
</div>
<div class='f-ilb hint--top' data-hint='Izaberite kategoriju kampanje'>
<select class='f-font-condensed' name='kategorija' style='width: 150px'>

<option value='Liječenje'>Liječenje</option>
<option value='Školovanje'>Školovanje</option>
 <option value='Kultura'>Kultura</option>
  <option value='Ekologija'>Ekologija</option>
<option value='Nevladine organizacije'>Nevladine Organizacije</option>
<option value='Sport'>Sport</option>
<option value='Životinje'>Životinje</option>
<option value='Putovanja'>Putovanja</option>

</select>
</div>
<button class='js-create-submit f-ilb f-fw-bold f-button primary' type="submit">Nastavi</button>
</div>
<p class='f-fw-light f-fs-medium f-m-t-medium'>
<a class='f-fc-light f-fc-hover-medium' href='{{URL::to('/')}}/pravila-upotrebe' target='_blank'>
<span>Ovim potvrđujete slaganje sa našim</span>
<b>pravilima upotrebe</b>
<span>.</span>
</a>
</p>
</div>
 </form>

</div>
</div>



</div>
</div>
</div>
</div>