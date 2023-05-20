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
        border: 4px solid #000;
        padding: 10px;
        /* width: 50%; */
        height: fit-content;
        margin: auto;
        position: relative;
    }
    section .backgroudImg{
        position: absolute;
        transform: translate(-50%, -50%);
        top: 50%;
        left: 50%;
        z-index: -1;
    }
    section .certifcation {
        border: 2px solid #000;
        padding: 20px;
        text-align: center;
        /* position: absolute; */
        margin: auto;
        width: calc(100% - 50px);
        background-color: #ffffffe0;
    }
    section .certifcation .logo {
        margin-bottom: 50px;
    }
    section .certifcation .logo img{
        max-width: 600px;
    }
    section .certifcation .title {
        margin-bottom: 50px;
    }
    section .certifcation .decs {
        padding: 5px 30px;
    }
    section .certifcation .decs p{
        font-size :25px;
    }
    section .certifcation .Signature {
        font-size: 20px;
        text-align: left;
        margin: 30px 30px 90px;
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
            section .certifcation .decs {
                direction: rtl;
        }
        </style>
    @else
    <style>
        section .certifcation .decs {
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


<section  id='certifcation-print'>
    <img src="{{asset('assets/img/logo1.png')}}" alt="logo" class="backgroudImg" />

    <div class="certifcation">
        <div class="logo">
            <img src="{{asset('assets/img/Logo.png')}}" alt="logo"/>
        </div>
        <div class="title">
            <h2>{{ trans('site.Membershipcertificate') }}</h2>
        </div>
        <div class="decs">
            <p> {{ trans('site.TheUAEElectronicSportsFederationcertifiesthatthe') }}   {{ trans("site." . $user['client']['type']) }} {{$user['client']['name']}}</p>
            <p>{{ trans('site.Ofthemembersoftheunionfromthedate') }} {{ \Carbon\Carbon::parse($user['joinDate'])->format('d/m/Y')}}</p>
            {{-- <p>{{ trans('site.Todate') }}  {{ (!empty($user['personInfo']['membershipEndDate']))? \Carbon\Carbon::parse($user['personInfo']['membershipEndDate'])->format('d/m/Y'):  \Carbon\Carbon::now()->format('d/m/Y')}}</p> --}}
            <p>{{ trans('site.Todate') }} {{ \Carbon\Carbon::parse($user['membershipEndDate'])->format('d/m/Y')}}</p>
        </div>
            <div class="Signature">
                <div class="name" >
                    <p>{{ trans('site.PresidentoftheSportsunion') }} </p>
                    <p style="margin: 30px 45px;">{{ trans('site.Signature') }}</p>
                </div>
            </div>
    </div>
</section>
<input type='button' id='btn' value='{{ trans("site.Print") }}'>
</body>
<script>
      $(document).ready(function() {
        $("#btn").click(function () {
            //$("#certifcation-print").printThis();
          //  $("#certifcation-print").show();
            $("#certifcation-print").print();
        });
      });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script type="text/JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.js"></script>

</html>
