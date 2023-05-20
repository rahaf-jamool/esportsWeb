@php
    $articles_type = \App\Facades\ArticlesMasterService::getList();
@endphp
<div class="item-filter col-xs-12">

    <select name="type" id="type">
        <option value="">{{trans('all.all')}}</option>
        @if($articles_type->isNotEmpty())
            @foreach($articles_type as $value)
                <option value="{{ $value->id }}">{{$value->{$symbol.'_name'} }}</option>
            @endforeach
        @endif
    </select>

    <select name="order" id="order">
        <option value="">{{trans('all.sort')}}</option>
        <option value="{{'title'}} asc">{{trans('all.nameasc')}}</option>
        <option value="{{'title'}} desc">{{trans('all.namedesc')}}</option>
        <option value="post_date asc">{{trans('all.dateasc')}}</option>
        <option value="post_date desc">{{trans('all.datedesc')}}</option>
    </select>


    <select name="res" id="res">
        <option value="">{{trans('all.companies-count')}}</option>
        <option value="12">12</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>


</div>