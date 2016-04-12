
<div>
<div class='f-grid-row f-flex'>
<div class='f-grid-8of12 f-p-xlarge f-b-light f-b-r f-flex-self-stretch'>

@foreach($updates as $update)
<div class='js-blog-post-container' >
<div class='js-blog-post bp-post f-grid-row f-m-b-large f-p-t-large f-b-xlight f-b-t' discussion_id='42697' id='updates/blog/update_16-42697'>
<div class='f-grid-2of12 f-tl' >
<a class='f-avatar-small f-fl fb' data-background-image='{{$update->avatar}}?s=60' data-scrollspy='0' href='{{URL::to('/')}}/users/{{$update->user_id}}'></a>
</div>
<div class='f-grid-10of12 f-bg-white'  id="{{$update->id}}">
<h5 class='f-ilb' >
<a class='f-fc-swatchone' href='{{URL::to('/')}}/users/{{$update->user_id}}'>
{{$project->objavio}}
</a>
<span class='f-fc-medium f-fw-normal f-fc-dark'>je ažurirao:</span>
</h5>
<span class='f-ilb f-fr f-lh-large f-fw-normal f-font-condensed f-fc-light f-fs-small' >
{{$update->datum}}
</span>
<h3 class='f-fc-black' >{{$update->naslov}}</h3>
@if($update->slika)
<div class='f-m-t-small f-bg-center' data-scrollspy='0' style='background-image:url("{{$update->slika}}");height: 313px; background-size: contain; background-repeat: no-repeat;'></div>      @endif
<div class='f-fs-large f-fw-normal f-lh-small f-m-t-large f-m-b-xsmall' >

<div class='f-content-section' style="word-wrap: break-word;">

<p>{!! htmlspecialchars_decode( (nl2br($update->update)) ) !!}     </p>


</div>
</div>
<div class='f-width-100 f-bg-xlight-o-medium f-fs-small f-font-condensed'></div>
<!--<div class='f-grid-row f-m-t-medium f-fs-small'>
<div class='f-grid-6of12'>
<a class='js-blog-like like-item f-clickable f-b-medium f-br-small f-p-xsmall f-ilb f-bg-hover-xlight' data-endpoint='discussions' data-item-id='42697'><i class='fa fa-fw fa-heart f-fc-primary color' style='margin-right:2px'></i><span>0</span>
</a>
<a cb_commentable_id='42697' class='f-m-l-xsmall f-clickable f-b-medium f-br-small f-p-xsmall f-ilb f-bg-hover-xlight' href='#updates/blog/update_16-42697'><i class='fa fa-fw fa-comments f-fc-xdark' style='margin-right:2px'></i><span class='js-blog-comment-count' data-id='42697'>0</span>
</a>
</div>
<div class='f-grid-6of12 f-tr'>
</div>
</div>-->
</div>
</div>




<div class="f-m-b-large f-grid-row">
<div class="f-grid-10of12 f-grid-2of12-offset">



@if(Auth::check())
<form action="{{URL::to('/')}}/komentar_objava/novi/{{$update->id}}" method="post">
<div class="f-b-xlight f-b-t f-p-t-medium">
<div class="js-post-comment f-grid-row" data-target=".js-blog-comments-list-39724">
<div class="f-grid-2of12 f-tl">
<div class="f-avatar-small f-fl fb" style="background-image: url({{Auth::user()->slika}});"></div>
</div>
<div class="f-grid-10of12 f-bg-xlight-o-light f-b-light f-br-xsmall f-p-small">
<h5 class="f-m-b-xsmall">{{Auth::user()->fullname}}</h5>
<div class="cb-input-comment f-m-b-small">
<textarea class="f-font-condensed f-fs-large f-fw-normal" name="text" maxlength="140" placeholder="Unesite Komentar..."></textarea>
</div>
 <input type="hidden" name="_token" value="{!! csrf_token() !!}">
  <input type="hidden" name="slug" value="{{$project->slug}}">
   <input type="hidden" name="update_id" value="{{$update->id}}">
<button class="js-submit-btn f-button f-fw-bold primary" data-commentable-id="39724" data-ctype="discussions">
Dodaj Komentar
</button>
<div class="js-loader f-ilb f-m-l-small" style="display:none">
<div class="f-spinner-circles f-bg-light f-fs-small"></div>
</div>
</div>
</div>
</div>
</form>
@else
<div class="f-grid-row f-p-b-medium f-m-t-large f-m-b-large">
<div class="f-grid-6of12">
<h4>Uključite se u konverzaciju</h4>
<p class="f-fs-medium f-fw-normal f-font-condensed f-p-t-xsmall f-fc-dark lh-small">
Ulogujte se sa Facebook Nalogom ili vašim
<a class="f-fc-swatchone f-clickable js-signin-with-email" onclick="show('signin1')" >emailom.</a>
</p>
</div>
<div class="f-grid-6of12 f-tr f-font-condensed">  <a href="{{URL::to('/')}}/auth/social/facebook">
<div class="f-button facebook1 ">Uloguj se preko Facebook-a</div> </a>
</div>
</div>
 @endif

@foreach($update->komentariobjava as $komentar_objava)


<div class="js-blog-comments-list-39724">
<div class="js-comment-item f-grid-row f-p-b-large f-b-t f-b-xlight f-p-t-large" data-comment-id="411061">
<div class="f-grid-2of12 f-tl">
<a class="f-avatar-small f-fl fb" data-background-image="{{$komentar_objava->slika}}?width=60&amp;height=60" data-scrollspy="0" href="{{URL::to('/')}}/users/{{$komentar_objava->user}}" style="background-image: url(&quot;{{$komentar_objava->slika}}?width=60&amp;height=60&quot;);"></a>
</div>
<div class="f-grid-10of12 f-bg-white">
<h5 class="f-ilb">
<a class="f-fc-swatchone" href="/users/1288815">{{$komentar_objava->user}}</a>
<span class="f-fc-dark f-fw-normal">je komentarisao</span>
<span class="f-fc-dark f-fw-normal">na ovoj objavi:</span>
</h5>
<span class="f-ilb f-fr f-fs-small f-fw-normal f-font-condensed f-fc-light f-lh-large">
{{$komentar_objava->vreme}}
</span>
<div class="comment f-font-condensed f-fs-large f-fw-medium f-m-t-xsmall f-of-hidden f-lh-small">
{{$komentar_objava->text }}

</div>
<div class="f-grid-row f-m-t-medium f-fs-small">
<div class="f-grid-6of12">
</div>
<div class="f-grid-6of12 f-tr">
</div>
</div>
</div>
</div>

</div>

@endforeach











</div>
</div>




</div>







        @endforeach











  </div>



<div class='f-grid-4of12' >
<div class='f-p-xlarge' style ="padding-top: 58px;">
<h3 class='f-fc-black f-m-b-small'>Sva Ažuriranja</h3>

<ul class='f-list no-padding f-b-xlight js-blog-post-listing' style="border-color:#FFFFFF;">

@foreach($updates as $update)

<li discussion_id='42697'>
<div class='f-grid-row f-font-condensed f-bg-xlight'>

<div class='f-grid-10of12'>
<a class='f-db f-bg-white f-bg-xlight-hover f-p-xsmall' href='#{{$update->id}}' style="min-height: 60px;">
<h5>{{$update->naslov}}</h5>
<p cb_commentable_id='42697' class='f-fc-medium'>
<b class='js-blog-comment-count' data-id='42697'>{{$update->komentariobjava()->count()}}</b>
komentara
</p>
</a>
</div>
</div>
</li>
 @endforeach


</ul>

</div>
</div>
</div>

</div>
