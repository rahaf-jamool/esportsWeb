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
            vertical-align: center;
            color: #FFFFFF;
            text-align: center;
            font-size: 14px;
            height: 80px;
            background: #991BBD;

        }
    </style>
</head>
<body>

@php( $user = Auth::user())
<table style="" dir="{{ trans('all.dir') }}" border="0" align="right" cellpadding="1" cellspacing="1">
    <tbody style="display: block">
    <tr class="header">
        <td>
            {{ config('app.name')}}
        </td>
    </tr>
    <tr>
        <td>
            <center> {{ ($symbol=='ar')?$user->Member->Title:$user->Member->TitleE  }} , {{  $data['notification_title'] }}</center>
        </td>
    </tr>
    @php
        $content='';
            switch($data['notification_type']){
                case 1:{
                    $content=
                    '<tr >
                        <td >
                            <strong>
                                ' . trans('all.commentdata') . '
                            </strong>
                        </td>
                    </tr>
                    <tr >
                        <td >
                            ' . $data['comment'] . '
                        </td>
                    </tr>';
                };
                break;
                case 2:{
                    $content=
                    '<tr style="display: block;">
                        <td>
                            <strong>
                                ' . trans('all.rating') . '
                            </strong>
                        </td>
                    </tr>
                    <tr style="display: block;">
                        <td >
                            ' . $data['rating'] . '&nbsp;' . trans('all.stars') . '
                        </td>
                    </tr>';
                };
                break;

            }
    @endphp

    {!!  $content  !!}
    <tr>
        <td>
            {{ trans('all.notify-user-more-info') }} <a href="{{ url($symbol.'/home') }}"> {{ config('app.url') }} </a>
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