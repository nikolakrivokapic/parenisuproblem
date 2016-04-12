<div  style="margin-left:25px;margin-right:25px;margin-bottom:3px;">
@if(!Auth::check())
<div class='f-p-t-medium'>
<div class='f-grid-row f-p-b-medium f-m-t-large f-m-b-large'>
<div class='f-grid-6of12'>
<h4>Uključite se u konverzaciju</h4>
<p class='f-fs-medium f-fw-normal f-font-condensed f-p-t-xsmall f-fc-dark lh-small'>
Ulogujte se sa svojim Facebook nalogom ili putem
<a class='f-fc-swatchone f-clickable js-signin-with-email' onclick="show('signin1')" >email-a.</a>
</p>
</div>
<div class='f-grid-6of12 f-tr f-font-condensed'>
<a href="{{URL::to('/')}}/auth/social/facebook">
<div class='f-button facebook1 ' >Prijavi se preko FACEBOOK-a</div>   </a>
</div>
</div>
</div>


@else


<form action="{{URL::to('/')}}/komentar/novi/{{$project->slug}}" method="post">
<div class="f-p-t-medium">
<div class="js-post-comment f-grid-row" data-target=".js-home-tab-feed-list">
<div class="f-grid-2of12 f-tl">
<div class="f-avatar-small f-fl fb" style="background-image: url({{Auth::user()->slika}});"></div>
</div>
<div class="f-grid-10of12 f-bg-xlight-o-light f-b-light f-br-xsmall f-p-small">
<h5 class="f-m-b-xsmall">{{Auth::user()->fullname}}</h5>
<div class="cb-input-comment f-m-b-small">
<textarea class="f-font-condensed f-fs-large f-fw-normal" maxlength="140" name="text" placeholder="Unesite komentar"></textarea>
</div>
<label class="f-fr f-fs-small f-font-condensed f-flex-center-y">

 <input type="hidden" name="_token" value="{!! csrf_token() !!}">


</label>
<button class="js-submit-btn f-button f-fw-bold primary" data-commentable-id="ozasriim" data-ctype="activities" type="submit">
DODAJ KOMENTAR
</button>
<div class="js-loader f-ilb f-m-l-small" style="display:none">
<div class="f-spinner-circles f-bg-light f-fs-small"></div>
</div>
</div>
</div>

</div>
  </form>
  @endif
  </div>


<div class="divkomentari">
@foreach($komentari as $komentar)
<div class="js-comment-item f-grid-row f-p-b-large f-b-t f-b-xlight f-p-t-large komentar{{$komentar->id}}" data-comment-id="416428" style="margin-left:25px;margin-right:25px;">
<div class="f-grid-2of12 f-tl">
<a class="f-avatar-small f-fl fb" data-background-image="{{$komentar->slika}}?width=60&amp;height=60" data-scrollspy="0" href="/users/891647" style="background-image: url(&quot;{{$komentar->slika}}?width=60&amp;height=60&quot;);"></a>
</div>
<div class="f-grid-10of12 f-bg-white">
<h5 class="f-ilb">
<a class="f-fc-swatchone" href="{{URL::to('/')}}/users/{{$komentar->user}}">{{$komentar->user}}</a>
<span class="f-fc-dark f-fw-normal f-fc-dark">je komentarisao/la:</span>
</h5>
<div class="f-ilb f-fr f-fs-small f-fw-normal f-font-condensed f-fc-light f-lh-large" style="float:right;">
<div >{{$komentar->vreme}}  </div>
 @if( Auth::check() && Auth::user()->fullname == $project->objavio) <div style="float:right;"> <a title="Izbriši?" onclick="izbrisikoment('{{$komentar->id}}')"> <i class='js-dismiss fa fa-times f-fc-dark' style="cursor:pointer;margin-right:0px;" ></i> </a> </div>        @endif
</div>
<div class="comment f-font-condensed f-fs-large f-fw-medium f-m-t-xsmall f-of-hidden f-lh-small">
{{$komentar->text}}
</div>
<div class="f-grid-row f-m-t-medium f-fs-small">
<div class="f-grid-6of12">
</div>
<div class="f-grid-6of12 f-tr">
</div>
</div>
</div>
</div>
  @endforeach
  </div>
  @if($komentari->count() > 11)
   <div style="text-align:center;margin-bottom:20px;">

        <button class="js-update f-button primary" onclick="joskomentara('{{$project->slug}}','divkomentari','margin-left:17px;margin-right:13px;margin-top:10px;')" style="width:100%;">Učitaj još komentara... </button>    </div>
                                   {{--  str_replace('/?', '?',$komentari->fragment('comments')->render()) --}}
                                             @endif


