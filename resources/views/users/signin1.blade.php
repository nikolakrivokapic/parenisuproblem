<div id='signin1' class="popup-instance f-style-guide" style="display:none;"><div class="f-fs-medium f-popup f-z-popup" style="height: 3581px;">
  <div class="f-bg-black f-opacity-medium f-popup-overlay" style="height: 3581px;"></div>
  <div class="f-anim-fadeinup-fast f-bg-xlight f-br-medium f-fc-xdark f-popup-container f-pos-rel f-tl" style="width: 490px; position: fixed; margin-left: -245px;margin-top: -142px; top: 50%; left: 50%; height: 285px;">
    <i class="f-align-tr f-clickable f-fc-hover-dark f-fc-medium f-fs-xlarge f-m-medium f-popup-close fa fa-times" style="z-index: 100;" onclick="hide('signin1')"></i>
    <div class="f-p-medium f-tl" style="height:60px;">
  <h3 class="f-fc-black f-lh-small">Uloguj se</h3>
</div>
<div class="f-hr"></div>


<div class="f-grid-row f-p-large f-tl">

  <div class="f-grid-7of12 f-p-r-medium f-pos-rel" style="margin-top:0px;">
    <p class="f-fc-xdark f-font-condensed f-fw-medium f-m-b-small">Ako ste registrovani putem email-a:</p>
    <div class="f-input-decorator">
      <div class="f-bg-xlight f-decorator">
        <i class="f-fc-medium fa fa-envelope fa-fw"></i>
      </div>

      <form method="POST" action="{{ URL::to("/")}}/auth/login">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input class="f-font-condensed" type="text" name="email" placeholder="Email">
    </div>
    <div class="f-input-decorator f-m-t-xsmall">
      <div class="f-bg-xlight f-decorator">
        <i class="f-fc-medium fa fa-fw fa-lock"></i>
      </div>
      <input class="f-font-condensed" type="password" name="password" placeholder="Šifra">
    </div>



    <div class="f-grid-row f-m-t-small">
      <div class="f-flex-center-y f-grid-7of12">

   <button class="f-button f-flex-align-left f-fw-bold js-submit primary" type="submit">Uloguj se</button>
        <div class="f-m-l-small js-loader" style="display:none">
          <div class="f-bg-light f-fs-small f-spinner-circles"></div>
        </div>
      </div>

      </form>


      <div class="f-grid-5of12 f-p-t-xsmall f-tr">
        <a class="f-fc-dark f-font-condensed f-fs-small" href="{{ URL::to("/")}}/auth/reminder">Zaboravljena šifra?</a>
      </div>
    </div>
  </div>
  <div class="f-b-l f-b-light f-grid-5of12 f-p-l-medium">
    <p class="f-fc-xdark f-font-condensed f-fw-medium f-m-b-small">Prijava putem socijalnih mreža:</p>
     <a href="{{ URL::to("/")}}/auth/social/facebook"
>   <div class="f-button f-fw-bold f-m-b-xsmall f-m-r-small facebook1">Facebook</div> </a>

    <div class="f-fs-small f-m-t-xsmall">

      <a class="f-fc-dark f-font-condensed" href="{{ URL::to("/")}}/auth/social/google"><img src="https://developers.google.com/+/images/branding/sign-in-buttons/Red-signin_Google_base_44dp.png" width="99px" height=35px style="margin-left:-2px;" alt="">        </a>
    </div>
  </div>
</div>
  </div>
</div></div>