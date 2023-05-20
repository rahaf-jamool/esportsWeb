@php
    $links = DocService::getList(['lang' => $lang  ,  'is_visible'=>1,  'menu_id'=>$header->id ,'parent'=>0]);
   // $section = SectionService::getList();
@endphp

<div class="navbar-header" style="">



<!-- <button type="button" class="navbar-toggle product-btn" data-toggle="collapse" data-target="#h-product-menu">
                <span class="bar"><span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
             </span>
        <span class="name">{{ trans('site.categories') }}</span>
    </button>-->
</div>
@if(false)
<ul class="navbar" id="h-menu-navbar">
   {!!DocService::generate_menu($links)!!}
</ul>
    @endif


<ul class="navbar" id="h-top-menu-navbar">
    @if(!$links->isEmpty())
        @php($i= '')
        @foreach($links as $doc)
            @php
                if($doc->is_link==1 && $doc->url_type != 2){
                $url=url($doc->url);
                }elseif($doc->is_link==1 && $doc->url_type == 2)
                {
                $url=$doc->url;
                }elseif($doc->is_download==1 && $doc->download_file!=''){
                $url= asset('SD08/msf/'.$doc->download_file);
                }else{
                $url= url(config('app.symbol').'/pages/'.$doc->id."/".make_slug($doc->name));
                }
                $i++;
                $target = 'target="'.$doc->target.'"';

                if(!$doc->sons->isEmpty()  || $doc->is_include_menu )
                {
                $data = 'class="dropdown-toggle"';
                $data_a = 'data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"';
                $url = 'javascript:void(0);';
                }else{
                $data = '';
                $data_a = '';
                }
            @endphp
            <li {!! $data !!}>
                <a href="{{ $url }}" {!! $target ." ". $data_a  !!}> {{$doc->name}}</a>

                @if(!$doc->sons->isEmpty() )
                    <ul class="dropdown-menu ">
                        {!! DocService::generate_sub_menu($doc->sons)  !!}
                    </ul>

                @elseif($doc->is_include_menu)
                    @include("layouts.".$doc->include_menu)
                @endif
            </li>
        @endforeach
    @endif
</ul>