@extends('users.layout')

@section('profile-container')
 <script>
 function show(target) {
    document.getElementById(target).style.display = 'block';

}

function hide(target) {
    document.getElementById(target).style.display = 'none';

}

</script>

<div id="kontakt" class="popup-instance f-style-guide" style="display:none;"><div class="f-fs-medium f-popup f-z-popup" style="height: 992px;">
  <div class="f-bg-black f-opacity-medium f-popup-overlay" style="height: 992px;"></div>
  <div class="f-anim-fadeinup-fast f-bg-xlight f-br-medium f-fc-xdark f-popup-container f-pos-rel f-tl" style="width: 400px; position: absolute; margin-top: 0px; top: 127px; left: 600px; height: 532px;">
    <i class="f-align-tr f-clickable f-fc-hover-dark f-fc-medium f-fs-xlarge f-m-medium f-popup-close fa fa-times" style="z-index: 100;" href="#" onclick="hide('kontakt')"></i>

<div class="f-p-medium">
  <h3>Contact Nikola</h3>
</div>
<div class="f-hr"></div>
<div class="f-font-condensed f-p-medium">
  <div class="f-grid-row f-m-b-small">
    <div class="f-grid-6of12 f-p-r-small">
      <h5>Vaše ime</h5>
            @if(Auth::check())
      <input type="text" name="name" value="{{Auth::user()->fullname}}">
      @else
       <input type="text" name="name" value="">
         @endif
          </div>
    <div class="f-grid-6of12 f-p-l-small">
      <h5>Email</h5>
      @if(Auth::check())
      <input type="email" name="email" value="{{Auth::user()->email}}">
      @else
      <input type="email" name="email" value="">
      @endif
    </div>
    <div class="f-hide">
      <h5>Phone</h5>
      <input type="text" name="phone">
    </div>
  </div>
  <h5>Poruka</h5>
  <textarea name="message" style="height: 150px; resize: none"></textarea>
</div>

<div class="f-hr"></div>
<div class="f-flex-center-y f-p-medium">
  <div class="f-button js-submit primary">Pošalji EMail</div>
  <div class="f-m-l-small js-loader" style="display:none">
    <div class="f-bg-light f-fs-small f-spinner-circles"></div>
  </div>
</div>
  </div>
</div></div>


 <style> ul#navlist
            {
            padding: 0;
            margin: 0;
            list-style-type: none;
            float: left;
            width: 80%;
            color: #ddd;
            background-color: #ddd;
            }

            ul#navlist li { display: inline;  }

            ul#navlist li a
            {
            float: left;
            width: 10em;
            color: #ddd;
            background-color: #036;
            padding: 0.2em 1em;
            text-decoration: none;
            border-right: 1px solid #fff;
            }

            ul#navlist li a:hover
            {
            background-color: #369;
            color: #fff;
            }</style>

<div class='f-page-container f-pos-rel f-p-t-xlarge f-p-b-xlarge f-font-condensed'>
<div class='f-grid-row'  >

<div class='f-grid-2of12 f-m-r-medium'>

<h3 class='f-caps f-p-t-xsmall'>KORISNIK:</h3>

<ul id="navlist">
@foreach($poruke as $poruka)
<li ><a id="{{$poruka->sender}}{{$poruka->receiver}}" href="{{URL::to('/')}}/users/poruke/{{Auth::user()->id}}/@if($poruka->autor==Auth::user()->fullname){{$poruka->autor2}}@else{{$poruka->autor}}@endif" @if(strpos($poruka->readunread, Auth::user()->email) === false) style="background-color:#008000" @endif><i>@if($poruka->autor==Auth::user()->fullname){{$poruka->autor2}}@else{{$poruka->autor}}@endif</i><br>
<div class="f-hr-light"></div>   </a>   </li>


 @endforeach
  </ul>
   </br>



</div>


  @if(isset($tt))

<script>

$(document).ready(function(){
 scroll();

 var token = $('meta[name="csrf-token"]').attr('content');

 function checkForMessages() {

     id= '{{$tt->sender}}';
     id1='{{$tt->receiver}}';
      var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: 'GET',
          url:'{{URL::to('/')}}/users/check/poruke',
        data: '_token=' + token + '&id1=' +id1 + '&id=' + id,
        cache: false,
        success: function(response){

            if(response == 1){


                 $button = $('div.prazni');
             var token = $('meta[name="csrf-token"]').attr('content');
                 $.ajax({
            type:'GET',
            url:'{{URL::to('/')}}/users/loadnew/poruke',
            data: '_token=' + token + '&id1=' +id1 + '&id=' + id,
            success:function(data){


         $button.append("<div class='f-hr-light f-m-y-xsmall'></div>");


                $button.append("<b>{{$autordrugi}}</b>"+": "+data.text+"</br> ("+data.vreme+")");


                scroll();


            },
                error:function(exception){alert('Exeption:'+JSON.stringify(exception));}

        });
            }
            else {

/*            sender="{{Session::get('sender')}}";
            receiver="{{Session::get('receiver')}}";

      alert(sender+receiver);
            $("#"+sender+receiver).css("background-color","#008000");

                $("#"+receiver+sender).css("background-color","#008000");*/

             }
        }
    });








}

setInterval(checkForMessages, 7000);



  function loadnew(token,id,id1) {
      var token = $('meta[name="csrf-token"]').attr('content');
                  $.ajax({
            type:'GET',
            url:'{{URL::to('/')}}/users/loadmore/poruke',
            data: '_token=' + token + '&id1=' +id1 + '&id=' + id,
            success:function(data){
      $button = $('div.button1');
             $button.empty();

         $button.append("   <center> <p>  <button id='"+id+"' name='"+id1+"' class='show_more' title='Učitaj sve poruke...'><a href='#'>Učitaj još poruka..</a></button>  </p></center> ");


                 $.each(data.reverse(), function(i,item) {
                     if(item.sender=="{{Auth::user()->id}}")  senderaja="{{Auth::user()->fullname}}";
                     else senderaja = "{{$autordrugi}}";
                $button.append("<b>"+ senderaja +":</b><br />"+" "+item.text.replace(/\n/g, '<br />') +"<br />("+item.vreme+")" +"<div class='f-hr-light f-m-y-xsmall'></div>");


                });

            },
                error:function(exception){alert('Exeption:'+JSON.stringify(exception));}

        });

   }

    $(document).on('click','.show_more',function(){

        $('.show_more').hide();
          var id = this.id;
          var id1 =     this.name;


         $button = $('div.button1');

        autor =   $(this).closest( ".prazni" ).attr( "id" );
       $button.empty();

        loadnew(token,id,id1);


  scroll();

    });
});
</script>
@endif
@if(isset($autordrugi))
<h2>{{$autordrugi}}     </h2>
@endif
  <div id="josporuka" class="f-grid-row f-m-l-xlarge f-m-t-xlarge f-p-t-medium" style="word-wrap: break-word;overflow:scroll;width:680px;height:400px;font-size:13px;margin-left:177px;" >


    <div class='f-grid-9of12 f-p-l-xlarge f-b-l f-b-light' style="width:100%;" style="word-wrap: break-word;">
    <div class='f-bg-white f-p-y-small f-p-x-medium f-grid-row f-tl f-flex  ' style="word-wrap: break-word;">

 <div class="prazni button1" style="word-wrap: break-word;width:590px;">
   @if(isset($porukenove))
 <center> <p>  <button id="{{$porukenove->first()->sender}}" name="{{$porukenove->first()->receiver}}" class="show_more" title="Učitaj sve poruke..."><a href="#">Učitaj još poruka..</a></button>  </p></center>

 @foreach($porukenove->reverse() as $poruka)

 <div id="{{$poruka->sender}}" style="word-wrap: break-word;">

 <div class='f-hr-light f-m-y-xsmall'></div>

 @if(Auth::user()->id == $poruka->sender)<b>{{$autormoj}}</b> @else <b>{{$autordrugi}}</b> @endif
 : <div style="word-wrap: break-word;">{!! htmlspecialchars_decode( (nl2br($poruka->text)) ) !!} </div> @if(isset($poruka->vreme)) {{$poruka->vreme}} @endif



 </div>
 @endforeach
 @else
 Kliknite na korisnika da pogledate konverzaciju sa njim.</br> Korisnici sa <span style="color: #10CC26">zelenom</span> bojom sadrže nepročitane poruke!
 @endif
  </div>


      <div id="tagmain"></div>

    </div>
    </div>

</div>

   <div>  @if(isset($porukenove))
    <div style="width:680px;margin-left:177px;" >
      <label for = "name">Unesi novi odgovor:</label>
    <textarea rows="3" cols="50" name="poruka" class = "form-control" id = "textbox" maxlength="455" placeholder = "Unesite odgovor..." ></textarea>

     <button class = "btn btn-default js-submit-btn f-button f-fw-bold primary">Pošalji odgovor!</button>

     <input type="hidden" name="_token" value="i2lGSj8p5IRvNnE9ewASdBzMJHJGDxp4qebIc50h">

    <input type="hidden" name="message" value="ejj">
     <input type="hidden" name="oglas" value="probamo">
      <input type="hidden" name="user_r" value="krivex">
       <input type="hidden" name="user_s" value="admin">
     </div>   <div style="margin-left:177px; font-size:12;">    Enter = slanje poruke&nbsp; |&nbsp; Shift+Enter = novi red     </div>   @endif

</div>

@if(isset($porukenove))
<script>
var token = $('meta[name="csrf-token"]').attr('content');
function scroll(){
    $('#josporuka').animate({
        scrollTop: $('#josporuka')[0].scrollHeight}, 0);
}

        $(document).on('click','.btn-default',function(){
         sendmessage();
                 $('#textbox').val('');
            $('#textbox').reset();
       });
  function sendmessage(){
      var receiver="";
    if('{{Auth::user()->id}}'===  '{{$porukenove->first()->receiver}}'   )    {


       receiver='{{$porukenove->first()->sender}}';
    }
    else {
          receiver='{{$porukenove->first()->receiver}}';
    }


            $button = $('div.prazni');
      $button.append("<div class='f-hr-light f-m-y-xsmall'></div>");
       $button.append( $('#textbox').val().replace(/\n/g, '<br />') );

       scroll();

        var token = $('meta[name="csrf-token"]').attr('content');

         $.ajax({
                    url     :  '{{URL::to('/')}}/users/odgovor/poruke',
                    type    : 'POST',
                    data: 'text='+ $('#textbox').val() + '&sender='+  '{{Auth::user()->id}}' + '&receiver=' + receiver + '&poruka_id=' + '{{$porukenove->first()->poruka_id}}'+ '&_token=' + token ,
                    success : function(resp){

                        /*    window.location.reload(true);                */
                    },
                    error   : function(resp){
            alert(JSON.stringify(resp));
             //   alert(resp);
                    }
                 });

  }

$('#textbox').keypress(function(e){
        if(e.which == 13 && !e.shiftKey){//Enter key pressed
        e.preventDefault();
        $('.btn-default').click();

        }

                if(e.which == 13 && e.shiftKey){//Enter key pressed
        e.preventDefault();
    $('#textbox').val(  $('#textbox').val()+ "\n"    );

        }
    });

</script>
@endif



</div>
</div>



 @endsection

@section('footer')
 @include('footer')
 @endsection