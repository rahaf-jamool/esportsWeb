@php
$user = session()->has('loggedUser') ? session('loggedUser') : '';
@endphp
@if (App::getLocale() == 'en')
    <style>
    @media (max-width: 1200px) {
        .form-inline form {
            margin-right: auto;
            margin-left: 0;
        }
    }
    </style>
@endif

<div class="container header">
    <nav class="navbar navbar-expand-xl fixed-top navbar-light custome">
        <h3 class="my-auto">
            <a class="navbar-brand" href="{{url(App::getLocale() . '/')}}">
                <img src="{{asset('assets/img/logo-01.png')}}" alt="logo"  style="width: 200px;" />
            </a>
        </h3>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse w-100 flex-md-column all-links" id="navbarCollapse">
            <ul class="navbar-nav ml-auto small mb-2 mb-md-1 w-100">
                <li class="nav-item text-left active">
                    <a class="nav-link "  href="{{url(App::getLocale() . '/')}}">{{trans('site.home')}}</a>
                </li>

                <li class="nav-item text-left">
                    <a class="nav-link " href="{{url(App::getLocale() . '/articles')}}">{{trans('site.articles')}}</a>
                </li>

                <li class="nav-item text-left">
                    <a class="nav-link " href="{{url(App::getLocale().'/contact')}}">{{trans('site.contact-us')}}</a>
                </li>
                @if (session()->has('loggedUser'))
                    <li class="nav-item text-left lan my-account">
                        <a class="nav-link " href="{{url(App::getLocale().'/myaccount')}}">{{trans('auth.my-account')}}</a>
                    </li>
                @endif
                @if (session()->has('loggedUser'))
                    <li class="nav-item text-left">
    {{--                    <i class="fa fa-lock" aria-hidden="true"></i>--}}
                        <a class="nav-link " href="{{url(App::getLocale().'/logout')}}" >{{trans('all.logout')}}</a>
                    </li>
                @else
                    <li class="nav-item text-left lan">
                        {{-- <i class="fa fa-lock" aria-hidden="true"></i> --}}
                        <a class="nav-link " href="{{url(App::getLocale().'/login')}}" >{{trans('all.login')}}</a>
                    </li>
                @endif

                <li class="nav-item text-left lang" style="margin: auto 10px;">
                    @if(App::getLocale()=='ar')
                        <a href="{{url(App::getLocale().'/change/en')}}">
                            <img style="width:45px;" src="{{asset('assets/img/british-flag.jpg')}}" alt="">
                        </a>
                    @else
                        <a href="{{url(App::getLocale().'/change/ar')}}">
                            <img style="width:45px;" src="{{asset('assets/img/flag-united-arab-emirates.png')}}" alt="">
                        </a>
                    @endif
                </li>


            </ul>

            <div class="form-inline ml-auto w-100 second-section">
                <ul class="navbar-nav small mb-2 mb-md-0 second-nav">
                    <li class="nav-item text-left dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            {{trans('site.aboutunion')}}
                        </a>
                        <div class="dropdown-menu p-0 m-0">
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/pages/1')}}">{{trans('site.AboutFederation')}}</a>
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/pages/5')}}">{{trans('site.OrganizationalChart')}}</a>
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/pages/4')}}">{{trans('site.currentboard')}}</a>
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/pages/2')}}">{{trans('site.presidentSpeech')}}</a>
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/pages/3')}}">{{trans('site.VisionMission')}}</a>
                        </div>
                    </li>
                    <li class="nav-item text-left">
                        <a class="nav-link " href="{{url(App::getLocale() . '/national-teams/games')}}">{{trans('site.nationalteams')}}</a>

                    </li>
                    <li class="nav-item text-left dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            {{trans('site.events')}}
                        </a>
                        <div class="dropdown-menu p-0 m-0">
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/events/3/official')}}">{{trans('site.official')}}</a>
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/events/4/accredited')}}">{{trans('site.accredited')}}</a>
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/events/5/refresher')}}">{{trans('site.refresher')}}</a>
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/events/6/trainingcourses')}}">{{trans('site.trainingcourses')}}</a>
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/events/7/community-activities')}}">{{trans('site.community-activities')}}</a>
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/events/calendar')}}">{{trans('site.Events-Calendar')}}</a>
                        </div>
                    </li>
                    <li class="nav-item text-left dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            {{trans('site.Clubandacademies')}}
                        </a>
                        <div class="dropdown-menu p-0 m-0">
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/clubs')}}">{{trans('site.clubs')}}</a>
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/academies')}}">{{trans('site.academies')}}</a>
                        </div>
                    </li>
                    {{--
                        @if (session()->has('loggedUser') === false)
                        <li class="nav-item text-left dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                {{trans('site.electronicservices')}}
                            </a>
                            <div class="dropdown-menu p-0 m-0">
                                <a class="dropdown-item" href="{{url(App::getLocale() . '/online-services')}}">{{trans('site.Certificateenrollment')}}</a>
                                <a class="dropdown-item" href="{{url(App::getLocale() . '/online-services')}}">{{trans('site.Experiencecertificate')}}</a>
                                <a class="dropdown-item" href="{{url(App::getLocale() . '/online-services')}}">{{trans('site.JoiningCertificate')}}</a>
                                <a class="dropdown-item" href="{{url(App::getLocale() . '/online-services')}}">{{trans('site.Noobjectionletter')}}</a>
                                <a class="dropdown-item" href="{{url(App::getLocale() . '/online-services')}}">{{trans('site.organizationrequest')}}</a>
                            </div>
                        </li>
                        @endif
                    --}}
                    @if (session()->has('loggedUser') === false)
                    <li class="nav-item text-left dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            {{trans('site.electronicservices')}}
                        </a>
                        <div class="dropdown-menu p-0 m-0">
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/online-services')}}">{{trans('site.Certificateenrollment')}}</a>
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/online-services')}}">{{trans('site.Experiencecertificate')}}</a>
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/online-services')}}">{{trans('site.JoiningCertificate')}}</a>
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/online-services')}}">{{trans('site.Noobjectionletter')}}</a>
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/online-services')}}">{{trans('site.organizationrequest')}}</a>
                        </div>
                    </li>
                    @elseif ($user['client']['type'] === 'Club'  || $user['client']['type'] === 'Academy')
                    <li class="nav-item text-left dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            {{trans('site.electronicservices')}}
                        </a>
                        <div class="dropdown-menu p-0 m-0">
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/online-services')}}">{{trans('site.Noobjectionletter')}}</a>
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/online-services')}}">{{trans('site.organizationrequest')}}</a>
                        </div>
                    </li>
                    @elseif($user['client']['type'] ==='WebSite-Follower')
                    @else
                    <li class="nav-item text-left dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            {{trans('site.electronicservices')}}
                        </a>
                        <div class="dropdown-menu p-0 m-0">
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/online-services')}}">{{trans('site.Certificateenrollment')}}</a>
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/online-services')}}">{{trans('site.Experiencecertificate')}}</a>
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/online-services')}}">{{trans('site.JoiningCertificate')}}</a>
                        </div>
                    </li>
                    @endif


                    @if (session()->has('loggedUser') === false)
                    <li class="nav-item text-left dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        {{trans('site.create-account')}}
                        </a>
                        <div class="dropdown-menu p-0 m-0">
                        <a class="dropdown-item" href="{{url(App::getLocale() . '/register/follower')}}">{{trans('site.follower')}}</a>
                        <a class="dropdown-item" href="{{url(App::getLocale() . '/register/player')}}">{{trans('site.player')}}</a>
                        <a class="dropdown-item" href="{{url(App::getLocale() . '/register/coach')}}">{{trans('site.coach-administrator')}}</a>
                     {{--   <a class="dropdown-item" href="{{url(App::getLocale() . '/register/judgment')}}">{{trans('site.judgment')}}</a>--}}
                        <a class="dropdown-item" href="{{url(App::getLocale() . '/register/club')}}">{{trans('site.Club')}}</a>
                        <a class="dropdown-item" href="{{url(App::getLocale() . '/register/academy')}}">{{trans('site.Academy')}}</a>
                        <a class="dropdown-item" href="{{url(App::getLocale() . '/register/sport-services-company')}}">{{trans('site.SportsServicesCompany')}}</a>
                        <a class="dropdown-item" href="{{url(App::getLocale() . '/register/commentator')}}">{{trans('individually.commentator')}}</a>
                        <a class="dropdown-item" href="{{url(App::getLocale() . '/register/content-writer')}}">{{trans('individually.content-writer')}}</a>
                    </div>
                    </li>
                    @endif


                    <li class="nav-item text-left dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            {{trans('site.media-center')}}
                        </a>
                        <div class="dropdown-menu p-0 m-0">
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/news')}}">{{trans('site.news')}}</a>
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/media/gallery')}}">{{trans('site.photo-album')}}</a>
                            <a class="dropdown-item" href="{{url(App::getLocale() . '/media/videos')}}">{{trans('site.video')}}</a>
                        </div>
                    </li>
                </ul>
                <form>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-append">
                            <button class="btn" type="button">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </nav>
</div>
