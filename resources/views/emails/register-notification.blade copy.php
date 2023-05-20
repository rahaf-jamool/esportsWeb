<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <style type="text/css">
        body{
            font-size: 16px;
            font-family: "El Messiri", sans-serif;
            color: #0c0c0c;
        }
        td{
            padding: 15px;
        }
        tr.header td{
            vertical-align: center;
            color: #FFFFFF;
            text-align: center;
            font-size: 24px;
            height: 80px;
            background: #3B4069;
        }
        tr.footer td{
            vertical-align: center;
            color: #FFFFFF;
            text-align: center;
            font-size: 14px;
            height: 80px;
            background:#3382BA;

        }
    </style>
</head>
<body>

@php
    $local = App::getlocale();
@endphp

<table style="" dir="{{ trans('all.dir') }}" border="0" align="right" cellpadding="1" cellspacing="1">
    <tbody style="display: block">
    <tr class="header">
        <td>
            {{ trans('all.site_name', [], App::setlocale('ar')) }}
        </td>
    </tr>
    @php
        App::setlocale($local);
    @endphp

    @php
        $local = App::getlocale();
    @endphp
    @if($user->isCompany)

        <tr>
            <td style="text-align: right">
                {{ trans('all.notify-company-site-register-thanks' , ['name' => $user->name ], App::setlocale('ar')) }}
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                {{ trans('all.notify-user-more-info', [], App::setlocale('ar')) }} <a href="{{ url(App::getLocale() .'/') }}"> {{ config('app.alter_name') }} </a>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                {{ trans('all.notify-user-Regards', [], App::setlocale('ar')) }}
            </td>
        </tr>
        <tr>
            <td style="text-align: left;">
                {{ trans('all.notify-company-site-register-thanks' , ['name' => $user->name ], App::setlocale('en')) }}
            </td>
        </tr>
        <tr>
            <td style="text-align: left;">
                {{ trans('all.notify-user-more-info', [], App::setlocale('en')) }} <a href="{{ url(App::getLocale() .'/') }}"> {{ config('app.alter_name') }} </a>
            </td>
        </tr>
        <tr>
            <td style="text-align: left;">
                {{ trans('all.notify-user-Regards', [], App::setlocale('en')) }}
            </td>
        </tr>
    @else
        <tr>
            <td style="text-align: right">
                {{ trans('all.notify-user-site-register-thanks' , ['name' =>$user->name ], App::setlocale('ar')) }}
            </td>
        </tr>

        <tr>
            <td style="text-align: right">
                {{ trans('all.notify-user-more-info', [], App::setlocale('ar')) }} <a href="{{ url(App::getLocale() .'/') }}"> {{ config('app.alter_name') }} </a>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                {{ trans('all.notify-user-Regards', [], App::setlocale('ar')) }}
            </td>
        </tr>

        <tr>

            <td style="text-align: left">
                {{ trans('all.notify-user-site-register-thanks' , ['name' => $user->name ], App::setlocale('en')) }}
            </td>
            {{-- @endif --}}
        </tr>
        <tr>
            <td style="text-align: left">
                {{ trans('all.notify-user-more-info', [], App::setlocale('en')) }} <a href="{{ url(App::getLocale() .'/') }}"> {{ config('app.alter_name') }} </a>
            </td>
        </tr>
        <tr>
            <td style="text-align: left">
                {{ trans('all.notify-user-Regards', [], App::setlocale('en')) }}
            </td>
        </tr>
    @endif

    @php
        App::setlocale($local);
    @endphp



    {{-- <tr>
        <td>
            {{ trans('all.notify-user-more-info') }} <a href="{{ url(config('app.locale_country').'/home') }}"> {{ config('app.url') }} </a>
        </td>
    </tr>
    <tr>
        <td>
            {{ trans('all.notify-user-Regards') }}
        </td>
    </tr> --}}
    <tr class="footer">
        <td>
            {{ trans('all.All rights reserved') }} {{ config('app.name') }} © {{ date('Y') }}
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
