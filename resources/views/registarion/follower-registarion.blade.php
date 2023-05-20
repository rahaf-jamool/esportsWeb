@php
    $rtl = App::getLocale() == 'ar' ? 'rtl' : 'ltr';
    $floatRight = App::getLocale() == 'en' ? 'float:right;' : 'float:left;';
@endphp
@extends('layouts.master')
@section('keywords' , config('app.keywords'))
@section('og-url' , url(Request::url()))
@section('container' , 'container-fluid-custom')
@section('page-style', asset('assets/css/electronic-services.css'))

@section('content')
<style>
    /* body {
  margin: 0;
  font-family: sans-serif;
}
 */
.clubRegistration .tabs {
  width: 100%;
}

.clubRegistration .tab-nav {
  display: flex;
  background: #f0f0f0;
}

.clubRegistration .nav-item {
  display: block;
  padding: 16px;
  cursor: pointer;
}
.clubRegistration .nav-item.selected {
    background: red;
    color: #fff;
}

.clubRegistration .tab {
  display: none;
  padding: 16px;
}
.clubRegistration .tab.selected {
  display: block;
}

.clubRegistration .tab-pag {
  padding: 0 16px;
  display: flex;
  justify-content: flex-end;
}

.clubRegistration .pag-item {
  display: block;
  padding: 12px;
  cursor: pointer;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-right: 8px;
}
.clubRegistration .pag-item:last-child {
  margin-right: 0;
}
.clubRegistration .pag-item.hidden {
  display: none;
}

.clubRegistration .pag-item-submit {
  flex: 0 1 180px;
  font-size: 1rem;
  color: #fff;
  background: #2fb44b;
}
.clubRegistration form span{
    color:#000;
}
.clubRegistration legend{
    font-size:1rem;
}
</style>

    <div class="container clubRegistration">
        <div class="row pb-5">
            <h1> {!! trans('individually.register-Follower-account') !!}</h1>
            <p>{!! trans('institutions.Ifyouhaveaccount') !!}<a class="login" href="{{ url(App::getLocale() . '/login') }}">{!! trans('institutions.loginpage') !!}</a>.</p>

                <div class="col-12">
                @include('layouts.message')
                <form class="form-horizontal" role="form" method="POST"
                      action="{{ url(App::getLocale() . '/register') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="account-type" value="WebSite-Follower">

                    <h4>{!! trans('individually.follower-data') !!}</h4>
                    <hr>
                    <div class="tabs" id="tabbedForm">
                        <nav class="tab-nav"></nav>
                        <div class="tab" data-name="{{trans('individually.General')}}">
                            <div class="d-flex flex-wrap col-12 col-md-6">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} w-100">
                                    <span class="asterisks">*</span><label for="firstName" class="col-11 control-label  pb-2 pt-2">{{trans('individually.name')}}</label>
                                    <div class="col-12">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab" data-name="{{trans('individually.Person-Info')}}">
                            <div class="d-flex flex-wrap">
                                <div class="form-group{{ $errors->has('uaeResidency') ? ' has-error' : '' }} col-12 col-md-6">
                                    <span class="asterisks">*</span><label for="state" class="col-11 control-label pb-2 pt-2">{{trans('individually.residence')}}</label>
                                    <div class="col-sm-12 col-lg-9 radio-btn">
                                        <label class="radio-inline">
                                            <input type="radio" name="uaeResidency" value="true" style="" checked="checked">{{trans('individually.inside-state')}}
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="uaeResidency" value="false">{{trans('individually.out-country')}}
                                        </label>
                                        @if ($errors->has('uaeResidency'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('uaeResidency') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group residence-only {{ $errors->has('princedomId') ? ' has-error' : '' }} col-12 col-md-6" id="princedom">
                                    <span class="asterisks">*</span><label for="princedomId" class="col-11 control-label pb-2 pt-2">{{trans('institutions.princedoms')}}</label>
                                    <div class="col-12">
                                        <select name="princedomId" class="form-control jcf-reset-appearance input-player" id="princedomId">
                                            <option value="">--- {{trans('individually.please-choose')}} ---</option>
                                            @if (count($princedoms) > 0)
                                                @foreach($princedoms as $princedom)
                                                    <option value="{{$princedom['id']}}" style="direction: {{$rtl}}">{{ getTranslate($princedom, 'name') }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('princedomId'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('princedomId') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab" data-name="{{trans('individually.User-account')}}">
                            <div class="d-flex flex-wrap">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}  col-12 col-md-6">
                                    <span class="asterisks">*</span><label for="email"
                                                                        class="col-md-6 control-label pb-2 pt-2">{{trans('auth.email')}}</label>
                                    <div class="col-12">
                                        <input id="email" type="email" class="form-control" name="email" value="" required>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <fieldset id="password-container" class="d-flex flex-wrap col-12 p-0">
                                    <div class="form-group required {{ $errors->has('password') ? ' has-error' : '' }} col-12 col-md-6">
                                        <span class="asterisks">*</span><label for="password_confirmation"
                                                                            class="col-10 control-label pb-2 pt-2">{{trans('auth.password')}}</label>
                                        <div class="col-sm-12">
                                            <input type="password" autocomplete="off" name="password" value=""
                                                placeholder="{{trans('auth.password')}}" id="input-password" class="form-control input-player" required>
                                            <div class="hide-show">
                                                <span style="{{ $floatRight }}"><i class="fa fa-eye" style="color: #000;"></i></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group required {{ $errors->has('password_confirmation') ? ' has-error' : '' }} col-12 col-md-6">
                                        <span class="asterisks">*</span><label for="password_confirmation"
                                                                            class="col-10 control-label pb-2 pt-2">{{trans('auth.confirm-password')}}</label>
                                        <div class="col-sm-12">
                                            <input type="password" autocomplete="off" name="password_confirmation" value=""
                                                placeholder="{{trans('auth.confirm-password')}}" id="password_confirmation"
                                                class="form-control input-player" required>
                                            <div class="hide-show1">
                                                <span style="{{ $floatRight }}"><i class="fa fa-eye" style="color: #000;"></i></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </fieldset>

                            </div>
                        </div>
                        <nav class="tab-pag"></nav>
                    </div>
                </form>

                </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $("#form-platform").hide();
            $("#form-games").hide();
            $('input[name="otherPlatform"]').change(function () {
                $("#form-platform").toggle();
            });
            $('input[name="otherGame"]').change(function () {
                $("#form-games").toggle();
            });
            $('input[name="uaeResidency"]').change(function () {

                if ( $('#princedom').css('visibility') == 'hidden' )
                    $('#princedom').css('visibility','visible');
                else
                    $('#princedom').css('visibility','hidden');
            });

            $('#card_account-type').text($('input[name="account-type"]').val());
            $('select[name="NationalityId"]').change(function (e) {
                $('#card_NationalityId').text(e.target.selectedOptions[0].text);
            });
            $('input[type="file"]').change(function (e) {
                $('#card_image').attr('src', URL.createObjectURL(e.target.files[0]));
            });
            $('input[name="firstName"]').blur((e) => inputBlur(e, "firstName"));
            $('input[name="BirthDate"]').blur((e) => inputBlur(e, "BirthDate"));
            $('input[name="uaeIdNumber"]').blur((e) => inputBlur(e, "uaeIdNumber"));
            $('input[name="uaeIdEndDate"]').blur((e) => inputBlur(e, "uaeIdEndDate"));

            function inputBlur(element, name) {
                let value = element.target.value;
                $('#card_' + name).text(value);
            }

            //


        });
        $(function () {
            showHidePassword('.hide-show', 'password');
            showHidePassword('.hide-show1', 'password_confirmation');

            function showHidePassword(element, attr) {
                $(`${element}`).show();
                $(`${element} span`).addClass('show')
                $(`${element} span`).click(function () {
                    if ($(this).hasClass('show')) {
                        //   $(this).text('Hide');
                        $(`input[name="${attr}"]`).attr('type', 'text');
                        $(this).removeClass('show');
                    } else {
                        //    $(this).text('Show');
                        $(`input[name="${attr}"]`).attr('type', 'password');
                        $(this).addClass('show');
                    }
                });
                $('form button[type="submit"]').on('click', function () {
                    $(`${element} span`).text('Show').addClass('show');
                    $(`${element}`).parent().find(`input[name="${attr}"]`).attr('type', 'password');
                });
            }
        });

    </script>
<script>
    var tabs = function(id) {
  this.el = document.getElementById(id);

  this.tab = {
    el: '.tab',
    list: null
  }

  this.nav = {
    el: '.tab-nav',
    list: null
  }

  this.pag = {
    el: '.tab-pag',
    list: null
  }

  this.count = null;
  this.selected = 0;

  this.init = function() {
    // Create tabs
    this.tab.list = this.createTabList();
    this.count = this.tab.list.length;

    // Create nav
    this.nav.list = this.createNavList();
    this.renderNavList();

    // Create pag
    this.pag.list = this.createPagList();
    this.renderPagList();

    // Set selected
    this.setSelected(this.selected);
  }

  this.createTabList = function() {
    var list = [];

    this.el.querySelectorAll(this.tab.el).forEach(function(el, i) {
      list[i] = el;
    });

    return list;
  }

  this.createNavList = function() {
    var list = [];

    this.tab.list.forEach(function(el, i) {
      var listitem = document.createElement('a');
          listitem.className = 'nav-item',
          listitem.innerHTML = el.getAttribute('data-name'),
          listitem.onclick = function() {
            this.setSelected(i);
            return false;
          }.bind(this);

      list[i] = listitem;
    }.bind(this));

    return list;
  }

  this.createPagList = function() {
    var list = [];

    list.prev = document.createElement('a');
    list.prev.className = 'pag-item pag-item-prev',
      list.prev.innerHTML = "{{trans('individually.Prev')}}",
      list.prev.onclick = function() {
      this.setSelected(this.selected - 1);
      return false;
    }.bind(this);

    list.next = document.createElement('a');
    list.next.className = 'pag-item pag-item-next',
      list.next.innerHTML = "{{trans('individually.Next')}}",
      list.next.onclick = function() {
      this.setSelected(this.selected + 1);
      return false;
    }.bind(this);

    list.submit = document.createElement('button');
    list.submit.className = 'pag-item pag-item-submit',
    list.submit.innerHTML = " {{trans('site.createaccount')}}";
    list.submit.setAttribute('type', 'submit');

    return list;
  }

  this.renderNavList = function() {
    var nav = document.querySelector(this.nav.el);

    this.nav.list.forEach(function(el) {
      nav.appendChild(el);
    });
  }

  this.renderPagList = function() {
    var pag = document.querySelector(this.pag.el);

    pag.appendChild(this.pag.list.prev);
    pag.appendChild(this.pag.list.next);
    pag.appendChild(this.pag.list.submit);
  }

  this.setSelected = function(target) {
    var min = 0,
        max = this.count - 1;

    if(target > max || target < min) {
      return;
    }

    if(target == min) {
      this.pag.list.prev.classList.add('hidden');
    } else {
      this.pag.list.prev.classList.remove('hidden');
    }

    if(target == max) {
      this.pag.list.next.classList.add('hidden');
      this.pag.list.submit.classList.remove('hidden');
    } else {
      this.pag.list.next.classList.remove('hidden');
      this.pag.list.submit.classList.add('hidden');
    }

    this.tab.list[this.selected].classList.remove('selected');
    this.nav.list[this.selected].classList.remove('selected');

    this.selected = target;
    this.tab.list[this.selected].classList.add('selected');
    this.nav.list[this.selected].classList.add('selected');
  }
};

var tabbedForm = new tabs('tabbedForm');
tabbedForm.init();

</script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
