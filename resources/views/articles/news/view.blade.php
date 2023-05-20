@extends('layouts.master')

@section('title' , config('app.name'). " - ". $pageInfo['title'])
@if(array_key_exists('description' , $pageInfo))
    @section('og-description' , $pageInfo['description'])
    @section('description', $pageInfo['description'])
@else
    @section('og-description' , config('app.description'))
    @section('description', config('app.description'))
@endif
@section('keywords' , config('app.keyword'))
@section('og-title' , config('app.name')  ."-". $pageInfo['title'])
@section('page-style', asset('assets/css/articles-news.css'))

@section('og-image' , url(asset('SD08/logo.jpg')))
@section('og-url' , url(Request::url()))
@section('content')
<!-- Start header -->
{{-- <div class="about-header" >
    <div class="image-home">
        <img class="" src="{{  url(asset('assets/img/1.jpg')) }} " alt="logo">
    </div>
</div> --}}
<!-- End header -->

<div class="new-view">
<div class="details-title mb-5">
        <h1>{{$new['name']}}</h1>
        <span class="date"> 19 {{trans('all.Aug')}} 2022</span>
        <ul class="social">
            <li><span class="fa fa-facebook"></span></li>
            <li><span class="fa fa-twitter"></span></li>
        </ul>
    </div>
    <div class="details-image mb-3">
        @if($new['mainImagePath'] != '' )
            <img style="width: 100%;" src="{{ config('app.base_address') . $new['mainImagePath'] }}" alt="" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';">
        @else
            <img style="width: 100%;" src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
        @endif
    </div>
    <div class="details-desc mt-5">
    {!! $new['content'] !!}
        {{-- الرياضة هي مجهود جسديّ يُمارَس وفق قواعد معيّنةٍ متفّقٍ عليها؛ للمنافسة، أو المتعة، أو التميّز، أو تطوير المهارات وتقوية الثقة بالنفس وتعزيزها، وأصبحت الرياضة في الوقت الحاضر جزءاً مهمّاً من نشاطات الأفراد والجماعات، فنجد المباريات التنافسيّة، والألعاب الرياضيّة التي تُنظَّم على مستوى العالم، مثل: الألعاب الأولمبيّة، وبطولات كرة القدم. نشأة الرياضة أثبتت الكثير من الأبحاث أنّ نشأة الرياضة تعود إلى عهد المصريّين القدماء الذين يُطلَق عليهم الفراعنة؛ حيث وجد باحثو الآثار المصريّة آثاراً تدلّ على ممارستهم رياضتي: المصارعة، والرقص، كما استخدموا الرياضة في تدريب المحاربين وإعدادهم، ووجدوا العديد من صور الفراعنة وهم يصطادون الغزلان والأسود بالقوس أثناء ركوبهم عرباتهم. نُظِّمت في الملعب اليونانيّ مبارياتٌ مختلفة على مستوى البلاد اليونانيّة في العصر اليونانيّ، واستوحيَت هذه الرياضات من حياة الإنسان البدائيّة؛ حين كان يطارد الفريسة؛ لتحصيل لقمة العيش، فاستوحوا من تصرّفه هذا رياضة العدو، والرماية، والقفز، والسباحة التي استوحوها من صيدهم للأسماك، بالإضافة إلى سباق الخيل الذي استوحوه من ركوبهم الخيل، واعتمادهم عليه في حياتهم وتنقّلاتهم، أمّا الصينيّون فذكرت العديد من الأبحاث أنّهم مارسوا رياضة كرة القدم، ولكن باستخدام كرةٍ من حديدٍ بدلاً من الكرة الحاليّة المعروفة. --}}
    </div>
</div>

@endsection
