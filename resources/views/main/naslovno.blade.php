<div class='f-width-100'>
<h1 style='font-size: 45px'>Pare nisu problem!</h1>
<p class='f-fw-thin f-font-condensed f-fc-xlight f-fs-xlarge'>Regionalni portal za pomoć u doniranju novca</p>
<div class='js-join-track f-of-hidden f-m-t-large'>
<div class='js-join-train f-clearfix'>
<div class='js-fb'>
<div class='f-bg-xlight f-br-xsmall f-p-small f-ilb f-m-t-large f-m-b-medium'>
<a href="/auth/social/facebook">
<div class='f-button facebook1 f-fw-bold f-fs-large'>
Prijavite se putem Facebook-a
</div>  </a>
</div>
<p class='f-fw-light f-fs-medium f-font-condensed'>
<a class='js-use-email f-fc-white f-fc-hover-light f-clickable' onclick="unset();">
<span>Ili se prijavite putem vašeg</span>
<b>email</b>-a
<span>.</span>
</a>
</p>
</div>



<div class='js-email f-tc f-p-t-medium f-hide' >
<div class='f-ilb f-flex-center' style="width: 100%; float: left;margin-left:0px;">
<a class='js-use-fb f-m-r-small f-fc-white f-fc-hover-white f-opacity-light f-opacity-hover-full f-clickable'>
<i class='fa fa-chevron-left fa-2x'></i>
</a>

<div class='f-ilb f-bg-xlight f-p-small f-content-spacing-xsmall f-br-xsmall f-fs-medium'>
<form method="POST" action="{{ URL::to("/")}}/auth/register" id="forma">
<input type="hidden" name="_token" value="{{ csrf_token() }}">


 <div id="wrapper1" class='f-ilb f-bg-xlight f-p-small f-content-spacing-xsmall f-br-xsmall f-fs-medium'  >
<div class='f-ilb'>
<input id="fullname" class='f-font-condensed' name='fullname' placeholder='Ime i Prezime' type='text'>
</div>
<div class='f-ilb'>
<input class='f-font-condensed' name='email' id='email'  placeholder='Email' type='email'>
</div>
<div class='f-ilb'>
<input class='f-font-condensed' name='password' placeholder='Šifra' style='width: 150px' type='password'>
</div>
<button class='js-email-submit f-ilb f-fw-bold f-button primary'  type="submit">REGISTRACIJA</button>


</div>

 </form>
</div>
</div>

</div>
<script>
$('#forma').submit(function() {
    if ($.trim($("#email").val()) === "" || $.trim($("#fullname").val()) === "") {

        return false;
    }
});
</script>

</div>

</div>

<div class='js-join-track f-of-hidden f-m-t-large'>
<div class='js-join-train f-clearfix'>
<div class='js-email f-tc f-p-t-medium f-hide'>
<div class='f-ilb f-flex-center'>
<a class="f-ilb f-button transparent js-use-email  f-fc-white f-fc-hover-light f-clickable'" onclick="set();" style="color:white; border-color:white;">Da li ste
<strong>NEPROFITNA ORGANIZACIJA?</strong>
Kliknite ovdje
</a>
</div>
</div>
</div>
</div>


   <script>
   var organizacija=false;
   function set() {
/*    var newspan = document.createElement('div');
   newspan.className = "f-lib";
  newspan.style.marginBottom="15px";*/
$('#ime').attr("placeholder", "Organizacija");
/*    newspan.innerHTML = '<input class="f-font-condensed" name="fullname" id="organizacija" placeholder="Organizacija" type="text" style="margin-left:0px;width:220px;">';

    eElement = document.getElementById('wrapper1');
    eElement.insertBefore(newspan, eElement.firstChild);*/
}
function unset(){
          $('#ime').attr("placeholder", "Ime i Prezime");

}
</script>







</div>