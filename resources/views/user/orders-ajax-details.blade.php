@php
	$ml_mr_auto = App::getLocale() == 'ar' ? 'mr-auto ml-0' : 'mr-0 ml-auto';
	$textRight = App::getLocale() == 'ar' ? 'text-right' : 'text-left';
	$pullRight = App::getLocale() == 'en' ? 'pull-right' : 'pull-left';

@endphp
<div class="orders ajax-orders">
	<h4 class="mb-3" style="color: #a91b1a">{{ $status == 'completed' ? trans('product.previous-orders') : trans('product.current-orders')  }}</h4>
	<div class="table-responsive">
		<table class="table text-center table-striped table-hover">
			@if (count($orders) > 0)
				<thead>
					<tr>
						<th scope="col">{{trans('product.title')}}</th>
						<th scope="col">{{trans('product.date')}}</th>
						<th scope="col">{{trans('product.count')}}</th>
						<th scope="col">{{trans('product.color')}}</th>
						<th scope="col">{{trans('product.size')}}</th>
						<th scope="col">{{trans('product.freeShipping')}}</th>
{{--						<th scope="col">{{trans('product.shippingCosts')}}</th>--}}
						<th scope="col">{{trans('product.totalDiscounts')}}</th>
						<th scope="col">{{trans('product.totalPrice')}}</th>
						<th scope="col">{{trans('product.finalPrice')}}</th>
						<th scope="col">{{trans('product.currencyName')}}</th>
						<th scope="col">{{trans('product.unitName')}}</th>
						<th scope="col">{{trans('product.status')}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($orders as $key => $order)
{{--						@if (strtolower($order['status']) == $status)--}}
								<tr>
									<td>{{$order['productName']}}</td>
									<td style="white-space: nowrap;">{{\Carbon\Carbon::parse($order['date'])->format('Y-m-d')}}</td>
									<td>{{$order['count']}}</td>
									<td>{{empty($order['productColorName']) ? '---' : $order['productColorName']}}</td>
									<td>{{empty($order['productSizeName']) ? '---' : $order['productSizeName']}}</td>
									<td>{{$order['freeShipping'] ? trans('product.yes') : trans('product.no')}}</td>
{{--									<td>{{$order['shippingCosts']}}</td>--}}
									<td>{{$order['totalDiscounts']}}</td>
									<td>{{$order['totalPrice']}}</td>
									<td>{{$order['finalPrice']}}</td>
									<td>{{$order['currencyName']}}</td>
									<td>{{$order['unitName']}}</td>
									<td class="text-success font-weight-bold">{{ucfirst($status)}}</td>
								</tr>
{{--						@endif--}}
					@endforeach
				@else
					<tr class="cart_item">
						<td class="cart-product-name">
							<strong class="product-quantity">
								{{ trans('product.non-order') }}
							</strong>
						</td>
					</tr>
				@endif
			</tbody>
		</table>
	</div>
</div>
@if(!empty($comments))
	<hr class="my-4 border-secondary">
	<div class="comments">
		<h4 class="mb-3" style="color: #a91b1a">{{trans('auth.comments')}}</h4>
		@foreach($comments as $comment)
			<div class="comment-reply px-0 mb-2">
				<div class="comment_body bg-white p-2 rounded">
					<div class="comment_toolbar">
						<p class="{{$textRight}} d-inline-block mb-0" style="color: #6c757d82">
							{{$comment['title']}}
						</p>
						<p class="text-secondary d-inline-block {{$pullRight}}" style="font-size: 11px">
							<i class="fa fa-calendar fa-fw"></i>
							{{\Carbon\Carbon::parse($comment['createdAt'])->format('Y-m-d')}}
						</p>
					</div>
					<p class="mb-0">{{$comment['text']}}</p>
				</div>
			</div>
		@endforeach
	</div>
@endif