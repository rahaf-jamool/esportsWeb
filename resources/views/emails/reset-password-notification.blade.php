<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <style type="text/css">
        body {
            font-size: 16px;
            font-family: "El Messiri", sans-serif;
            color: #0c0c0c;
            width: 100%;
        }

        td {
            padding: 15px;
        }

        tr.header td {
            vertical-align: center;
            color: #FFFFFF;
            text-align: center;
            font-size: 24px;
            height: 80px;
            background: #991BBD;
        }

        tr.footer td {
            width: 100%;
            vertical-align: center;
            color: #FFFFFF;
            text-align: center;
            font-size: 14px;
            height: 80px;
            background: #3382BA;

        }
    </style>
</head>
<body>

<table  dir="{{ trans('all.dir') }}" border="0" align="center" cellpadding="1" cellspacing="1">
    <tbody style="display: block">
    <tr class="header">
        <td>
            {{ config('app.name')}}
        </td>
    </tr>
    <tr>
        <td>
            {{ trans('auth.hello') }}
        </td>
    </tr>
    <tr>
        <td>
            {{ trans('auth.notify-user-reset-password-message') }}
        </td>
    </tr>
    <tr>
        <td>
            <a href="{{ url(App::getLocale() . '/passwords/resets/' . $token) }}"> {{ trans('auth.reset-password') }} </a>
{{--            <a href="{{ route('password.reset', [App::getLocale(), 'token' => $token]) }}"> {{ trans('auth.reset-password') }} </a>--}}
        </td>
    </tr>
    <tr>
        <td>
            {{ trans('auth.notify-user-reset-password-message-line-2') }}
        </td>
    </tr>
    <tr>
        <td>
            {{ trans('all.notify-user-Regards') }}
        </td>
    </tr>
    <tr class="footer">
        <td>
            {{ trans('all.All rights reserved') }} {{ config('app.name') }}© {{ date('Y') }}
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
