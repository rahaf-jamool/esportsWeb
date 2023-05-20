<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <style>
        tr.header {
            vertical-align: center;
            color: #FFFFFF;
            text-align: center;
            font-size: 24px;
            height: 80px;
            background: #3B4069;
        }
    </style>
</head>
{{--dd($data)--}}
<body>
<table style="font-size:17px;border:1px solid rgb(132,132,132);width: 99%;display: block;" dir="rtl" border="0" align="right" cellpadding="1" cellspacing="1">
    <tbody style="display: block">

        <tr class="header" style="border-bottom: 1px solid rgb(132,132,132);display: block;">
            <td align="center" style="padding: 10px;">
                <strong style="width: 100%; position: absolute;">
                    {{ config('app.name') }}
                </strong>
            </td>
        </tr>
        <tr style="border-bottom: 1px solid rgb(132,132,132);display: block;">
            <td align="right" style="padding: 10px;">
                <strong>
                     {{ trans('all.Contact Us')  }}
                </strong>
            </td>
        </tr>
        <tr style="border-bottom: 1px solid rgb(132,132,132);display: block;">
            <td align="right" style="padding: 10px;border-left: 1px solid rgb(132,132,132);display: inline-block;width: 46%;">
                <strong>
                    {{ trans('site.name')  }}
                </strong>
                &nbsp;&nbsp;:&nbsp;&nbsp;
                {!! $data['name'] !!}
            </td>
            <td align="right" style="padding: 10px;display: inline-block;width: 45%;">
                <strong>
                    {{ trans('all.title')  }}
                </strong>
                &nbsp;&nbsp;:&nbsp;&nbsp;
                {!! $data['title'] !!}
            </td>
        </tr>
        <tr style="border-bottom: 1px solid rgb(132,132,132);display: block;">
            {{--<td align="right" style="padding: 10px;border-left: 1px solid rgb(132,132,132);display: inline-block;width: 46%;">
                <strong>
                    {{ trans('site.country')  }}
                </strong>
                &nbsp;&nbsp;:&nbsp;&nbsp;
                {!! $data['nation'] !!}
            </td>--}}
            <td align="right" style="padding: 10px;display: inline-block;width: 45%;">
                <strong>
                    {{ trans('all.email')  }}
                </strong>
                &nbsp;&nbsp;:&nbsp;&nbsp;
                {!! $data['email'] !!}
            </td>
        </tr>
        <tr style="display: block;">
            <td align="right" style="padding: 10px;display: inline-block;width: 100%;">
                <strong>
                    {{ trans('site.message')  }}
                </strong>
            </td>
        </tr>
        <tr style="display: block;">
            <td align="right" style="padding: 10px;display: inline-block;width: 100%;">
                {!! $data['msg'] !!}
            </td>
        </tr>

    </tbody>
</table>
</body>
</html>
