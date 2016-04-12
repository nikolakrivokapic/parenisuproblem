<form id="form" accept-charset="UTF-8" action="{{URL::to('/')}}/page-snimi/{{$kampanja->slug}}" method="POST" enctype="multipart/form-data">
<div class="f-page-container f-pos-rel f-font-condensed">
<div class="f-grid-row f-m-b-xlarge" id="editor">
<div class="f-bg-white f-p-l-xlarge f-p-r-xlarge f-p-t-xlarge f-p-b-xlarge">
<div class="f-grid-row">
<div class="f-grid-8of12">
<h2 class="f-fw-thin">Uredi javnu stranicu kampanje</h2>
</div>
</div>
<p class="f-p-b-large">Popunite informacije što detaljnije kako bi ste približili kampanju posjetiocima. Nakon izvršenih promjena kliknite na dugme <span style="color: #B87619"><b>SAČUVAJ</b></span> na dnu ove stranice.</p>
<div class="f-m-b-large" id="basic-details"><div><div class="f-grid-row">
  <div class="f-p-b-xlarge">
    <div class="f-grid-row f-p-b-xsmall">
      <div class="f-grid-8of12">
        <h4>Naslov Kampanje*</h4>
      </div>
      <div class="f-fc-light f-fs-small f-grid-4of12 f-lh-xlarge f-tr js-title-count">49</div>
    </div>
    <input class="js-update-title" type="text" name="naslov" maxlength="150" value="{{$kampanja->naslov}}">
    <div class="f-fc-error f-hide f-p-t-xsmall js-error" data-field="title"></div>
  </div>
  <div class="f-p-b-xlarge f-p-t-small">
    <div class="f-grid-row">
      <div class="f-grid-8of12">
        <h4 class="f-p-b-xsmall">Gdje se vaša kampanja nalazi? *</h4>
        <div class="f-grid-row js-location">
          <div class="f-grid-4of12">
            <input class="js-zip" type="text" name="lokacija" placeholder="Grad, Lokacija" value="{{$kampanja->lokacija}}">
            <input class="js-postal f-hide" type="text" name="lokacija" placeholder="Grad, Lokacija" value="{{$kampanja->lokacija}}">
          </div>
          <div class="f-fs-small f-grid-6of12 f-p-l-xsmall" style="line-height: 35px">
            <div class="js-city-state">{{$user->lokacija}}</div>
          </div>
        </div>
        <div class="f-grid-row">
          <div class="f-fc-error f-hide f-p-t-xsmall js-error" data-field="zip"></div>
          <div class="f-fc-error f-hide f-p-t-xsmall js-error" data-field="postal_code"></div>
        </div>
      </div>
      <div class="f-grid-4of12">
        <h4 class="f-p-b-xsmall">Cilj (cifra u evrima) *</h4>
        <input type="text" name="cilj" placeholder="Cilj (€ EUR)" value="{{$kampanja->cilj}}">
        <div class="f-fc-error f-hide f-p-t-xsmall js-error" data-field="donation_goal"></div>
      </div>
       <div class="f-grid-4of12" style="margin-left:593px;margin-top:14px;">
        <h4 class="f-p-b-xsmall">Trenutno skupljeno (cifra u evrima) *</h4>
        <input type="text" name="skupljeno" placeholder="Trenutno skupljeno (€ EUR)" value="@if(isset($kampanja->skupljeno)){{$kampanja->skupljeno}}@endif">
        <div class="f-fc-error f-hide f-p-t-xsmall js-error" data-field="donation_goal"></div>
      </div>
    </div>
  </div>













  <script>
 function show(target) {

    document.getElementById(target).style.display = 'block';
}

function hide(target) {

    document.getElementById(target).style.display = 'none';
}

    //  Bind the event handler to the "submit" JavaScript event



</script>



   <script>
 function uplatesnimi() {

 var token = $('meta[name="csrf-token"]').attr('content');

$.ajax({
    type: "POST",
    data: '_token=' + token + "&text=" + $.trim( $("#textbox4").val() ) + "&id=" + "{{$kampanja->id}}",
    url: "{{URL::to('/')}}/uplate/snimi",
    success: function(msg){

        hide('uplate');

    },
            error   : function(resp){
            alert(JSON.stringify(resp));
             //   alert(resp);
                    }
});

}
</script>



<a class="f-button f-fs-xlarge f-fw-bold f-tc f-text-truncate f-width-100 js-cta-donate primary" onclick="show('uplate')" data-mp-position="Primary CTA" id="mp-cta-donate" rel="nofollow">
UPUTSTVO ZA UPLATU
</a>





<div id="uplate" class="f-fs-medium f-popup f-z-popup" style="display: none; height: 6833px; position: fixed; z-index: 9;">
  <div class="f-bg-black f-opacity-medium f-popup-overlay" style="height: 6833px;"></div>
  <div class="f-anim-fadeinup-fast f-bg-xlight f-br-medium f-fc-xdark f-popup-container f-pos-rel f-tl" style="width: 400px; position: fixed; margin-left: -200px;margin-top: -266px; top: 50%; left: 50%; height: 532px;">
    <i class="f-align-tr f-clickable f-fc-hover-dark f-fc-medium f-fs-xlarge f-m-medium f-popup-close fa fa-times" style="z-index: 100;" onclick="hide('uplate')"></i>
    <script src="https://www.google.com/recaptcha/api.js" async:="" defer:=""></script>
<div class="f-p-medium">
  <h4>Ovdje unesite sve relevantne informacije o načinima uplate/prenosa/doniranja, koje će posjedioci moći da vide kada kliknu na dugme "Doniraj"</h4>
</div>
<div class="f-hr"></div>
<div class="f-font-condensed f-p-medium">

  <h5>Kako uplatiti/donirati novac?</h5>
  <textarea  maxlength="1000" id="textbox4" name="text" style="height: 150px; resize: none" placeholder="@if($kampanja->uputstvo=="")Možete unijeti podatke kao što su brojevi bankovnih računa, instrukcije za plaćanje iz inostranstva i slično. Budite kratki i konkretni.@endif">@if($kampanja->uputstvo!=""){{$kampanja->uputstvo}}@endif</textarea>
   (do 500 karaktera)



</div>

<div class="f-hr"></div>
<div class="f-flex-center-y f-p-medium">

     <button onclick="uplatesnimi(); return false;">SAČUVAJ</button>
  <div class="f-m-l-small js-loader" style="display:none">
    <div class="f-bg-light f-fs-small f-spinner-circles"></div>
  </div>
</div>
  </div>
</div>













       <script>  $(function() {

    $("#kategorija").val("{{$kampanja->kategorija}}");
});

</script>
  <div class="f-p-b-xlarge f-p-t-small">
    <div class="f-grid-row">
      <div class="f-grid-8of12" >
        <h4 class="f-p-b-xsmall">Kategorija</h4>
        <div class="f-grid-10of12">


          <select name="kategorija" id="kategorija"  >
            <option value="Liječenje">Liječenje</option>
            <option value="Edukacija">Školovanje</option>
            <option value="Kultura">Kultura</option>
          <option value="Ekologija">Ekologija</option>
            <option value="Sport">Sport</option>
            <option value="Nevladineorganizacije">Nevladine Organizacije</option>


            <option value="Životinje">Životinje</option>

            <option value="Religija">Religija</option>


            <option value="Putovanja">Putovanja/Avanture</option>
          </select>
        </div>
      </div>
      <div class="f-grid-4of12">
        <div class="f-p-b-xsmall">
          <h4>
           Datum završetka kampanje
            &nbsp;
            <span class="f-clickable f-fc-medium f-fs-small f-fw-normal f-normal-caps hint--top hint--wrap" data-hint="Podaci o kampanji biće sačuvani i kada vrijeme istekne. Kampanja može trajati koliko god želite.">
              [?]
            </span>
          </h4>
        </div>
        <div class="f-grid-row">
          <div class="f-input-decorator">
            <input type="text" name="datumisteka" id="datepicker" value="{{$kampanja->datumisteka}}" readonly="" class="picker__input">

          </div>
          <div class="f-fc-error f-hide f-p-t-xsmall js-error" data-field="ends_on"></div>
        </div>
      </div>
         </div>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });

  function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){

        readURL(this);
    });
  </script>


  <div class="f-grid-row f-p-b-xlarge">
    <div class="f-p-t-small" >
      <div class="f-grid-row f-p-b-xsmall">
        <div class="f-grid-8of12">
          <h4 class="f-ilb">
            Koji je cilj sakupljanja sredstava? (maksimum 500 karaktera)
          </h4>
          &nbsp;
          <span class="f-clickable f-fc-medium f-fs-small f-ilb hint--top hint--wrap" data-hint="Važno je da navedete detalje o tome za koga ili za šta je vaša kampanja i kako vam sredstva mogu pomoći.">
            [?]
          </span>
        </div>
        <div class="f-fc-light f-fs-small f-grid-4of12 f-lh-xlarge f-tr js-subtitle-count">220</div>
      </div>
      <textarea maxlength="500" rows="5" name="text" style="resize: none" placeholder="Primjer: Sakupljam sredstva za pomoć u liječenju svog prijatelja. Sredstva će ići u kupovinu potrebnih ljekova i plaćanje tretamana.">{{$kampanja->text}}</textarea>
      <div class="f-fc-error f-hide f-ilb f-p-r-small f-p-t-xsmall js-error" data-field="subtitle"></div>
    </div>
  </div>
</div></div></div>
<div class="f-m-b-large" id="gallery"><div><div class="f-grid-row f-p-b-xlarge">
  <div class="f-p-b-xsmall">
    <h4 class="f-ilb">
      Dodajte slike
    </h4>
    <p>Dodavajući sliku povećavate šanse za sakupljanje sredstava.</p>
    <p class="f-p-t-large">Možete dodati do 6 slika i jedan video. Prva slika u redu ujedno je i naslovna slika za vašu stranicu. Slike možete zamjeniti u svakom trenutku i postaviti nove umjesto postojećih.<br>
    Video fajl mora biti mp4 format (maksimalna veličina 10mb)</p>
  </div>























<script type="text/javascript">
$(document).ready(function() {
  $.uploadPreview({
    input_field: "#image-upload",
    preview_box: "#image-preview",
    label_field: "#image-label"
  });

    $.uploadPreview({
    input_field: "#image-upload1",
    preview_box: "#image-preview1",
    label_field: "#image-label1"
  });

      $.uploadPreview({
    input_field: "#image-upload2",
    preview_box: "#image-preview2",
    label_field: "#image-label2"
  });


        $.uploadPreview({
    input_field: "#image-upload3",
    preview_box: "#image-preview3",
    label_field: "#image-label3"
  });

        $.uploadPreview({
    input_field: "#image-upload4",
    preview_box: "#image-preview4",
    label_field: "#image-label4"
  });

        $.uploadPreview({
    input_field: "#image-upload5",
    preview_box: "#image-preview5",
    label_field: "#image-label5"
  });



  $('input[id=video]').change(function(e){
          $in=$(this);
                var filename=   $in.val().replace(/C:\\fakepath\\/i, '')
       $('#zavideo').text(filename+" je prikačen.")
       $('#izbrisivideo').text("Izbriši");

});


    $("#video-upload").click(function(){
    $("#video-preview").show();
      if($('#videourl').val() != ''){
            // Get youtube video's thumbnail url
            // using jYoutube jQuery plugin
            url = $.jYoutube($('#videourl').val());

            // Now append this image to <div id="thumbs">

      //   $('#video-upload').val()  = url;

    $('#video-preview').css('background-image', 'url(' + url + ')');

  $('#form').append('<input name="videoslika" type="text" value="'+url+'" />');


    $('#video-preview').css('background-repeat', 'no-repeat');
    $('#video-preview').css('background-size', 'cover');


        }



    });




});


$.extend({
  jYoutube: function( url, size ){
    if(url === null){ return ""; }

    size = (size === null) ? "big" : size;
    var vid;
    var results;

    results = url.match("[\?&]v=([^&#]*)");

    vid = ( results === null ) ? url : results[1];

    if(size == "small"){
      return "http://img.youtube.com/vi/"+vid+"/2.jpg";
    }else {
      return "http://img.youtube.com/vi/"+vid+"/0.jpg";
    }
  }
});




 function brisanje(imetaga, id) {
     if (confirm("Da li ste sigurni?")) {
var token = $('meta[name="csrf-token"]').attr('content');

$.ajax({
    type: "POST",
    data: '_token=' + token + "&imetaga=" + imetaga + "&id=" +id,
    url: "{{URL::to('/')}}/izbrisitag",
    success: function(msg){
       $('#zavideo').text("");
         $('#izbrisivideo').text("");

    },
            error   : function(resp){
            alert("Greska");
             //   alert(resp);
                    }
});
}
}
</script>

  <div class="f-fc-error f-hide f-p-b-xsmall js-error" data-field="gallery"></div>

  <li  id="image-preview" class="f-b-light f-fl f-ilb f-m-b-small f-m-r-medium f-tc js-gallery-image"  style="width: 180px; height: 180px; background-color: #F7FDFD; background-image: url('{{$kampanja->slika}}');background-size:     cover;                      /* <------ */
    background-repeat:   no-repeat;
    background-position: center center;">
  <div   class="f-height-100 f-upload-btn js-upload-controls">

        <div class="f-m-t-xlarge f-upload-btn  js-upload-btn" style="height:100%">
      <i class="f-fc-swatchone f-p-b-xsmall f-p-t-small fa fa-4x fa-camera"></i>
      <p class="f-caps f-fw-bold">Zakači Sliku</p>
      <input type="file" name="slika" id="image-upload">
    </div>



  </div>
</li>

  <li  id="image-preview1" class="f-b-light f-fl f-ilb f-m-b-small f-m-r-medium f-tc js-gallery-image"  style="width: 180px; height: 180px; background-color: #F7FDFD; background-image: url('{{$kampanja->slika2}}');background-size:     cover;                      /* <------ */
    background-repeat:   no-repeat;
    background-position: center center;">
  <div   class="f-height-100 f-upload-btn js-upload-controls">

        <div class="f-m-t-xlarge f-upload-btn  js-upload-btn" style="height:100%">
      <i class="f-fc-swatchone f-p-b-xsmall f-p-t-small fa fa-4x fa-camera"></i>
      <p class="f-caps f-fw-bold">Zakači Sliku</p>
      <input type="file" name="slika2" id="image-upload1">
    </div>



  </div>
</li>

  <li  id="image-preview2" class="f-b-light f-fl f-ilb f-m-b-small f-m-r-medium f-tc js-gallery-image"  style="width: 180px; height: 180px; background-color: #F7FDFD; background-image: url('{{$kampanja->slika3}}');background-size:     cover;                      /* <------ */
    background-repeat:   no-repeat;
    background-position: center center;">
  <div   class="f-height-100 f-upload-btn js-upload-controls">

        <div class="f-m-t-xlarge f-upload-btn  js-upload-btn" style="height:100%">
      <i class="f-fc-swatchone f-p-b-xsmall f-p-t-small fa fa-4x fa-camera"></i>
      <p class="f-caps f-fw-bold">Zakači Sliku</p>
      <input type="file" name="slika3" id="image-upload2">
    </div>



  </div>
</li>





  <li  id="image-preview3" class="f-b-light f-fl f-ilb f-m-b-small f-m-r-medium f-tc js-gallery-image"  style="width: 180px; height: 180px; background-color: #F7FDFD; background-image: url('{{$kampanja->slika4}}');background-size:     cover;                      /* <------ */
    background-repeat:   no-repeat;
    background-position: center center;">
  <div   class="f-height-100 f-upload-btn js-upload-controls">

        <div class="f-m-t-xlarge f-upload-btn  js-upload-btn" style="height:100%">
      <i class="f-fc-swatchone f-p-b-xsmall f-p-t-small fa fa-4x fa-camera"></i>
      <p class="f-caps f-fw-bold">Zakači Sliku</p>
      <input type="file" name="slika4" id="image-upload3">
    </div>



  </div>
</li>





  <li  id="image-preview4" class="f-b-light f-fl f-ilb f-m-b-small f-m-r-medium f-tc js-gallery-image"  style="width: 180px; height: 180px; background-color: #F7FDFD; background-image: url('{{$kampanja->slika5}}');background-size:     cover;                      /* <------ */
    background-repeat:   no-repeat;
    background-position: center center;">
  <div   class="f-height-100 f-upload-btn js-upload-controls">

        <div class="f-m-t-xlarge f-upload-btn  js-upload-btn" style="height:100%">
      <i class="f-fc-swatchone f-p-b-xsmall f-p-t-small fa fa-4x fa-camera"></i>
      <p class="f-caps f-fw-bold">Zakači Sliku</p>
      <input type="file" name="slika5" id="image-upload4">
    </div>



  </div>
</li>



  <li  id="image-preview5" class="f-b-light f-fl f-ilb f-m-b-small f-m-r-medium f-tc js-gallery-image"  style="width: 180px; height: 180px; background-color: #F7FDFD; background-image: url('{{$kampanja->slika6}}');background-size:     cover;                      /* <------ */
    background-repeat:   no-repeat;
    background-position: center center;">
  <div   class="f-height-100 f-upload-btn js-upload-controls">

        <div class="f-m-t-xlarge f-upload-btn  js-upload-btn" style="height:100%">
      <i class="f-fc-swatchone f-p-b-xsmall f-p-t-small fa fa-4x fa-camera"></i>
      <p class="f-caps f-fw-bold">Zakači Sliku</p>
      <input type="file" name="slika6" id="image-upload5">
    </div>



  </div>
</li>


            <?php
              $path = explode('/',$kampanja->videourl);

        ?>
             <li  id="video-preview" class="f-b-light f-fl f-ilb f-m-b-small f-m-r-medium f-tc js-gallery-image"  style="width: 180px; height: 180px; background-color: #F7FDFD; background-image: url('');background-size:     cover;                      /* <------ */
    background-repeat:   no-repeat;
    background-position: center center;">
  <div   class="f-height-100 f-upload-btn js-upload-controls">
      <p id="zavideo">@if($kampanja->videourl=="")Pored slika, možete i prikačiti i VIDEO fajl koji će biti prikazan na vašoj stranici:@else Trenutno prikačen:{{"\n".$path[4]}}@endif</p>

      <i class="f-fc-swatchone f-p-b-xsmall f-p-t-small fa fa-4x fa-camera"></i>
      <p class="f-caps f-fw-bold">Zakači VIDEO</p>
      <input type="file" name="video" id="video">
    </div>

      <a id="izbrisivideo" onclick="brisanje('videourl', '{{$kampanja->id}}')" style="cursor:pointer;" > @if($kampanja->videourl!="") Izbriši @endif  </a>

  </div>

</li>





<!--  <div class="f-grid-row">
    <div class="f-grid-10of12 f-p-r-small">
      <input id="videourl"  name="video" class="js-video-url" type="text" placeholder="Youtube adresa videa">
    </div>
    <div class="f-grid-2of12 f-tc">
      <a class="f-button js-add-video swatchone" id="video-upload">Zakači Video</a>
    </div>
  </div>-->
</div></div></div>
<!--
 <script>
 $('#editor').wysiwyg();
</script>
    <div id="editor">
      Go ahead&hellip;
    </div>-->


<div class="f-m-b-large" id="more-info"><div><div class="f-grid-row f-p-b-xlarge">
  <h4 class="f-p-b-xsmall">Više informacija (opširniji opis situacije) (maximum 1000 karaktera)</h4>
  <ul class="bulleted f-fc-dark f-list f-m-b-large f-p-xsmall no-hover no-padding" style="border: none;">
    <li>
     Ispričajte svoju priču
    </li>
    <li>
     Budite specifični o tome kako će sredstva biti trošena
    </li>
    <li>
      Dodajte slike da poboljšate utisak
    </li>
  </ul>
  <div class="f-grid-row f-p-b-xlarge">
    <div class="f-p-t-small">

      <textarea maxlength="1000" rows="8" name="opsirnije" style="resize: none"   placeholder="Ovdje možete unijeti detaljnije informacije i sve što mislite da je relevantno.">@if(isset($kampanja->opsirnije)){{$kampanja->opsirnije}}@endif</textarea>
      <div class="f-fc-error f-hide f-ilb f-p-r-small f-p-t-xsmall js-error" data-field="subtitle"></div>
    </div>
  </div>
</div></div>





<div class="f-m-b-large" id="js-themalizer"><div class="f-grid-row f-p-b-xlarge">
  <h5 class="f-caps f-p-b-xsmall">Vizuelna Tema</h5>
  <p class="f-fc-dark f-m-b-xsmall">
   Kliknite na polje da izbarete boju vašu stranice.
  </p>
  <div class="f-m-b-xsmall">
	<div class="input-toggles">
			<input name="boja" class="color no-alpha" value="{{$kampanja->boja}}" />

		</div>

  </div>
<!--  <a onclick="show('dodatne')" class="f-caps f-font-condensed f-fw-bold" href="#themalize-advanced">Dodatne Opcije</a>    -->
</div></div>

 <script>

 function show(target) {
    document.getElementById(target).style.display = 'block';
}

function hide(target) {
    document.getElementById(target).style.display = 'none';
}

</script>



<div id="dodatne" class="f-anim-fadeinup-fast f-br-medium f-fc-xdark f-popup-container f-pos-rel f-tl f-b-medium f-bg-white" style="display:none;">
    <i class="f-align-tr f-clickable f-fc-hover-dark f-fc-medium f-fs-xlarge f-m-medium f-popup-close fa fa-times" onclick="hide('dodatne')" style="z-index: 100;"></i>
    <style>
  .hint--top:after {
    width: 200px;
    white-space: pre-wrap;
    word-wrap: break-word;
  }
</style>
<div class="f-fc-black f-p-medium">
  <h3>Kreiraj Temu</h3>
</div>
<div class="f-hr"></div>
<div class="f-p-medium">
  <div class="f-content-spacing-medium f-tc">
<!--    <div class="f-ilb f-tl">
      <h5 class="f-caps f-m-b-xsmall">Primarna Boja</h5>
      <div class="f-b-medium f-br-small f-flex-center f-p-medium js-button-color" style="height:110px; width:120px; background-color: #ff8b5d">
        <input class="f-font-condensed" type="text" value="#ff8b5d" placeholder="HEX #">
      </div>
    </div>
    <div class="f-ilb f-tl">
      <h5 class="f-caps f-m-b-xsmall">H</h5>
      <div class="f-b-medium f-br-small f-flex-center f-p-medium js-app-ribbon-color" style="height:110px; width:120px; background-color: #ffffff">
        <input class="f-font-condensed" type="text" value="#ffffff" placeholder="HEX #">
      </div>
    </div>-->
    <div class="f-ilb f-tl">
      <div class="f-clickable f-fr hint--left js-remove-bg" data-hint="Remove background">
        <i class="fa fa-trash-o"></i>
      </div>
      <h5 class="f-caps f-m-b-xsmall">Slika kao POzadina</h5>
      <div class="hint--top" data-hint="Za najbolji izgled zakačite sliku sa rezolucijom najmanje 1000x1200px">
        <div class="f-b-medium f-bg-center f-bg-cover f-bg-norepeat f-br-small f-flex-center f-p-medium js-bg-thumb" style="height:110px; width:120px">
          <div class="f-button f-fs-medium f-fw-bold f-upload-btn js-upload-bg xlight">
           Zakači
            <input type="file" name="pozadina" value="{{$kampanja->pozadina}}" style="background-image: url('{{$kampanja->pozadina}}');background-size:     cover;                      /* <------ */
    background-repeat:   no-repeat;
    background-position: center center;">
          </div>
        </div>
      </div>
    </div>
    <div class="f-ilb f-tl">
      <div class="f-clickable f-fr hint--left js-remove-logo" data-hint="Remove logo">
        <i class="fa fa-trash-o"></i>
      </div>
      <h5 class="f-caps f-m-b-xsmall">Logo</h5>
      <div class="hint--top" data-hint="Dodajte logo u gornjem lijevom uglu vaše stranice. Logo može biti do 40px veličine.">
        <div class="f-b-medium f-bg-center f-bg-contain f-bg-norepeat f-br-small f-flex-center f-p-medium f-pos-rel js-logo-thumb" style="height:110px; width:120px">
          <div class="f-button f-fs-medium f-fw-bold f-upload-btn js-upload-logo xlight">
            Zakači
            <input type="file" name="logo" value="{{$kampanja->logo}}" style="background-image: url('{{$kampanja->logo}}');background-size:     cover;                      /* <------ */
    background-repeat:   no-repeat;
    background-position: center center;">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="f-hr"></div>

  </div>

       <div class="f-grid-row f-tr f-m-t-large f-m-b-xlarge" style="margin-left:33px;text-align:left;">


<div class="f-grid-row f-tr f-m-t-large f-m-b-xlarge">

<a class="f-button white f-m-r-xsmall" href="{{URL::to('/')}}/page-view/{{$kampanja->slug}}">Povratak na Stranicu</a>
<button class="js-update f-button primary" type="submit">Sačuvaj</button>

</div>   <div style="margin-top:-50px;">
<a style="cursor:pointer;" onclick="brisikampanju('{{$kampanja->id}}')">IZBRIŠI OVU KAMPANJU</a>     </div>
</div>
 </div>        </div>
 <input type="hidden" name="_token" value="{{ csrf_token() }}">

</div>
</div>
</div>

</form>
<script>
    function brisikampanju(id) {
            if (confirm("Ovo je opcija kompletnog brisanja kampanje, kao i svih ažuriranja i komentara koji su vezani za nju. Razmislite još jednom da li ste sigurni da želite izbrisati kampanju. Možete kampanju samo pauzirati, i ona će biti nevidljiva svima osim vas. Ako ste stvarno sigurni da želite ukloniti kampanju kliknite na dugme OK da je kompletno izbrišete iz sistema, da odustanete pritisnite CANCEL.")) {
                     var token = $('meta[name="csrf-token"]').attr('content');

$.ajax({
    type: "POST",
    data: '_token=' + token + "&id=" + id,
    url: "{{URL::to('/')}}/kampanja/brisanje",
    success: function(msg){
       alert('Kampanja je izbrisana.');
       window.location.replace("{{URL::to('/')}}");

    },
            error   : function(resp){
            alert(JSON.stringify(resp));
             //   alert(resp);
                    }
});


            }


    }
</script>