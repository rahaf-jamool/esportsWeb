@extends('layouts.master')

@section('title' , trans('site.site-title'). " - ". $pageInfo['title'])
@if(array_key_exists('description' , $pageInfo))
    @section('og-description' , $pageInfo['description'])
    @section('description', $pageInfo['description'])
@else
    @section('og-description' , config('app.description'))
    @section('description', config('app.description'))
@endif
@section('keywords' , config('app.keywords'))
@section('og-title' , config('app.name')  . "-" . $pageInfo['title'])

@section('og-image' , url(asset('')))
@section('og-url' , url(Request::url()))
@section('page-style', asset(''))
{{-- {{dd(session('loggedUser'))}} --}}
{{-- {{dd(session('hangitToken'))}} --}}
@section('content')
	<style>
		.table thead th {vertical-align: middle; text-align: center; }
		.table tbody td {vertical-align: middle; text-align: center; }
	</style>
	<div class="information">
		<div class="container">
			<h1 class="text-center my-4">{{trans('user.my-profile')}}</h1>
			<div class="card mb-3">
				<div class="card-header text-white" style="background: #08ac9c;">
					{{trans('user.my-info')}}
					<a class="btn btn-outline-dark btn-sm pull-right" href="{{url(App::getLocale() . '/user/edit/' . $user->id)}}">{{trans('user.edit-info')}}</a>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-4 col-lg-3 mb-2 mb-sm-0">
							@if(!is_null($user->image))
								<img src="{{config('app.base_address') . $user->image}}" class="img-fluid d-block m-auto" alt="avatar"/>
							@else
								<img src="{{asset('assets/img/cta-bg.jpg')}}" class="img-fluid d-block m-auto" alt="avatar"/>
							@endif
						</div>
						<div class="col-sm-8 col-lg-9">
							<ul class="list-unstyled">
								<li>
									<i class="fa fa-user fa-fw"></i>
									<span>{{trans('user.username')}}</span> : {{$user->userName}}
								</li>
								<li>
									<i class="fa fa-envelope-o fa-fw"></i>
									<span>{{trans('user.email')}}</span> : {{$user->email}}
								</li>
								<li>
									<i class="fa fa-phone fa-fw"></i>
									<span>{{trans('user.phone')}}</span> : {{$user->phone}}
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="card mb-3">
				<div class="card-header text-white" style="background: #08ac9c;">
					{{trans('user.my-orders')}}
				</div>
				<div class="card-body">
					@if($customerOrder)
						<div class="row">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th scope="col">{{trans('auth.productName')}}</th>
											<th scope="col">{{trans('auth.date')}}</th>
											<th scope="col">{{trans('auth.count')}}</th>
											<th scope="col">{{trans('auth.unitName')}}</th>
											<th scope="col">{{trans('auth.totalPrice')}}</th>
											<th scope="col">{{trans('auth.totalDiscounts')}}</th>
											<th scope="col">{{trans('auth.finalPrice')}}</th>
											<th scope="col">{{trans('auth.currencyName')}}</th>
											<th scope="col">{{trans('auth.freeShipping')}}</th>
											<th scope="col">{{trans('auth.shippingCosts')}}</th>
											<th scope="col">{{trans('auth.status')}}</th>
											<th scope="col">{{trans('auth.orderGroup')}}</th>
											<th scope="col">{{trans('auth.orderProductCustomPropertyValues')}}</th>
										</tr>
									  </thead>
									  <tbody>
										@foreach($customerOrder as $order)
											<tr>
												<td scope="row">{{$order->productName}}</td>
												<td>{{date('d-m-Y', strtotime($order->date))}}</td>
												<td>{{$order->count}}</td>
												<td>{{$order->unitName}}</td>
												{{-- <td>{{$order->unitRatio}}</td> --}}
												<td>{{$order->totalPrice}}</td>
												<td>{{$order->totalDiscounts}}</td>
												<td>{{$order->finalPrice}}</td>
												<td>{{$order->currencyName}}</td>
												{{-- <td>{{$order->currencyRatio}}</td> --}}
												<td>{{$order->freeShipping ? trans('product.yes') : trans('product.no')}}</td>
												<td>{{$order->shippingCosts}}</td>
												<td>{{$order->status}}</td>
												<td>{{$order->orderGroup ?? '-' }}</td>
												<td>{{$order->orderProductCustomPropertyValues ?? '-'}}</td>
											</tr>
										@endforeach
									  </tbody>
								</table>
							</div>
						</div>
						<div class="pagination-numbers d-flex mt-3">
							{{$customerOrder->links()}}
						</div>
						@else
							{{trans('user.zero-orders-msg')}}
						@endif
					</div>
				</div>
			</div>

		</div>
@endsection
