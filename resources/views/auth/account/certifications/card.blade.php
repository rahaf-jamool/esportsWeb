<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" dir="{{ trans('all.dir')}}">
<head>
    <link rel="icon" href="{{asset('assets/img/logo1.png')}}" >
<style>
    @import url("https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800&display=swap");

    body {
        font-family: "Tajawal", "sans-serif" !important;
        overflow-x: hidden;
    }
    section {
        width: 450px;
        height: 275px;
        margin: auto;
    }
    section .cart-content {
        position: absolute;
        width: 100%;
        top: 100px;
    }


    #btn {
        position: absolute;
        right: 50px;
        bottom: 75px;
        background-color: red;
        color: #fff;
        padding: 15px 30px;
        border: navajowhite;
        cursor: pointer;
    }

</style>
@if(trans('all.dir') == 'rtl')
        <style>
            .cart-content{
                direction: rtl;
        }
        </style>
    @else
    <style>
        .cart-content {
            direction: ltr;
    }
    </style>
    @endif
<script
  src="https://code.jquery.com/jquery-3.6.3.min.js"
  integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
  crossorigin="anonymous"></script>
  </head>

<body>
{{--   dd($user['client']['type'])   --}}

<section  id='card-print'>

    <div class="row">
        <div class="col-12 col-md-4">
            <aside id="column-right">
                <div class="swiper-viewport mb-3">
                    <div id="banner0" class="swiper-container swiper-container-horizontal swiper-container-fade">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide swiper-slide-active position-relative"
                                style="opacity: 1; transform: translate3d(0px, 0px, 0px);">
                                <img src="{{ asset('assets/img/Mumbership-ID1.png') }}" alt="Account"
                                    class="img-responsive" style="width: 100%;">
                                <div class="cart-content print-cart-js">
                                    <div class="row w-100 h-100 align-items-center mx-auto" style="display: flex; margin-top: 15px;">
                                        <div class="col-4">
                                            {{--<img class="img-fluid" id="card_image" style="width: 100px; margin: 30px 20px"
                                                src="{{ asset('SD08/default-user-image.png') }}" alt="">--}}
                                                @if($user['client']['type'] == 'Club' || $user['client']['type'] == 'Academy')
                                                    <img class="responsive" src="{{ config('app.base_address') . $user['orgnizationInfo']['imagePath']}}"  style="width: 100px; margin: 30px 20px" alt="logo"
                                                    onerror="this.onerror=null;this.src='{{asset('SD08/default-user-image.png')}}';" style="width: 100px; margin: 30px 20px">
                                                @else
                                                    <img class="responsive" src="{{ config('app.base_address') . $user['personInfo']['imagePath']}}"  style="width: 100px; margin: 30px 20px" alt="logo"
                                                    onerror="this.onerror=null;this.src='{{asset('SD08/default-user-image.png')}}';" style="width: 100px; margin: 30px 20px">
                                                @endif
                                                
                                                  
                                        </div>
                                        <div class="col-8 pl-0">
                                            <div class="cart-content-info">
                                                <ul class="list-unstyled">
                                                    <li>{{trans('auth.name')}} : <span id="card_firstName">{{ !is_null($user['name'])?$user['name']:''}}</span>
                                                    </li>



                                                    @if($user['client']['type'] == 'Club' || $user['client']['type'] == 'Academy')

                                                    <li>{{trans('auth.account-type')}} : <span>{{ !is_null($user['client']['type'])? trans("auth." . $user['client']['type']) :''}}</span></li>
                                                    <li>{{trans('individually.emirates-number')}} : <span>{{ !is_null($user['orgnizationInfo']['membershipNumber'])?$user['orgnizationInfo']['membershipNumber']:''}}</span></li>
                                                    <li>{{trans('individually.emirates-expiry-date')}} : <span>
                                                        {{ !is_null(\Carbon\Carbon::parse($user['membershipEndDate'] )->format('d/m/Y'))?\Carbon\Carbon::parse($user['membershipEndDate'] )->format('d/m/Y'):''}}</span>
                                                    </li>
                                                    @else
                                                    <li>{{trans('individually.date-birth')}} : <span>
                                                            {{ !is_null(\Carbon\Carbon::parse($user['personInfo']['birthDate'] )->format('d/m/Y'))?\Carbon\Carbon::parse($user['personInfo']['birthDate'] )->format('d/m/Y'):''}}
                                                            </span>
                                                    </li>
                                                    <li>{{trans('auth.account-type')}} : <span>{{ !is_null($user['client']['type'])? trans("auth." . $user['client']['type']) :''}}</span></li>
                                                    <li>{{trans('individually.nationality')}} : <span>{{ !is_null($user['personInfo']['nationalityName'])?$user['personInfo']['nationalityName']:''}}</span></li>
                                                    <li>{{trans('individually.emirates-number')}} : <span>{{ !is_null($user['personInfo']['membershipNumber'])?$user['personInfo']['membershipNumber']:''}}</span></li>
                                                    <li>{{trans('individually.emirates-expiry-date')}} : <span>
                                                        {{ !is_null(\Carbon\Carbon::parse($user['personInfo']['membershipEndDate'] )->format('d/m/Y'))?\Carbon\Carbon::parse($user['personInfo']['membershipEndDate'] )->format('d/m/Y'):''}}</span>
                                                    </li>
                                                    @endif



                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </aside>
        </div>
    </div>

</section>
<input type='button' id='btn' value='{{ trans("site.Print") }}'>
</body>
<script>
      $(document).ready(function() {
        $("#btn").click(function () {
            //$("#card-print").printThis();
          //  $("#card-print").show();
            $("#card-print").print();
        });
      });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script type="text/JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.js"></script>

</html>
