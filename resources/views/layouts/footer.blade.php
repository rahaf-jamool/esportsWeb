@php
$user = session()->has('loggedUser') ? session('loggedUser') : '';
@endphp
<footer>
    <div class="">
        <ul class="navbar-nav">
            <li class="nav-item ">
				<a class="nav-link" href="#" aria-expanded="false">
					{{trans('site.aboutunion')}}
				</a>
				<div class="item">
					<a class="" href="{{url(App::getLocale() . '/pages/1')}}">{{trans('site.AboutFederation')}}</a>
					<a class="" href="{{url(App::getLocale() . '/pages/5')}}">{{trans('site.OrganizationalChart')}}</a>
					<a class="" href="{{url(App::getLocale() . '/pages/4')}}">{{trans('site.currentboard')}}</a>
					<a class="" href="{{url(App::getLocale() . '/pages/2')}}">{{trans('site.presidentSpeech')}}</a>
					<a class="" href="{{url(App::getLocale() . '/pages/3')}}">{{trans('site.VisionMission')}}</a>
				</div>
			</li>


            @if (session()->has('loggedUser') === false)
            <li class="nav-item">
				<a class="nav-link" href="#" aria-expanded="false">
					{{trans('site.electronicservices')}}
				</a>
				<div class="item">
					<a class="" href="{{url(App::getLocale() . '/online-services')}}">{{trans('site.Certificateenrollment')}}</a>
					<a class="" href="{{url(App::getLocale() . '/online-services')}}">{{trans('site.Experiencecertificate')}}</a>
					<a class="" href="{{url(App::getLocale() . '/online-services')}}">{{trans('site.JoiningCertificate')}}</a>
					<a class="" href="{{url(App::getLocale() . '/online-services')}}">{{trans('site.Noobjectionletter')}}</a>
					<a class="" href="{{url(App::getLocale() . '/online-services')}}">{{trans('site.organizationrequest')}}</a>
				</div>
			</li>
            @elseif ($user['client']['type'] === 'Club'  || $user['client']['type'] === 'Academy')
            <li class="nav-item">
				<a class="nav-link" href="#" aria-expanded="false">
					{{trans('site.electronicservices')}}
				</a>
				<div class="item">
					<a class="" href="{{url(App::getLocale() . '/online-services')}}">{{trans('site.Noobjectionletter')}}</a>
					<a class="" href="{{url(App::getLocale() . '/online-services')}}">{{trans('site.organizationrequest')}}</a>
				</div>
			</li>
            @elseif($user['client']['type'] ==='WebSite-Follower')
            @else
            <li class="nav-item">
				<a class="nav-link" href="#" aria-expanded="false">
					{{trans('site.electronicservices')}}
				</a>
				<div class="item">
					<a class="" href="{{url(App::getLocale() . '/online-services')}}">{{trans('site.Certificateenrollment')}}</a>
					<a class="" href="{{url(App::getLocale() . '/online-services')}}">{{trans('site.Experiencecertificate')}}</a>
					<a class="" href="">{{trans('site.JoiningCertificate')}}</a>
				</div>
			</li>
            @endif










            <li class="nav-item">
				<a class="nav-link" href="#" aria-expanded="false">
					{{trans('site.Clubandacademies')}}
				</a>
				<div class="item">
					<a class="" href="{{url(App::getLocale() . '/clubs')}}">{{trans('site.clubs')}}</a>
					<a class="" href="{{url(App::getLocale() . '/academies')}}">{{trans('site.academies')}}</a>
				</div>
			</li>
            <li class="nav-item">
				<a class="nav-link" href="#" aria-expanded="false">
					{{trans('site.events')}}
				</a>
				<div class="item">
					<a class="" href="{{url(App::getLocale() . '/events/official')}}">{{trans('site.official')}}</a>
					<a class="" href="">{{trans('site.accredited')}}</a>
					<a class="" href="">{{trans('site.refresher')}}</a>
					<a class="" href="">{{trans('site.trainingcourses')}}</a>
					<a class="" href="">{{trans('site.community-activities')}}</a>
				</div>
			</li>
            <li class="nav-item">
                <a class="nav-link" href="#" aria-expanded="false">
                    {{trans('site.media-center')}}
                </a>
                <div class="item">
                    <a class="" href="{{url(App::getLocale() . '/news')}}">{{trans('site.news')}}</a>
                    <a class="" href="{{url(App::getLocale() . '/media/gallery')}}">{{trans('site.photo-album')}}</a>
                    <a class="" href="{{url(App::getLocale() . '/media/videos')}}">{{trans('site.video')}}</a>
                </div>
			</li>
        </ul>

                    {{-- <div class="links1">
                        <div><a href="{{url(App::getLocale() . '/')}}" class="active">{{trans('site.home')}}</a></a></div>
                        <div><a href="{{url(App::getLocale() . '/pages/brief-about-the-union')}}">{{trans('site.aboutunion')}}</a></div>
                        <div><a href="#" class="">{{trans('site.electronicservices')}}</a></div>
                        <div><a href="#" class="">{{trans('site.Referee')}}</a></div>
                        <div><a href="{{url(App::getLocale() . '/clubs')}}" class="">{{trans('site.clubs')}}</a></a></div>
                    </div>
                    <div>
                    <div class="links2">
                        <div><a href="">{{trans('site.nationalteams')}}</a></div>
                        <div><a href="">{{trans('site.events')}}</a></div>
                        <div><a href="">{{trans('site.players')}}</a></div>
                        <div><a href="">{{trans('site.media-center')}}</a></div>
                        <div><a href="{{url(App::getLocale() . '/login')}}">{{trans('all.login')}}</a></div>
                        <div><a href="{{url(App::getLocale() . '/contact')}}">{{trans('all.Contact Us')}}</a></div>
                        <div><a href="">{{trans('all.searchbtn')}}</a></div>
                    </div>
                    </div>
                    <div class="links1 links3">
                        <div><a href="{{url(App::getLocale() . '/')}}">{{trans('site.EESF')}}</a></div>
                        <div><a href="{{url(App::getLocale() . '/pages/about-us')}}">{{trans('site.about-us')}}</a></div>
                        <div><a href="#">{{trans('site.SiteMap')}}</a></div>
                    </div> --}}
        </div>
                <div class="privacy">
                <div class="container">
                    <ul class="privacy-link">
                        <li><a href="{{url(App::getLocale() . '/terms-service/15')}}">{{trans('site.terms-service')}}</a></li>
                        <li><a href="{{url(App::getLocale() . '/privacy-policy/14')}}">{{trans('site.privacy-policy')}}</a></li>
                    </ul>
                    <div class="social-media-privacy">
                        <a href="https://www.facebook.com/100081497842018/posts/197699032956690"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                        <a href="https://www.instagram.com/emiratesesport/"> <i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                        <a href="https://www.instagram.com/emiratesesport/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    </div>
                </div>
                </div>

                    <!-- <div class="privacy">
                        <ul class="">
                            <li><a href="{{url(App::getLocale() . '/pages/terms-service')}}">{{trans('site.terms-service')}}</a></li>
                            <li><a href="{{url(App::getLocale() . '/pages/privacy-policy')}}">{{trans('site.privacy-policy')}}</a></li>
                        </ul>
                        <div class="social-media-privacy">
                            <a href="">f</a>
                            <a href="">f</a>
                            <a href="">f</a>
                        </div>
                    </div> -->

                    <div class="copy-right">
                    <div class="container">
                        {{trans('site.emirates-federation-electronic-sports')}}
                    </div>
                    </div>

</footer>











{{-- <footer>
    <div class="links">
        <ul class="link-item1">
            <li><a href="{{url(App::getLocale() . '/')}}" class="active">{{trans('site.home')}}</a></li>
            <li><a href="{{url(App::getLocale() . '/pages/brief-about-the-union')}}">{{trans('site.about-union')}}</a></li>
            <li><a href="{{url(App::getLocale() . '/clubs')}}" class="">{{trans('site.clubs')}}</a></li>
            <li><a href="{{url(App::getLocale() . '/login')}}">{{trans('all.login')}}</a></li>
            <li><a href="{{url(App::getLocale() . '/pages/about-us')}}">{{trans('site.about-us')}}</a></li>
            <li><a href="{{url(App::getLocale() . '/contact')}}">{{trans('site.contact-us')}}</a></li>
        </ul>
    </div>
    <div class="privacy">
        <ul class="privacy-link">
            <li><a href="{{url(App::getLocale() . '/pages/terms-service')}}">{{trans('site.terms-service')}}</a></li>
            <li><a href="{{url(App::getLocale() . '/pages/privacy-policy')}}">{{trans('site.privacy-policy')}}</a></li>
        </ul>
        <div class="social-media-privacy">
            <img src="{{asset('assets/img/icons-01.png')}}" alt="">
        </div>
    </div>

    <div class="copy-right">
        {{trans('site.emirates-federation-electronic-sports')}}
    </div>
</footer>


--}}



{{-- <script src="//cdn.ckeditor.com/4.6.1/full/ckeditor.js"></script> --}}
  {{-- <script src="{{ asset('ckfinder/ckfinder.js') }}"></script> --}}
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
  <!-- Vendor JS Files -->
  <script src="{{asset('assets/js/jquery-3.4.1.js')}}" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"
    integrity="sha256-yt2kYMy0w8AbtF89WXb2P1rfjcP/HTHLT7097U8Y5b8=" crossorigin="anonymous"></script>
  {{-- <script src="{{asset('assets/js/lightslider.js')}}" ></script> --}}
  <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  {{-- <script src="{{asset('assets/js/dselect.js')}}"></script> --}}
  {{-- <script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script> --}}
{{-- Filter & sort magical layouts --}}
  {{-- <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script> --}}
    {{-- <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> --}}
    {{-- <script type="text/javascript" src="slick/slick.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>
    <script src="https://ckeditor.com/apps/ckfinder/3.5.0/ckfinder.js"></script> --}}
    <script src="//cdn.ckeditor.com/4.6.1/full/ckeditor.js" type="text/javascript"></script>
    <script src="{{ asset('js/ckfinder/ckfinder.js') }}"></script>
   {{-- <script src="{{ asset('assets/js/dom-to-image.js') }}"></script> --}}
   <script src="{{ asset('assets/js/html2canvas.js') }}"></script>
   {{-- <script src="{{ asset('assets/js/fabrik.js') }}"></script> --}}
   {{-- <script src="{{ asset('assets/js/app.js') }}"></script> --}}
     <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
{{--<script src="/libs/jsPDF-1.2.61/plugins/from_html.js"></script>--}}
  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>
  <script>
    $(function () { // this replaces document.ready
        setTimeout(function () {
            $('#preloader').fadeOut('slow', function () {
                $(this).remove();
            });
        }, 4000);
    });
        $(function () { // this replaces document.ready
        setTimeout(function () {
            $('#success-alert').fadeOut('slow', function () {
                $(this).remove();

            });
        }, 6000);

    });

</script>

<script>
    AOS.init({
            duration: 1200,
        });

    // $('#success').click(function{
    //     $('#success').hide();
    // });


   // $('#success-alert').click(function(event) {
    //    $('#success-alert').hide();

    //});


</script>
@stack('js')
</body>
</html>
