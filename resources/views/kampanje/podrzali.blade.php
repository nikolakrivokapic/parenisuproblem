
<script>
var skip;
$( document ).ready(function() {
    skippodrzalih=80;
});
      function jospodrzalih(slug,style) {



      var token = $('meta[name="csrf-token"]').attr('content');





$.ajax({
    type: "POST",

    data: '_token=' + token + "&slug=" + slug + "&skip=" + skippodrzalih,
    url: "{{URL::to('/')}}/podrska/jospodrzalih",
    success: function(msg){


$.each(msg, function(i,item) {

if(item.slika=="")  {
    item.slika= "{{URL::to('/')}}/assets/044fd3a47a31f2606080275edf070028.png?s=60";
}
var large = '<a class="js-list-item f-grid-row f-m-b-medium f-db zahov" href="{{URL::to("/")}}/users/'+item.ime_suportera+'" target="_top" style="height:56px;"><div class="f-grid-1of12 f-height-100"></div><div class="f-grid-3of12"><div class="f-avatar-small" data-background-image="'+item.slika+'" data-scrollspy="0" style="background-image: url(&quot;'+item.slika+'&quot;)"></div>   </div><div class="f-grid-8of12 f-p-l-xsmall f-font-condensed"> <div class="f-grid-row">  <h5 class="f-text-truncate">'+item.ime_suportera+'</h5> <div class="f-fw-normal f-fc-black f-m-t-xsmall"><span class="f-fc-light">'+item.grad+'</span></div></div></div> </a> ';

         $( ".jospodrzalih").append( large);

                });

              skippodrzalih=skippodrzalih+50;




    },
            error   : function(resp){
            alert(JSON.stringify(resp));
             //   alert(resp);
                    }
});



          }
</script>


  <div class="js-supporters-tab" style="padding-top:5px;">


  <div class="js-tab-nav f-p-medium f-b-xlight f-b-b" data-selected="light" data-unselected="white">
<div class="f-grid-row f-flex-center-y">
<div class="f-grid-9of12">
<div class="f-content-spacing-xsmall">
<div class="f-fl">
<span class="f-button f-fs-small light" >
Podržali
<i class="f-badge inline f-bg-dark">{{$podrska->count()}}</i>
</span>
</div>

</div>
</div>
<div class="f-grid-3of12">
<div class="js-search f-fr f-input-decorator f-pos-rel">
<input class="f-font-condensed" placeholder="Traži" type="search">
<div class="f-decorator f-bg-xlight">
<i class="fa fa-search"></i>
</div>
<a class="js-clear-search f-pos-abs f-hide white" style="top: 8px; right: 40px">
<i class="fa fa-times-circle fa-lg f-fc-medium f-fc-hover-black f-clickable"></i>
</a>
</div>
</div>
</div>
</div>


<div class="f-m-b-large f-spaced-grid-3-medium f-width-100 js-list js-participants-list jospodrzalih" style="padding-top:30px;">

 @foreach($podrska as $podrzao)
<a class="js-list-item f-grid-row f-m-b-medium f-db zahov" href="{{URL::to('/')}}/users/{{$podrzao->ime_suportera}}" target="_top" style="height:56px;">
<div class="f-grid-1of12 f-height-100"></div>
<div class="f-grid-3of12">
@if($podrzao->slika=="")
<div class="f-avatar-small" data-background-image="{{URL::to('/')}}/assets/044fd3a47a31f2606080275edf070028.png?s=60" data-scrollspy="0" style="background-image: url(&quot;{{URL::to('/')}}/assets/044fd3a47a31f2606080275edf070028.png?s=60&quot;);"></div>
@else
<div class="f-avatar-small" data-background-image="{{$podrzao->slika}}" data-scrollspy="0" style="background-image: url('{{$podrzao->slika}}');"></div>
@endif
</div>
<div class="f-grid-8of12 f-p-l-xsmall f-font-condensed">
<div class="f-grid-row">
<h5 class="f-text-truncate">{{$podrzao->ime_suportera}}</h5>
<div class="f-fw-normal f-fc-black f-m-t-xsmall"><span class="f-fc-light">{{$podrzao->grad}}</span></div>
</div>
</div>
</a>

   @endforeach

</div>


<div class='js-spinner f-tc f-width-100'>
<div class='f-ilb f-fs-large f-m-t-xlarge'>

</div>
</div>
<div style="text-align:center;margin-bottom:20px;">

        <button class="js-update f-button primary" onclick="jospodrzalih('{{$project->slug}}')" style="width:100%;">Učitaj još... </button>    </div>

</div>
