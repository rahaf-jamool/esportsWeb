@if($articles->isNotEmpty())
	@foreach($articles as $row)
		<div class="single-latest-post row align-items-center">
			<div class="col-lg-5 post-left">
				<div class="feature-img relative">
					<div class="overlay overlay-bg"></div>
					@if($row->photo != '' && File::exists('SD08/msf/'.$row->photo))
						<img class="img-fluid" src="{{ Image::url(url('SD08/msf/'.$row->photo),278,190,array('crop')) }}" alt="">
					@else
						<img class="img-fluid" src="{{ Image::url(url('SD08/msf/logo.png'),278,190,array('crop')) }}" alt="">
					@endif
				</div>
				<ul class="tags">
					<li><a href="javascript:void(0)">{{ $row->articlemaster->{$symbol.'_name'} }}</a></li>
				</ul>
			</div>
			<div class="col-lg-7 post-right">
				<a href="{{ArticlesService::check_url($row,$row->articlemaster)}}">
					<h4>{{ $row->title }}</h4>
				</a>
				<ul class="meta">
					<li><a href="#"><span class="lnr lnr-user"></span> {{ $row->author->Title }}</a></li>
					<li><a href="#"><span class="lnr lnr-calendar-full"></span> {{ date( "d M Y" , strtotime($row->post_date)) }} </a></li>
					<li><a href="#"><span class="lnr lnr-bubble"></span>{{ trans('all.comments') }} {{ count($row->comments) }}</a></li>
				</ul>
				<p class="excert">
					{!! words($row->brief,13,'..') !!}
				</p>
			</div>
		</div>
	@endforeach
@endif