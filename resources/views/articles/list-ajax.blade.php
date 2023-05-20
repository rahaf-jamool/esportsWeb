@if($articles->isNotEmpty())
	@foreach($articles as $value)
					<div class="col-md-4 col-sm-6 col-12" >
						<div class="card home-article m-1 text-center animation fadeInUp p-0" style="width: 100%; background-color: #fff;">
							<a href="{{ArticlesService::check_url($value,$value->articlemaster)}}">
								@if($value->photo!='' && File::exists('SD08/msf/'.$value->photo))
									<img class="img-fluid" src="{{ Image::url(url('SD08/msf/'.$value->photo),400,550,array('crop') ) }}" alt="{{ $value->{$symbol.'_name'} }}"/>
								@else
									<img class="img-fluid" src="{{ url('SD08/msf/logo.png') }}"/>
								@endif
							</a>
							<div class="card-body p-3">
								<div class="article-date">
									<span>
										{{ date( "d M Y" , strtotime($value->created_at)) }}
									</span>
								</div>
								<div class="article-logo">
									<img src="{{ url('SD08/msf/logo.jpg') }}">
								</div>
								<h3 class="card-title">{{ words($value->title,13) }}</h3>
								<p class="card-text" style="font-size: 15px;">
									{{ words($value->description,20,'..') }}
								</p>
							</div>
						</div>
					</div>
	@endforeach
@endif