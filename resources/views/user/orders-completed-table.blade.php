@php
	$ml_mr_auto = App::getLocale() == 'ar' ? 'mr-auto ml-0' : 'mr-0 ml-auto';
@endphp
<div class="table-responsive">
	<table class="table text-center table-striped table-hover">
		@if (count($orders) > 0)
		<thead>
			<tr>
				<th scope="col">{{trans('product.clientName')}}</th>
				<th scope="col">{{trans('product.date')}}</th>
{{--				<th scope="col">{{trans('product.seaport')}}</th>--}}
				<th scope="col">{{trans('product.shippingCosts')}}</th>
				<th scope="col">{{trans('product.currencyName')}}</th>
				<th scope="col">{{trans('product.country')}}</th>
				<th scope="col">{{trans('product.status')}}</th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
			@foreach($orders as $key => $order)
				@if (strtolower($order['confirmed']) == $status)
					<tr class="order-completed-details"
						data-id="{{$order['id']}}"
						data-status="{{$status}}"
						data-url="{{ url(App::getLocale() . '/order/' . $order['id']) }}"
                        data-bs-toggle="modal" data-bs-target="#orderCompletedDetailsModal" style="cursor: pointer">
						<td>{{$order['clientName']}}</td>
						<td style="white-space: nowrap;">{{\Carbon\Carbon::parse($order['date'])->format('Y-m-d')}}</td>
{{--						<td>{{is_null($order['seaportName']) ? '---' : $order['seaportName']}}</td>--}}
						<td>{{is_null($order['shippingCost']) ? '---' : $order['shippingCost']}}</td>
						<td>{{is_null($order['currencyName']) ? '---' : $order['currencyName']}}</td>
						<td>{{is_null($order['countryName']) ? '---' : $order['countryName']}}</td>
						<td class="text-success font-weight-bold">{{$order['confirmed'] ? trans('auth.completed') : trans('auth.not-completed')}}</td>
						<td class="text-success font-weight-bold"><i class="fa fa-eye fa-fw"></i></td>
					</tr>
				@endif
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

<!-- Add New Complaint Modal -->
<div class="modal fade" id="orderCompletedDetailsModal" tabindex="-1" aria-labelledby="orderCompletedDetailsModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="model-content-box">
				<div class="modal-header">
					<h5 class="modal-title" id="orderCompletedDetailsModalLabel"></h5>
                    <button type="button" class="btn-close close {{$ml_mr_auto}}" data-bs-dismiss="modal" aria-label="Close">
{{--						<span aria-hidden="true">&times;</span>--}}
					</button>
				</div>
				<div class="modal-body modal-ajax" style="background: #f5f5f5"></div>
			</div>
			<div class="model-message text-center py-3">
				<div class="modal-header">
					<h5 class="modal-title" id="orderCompletedDetailsModalLabel"></h5>
                    <button type="button" class="btn-close close {{$ml_mr_auto}}" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<p class="model-message-content text-danger mb-0 mt-3"></p>
			</div>
			<div class="model-loader text-center d-none py-5">
				<img src="{{asset('SD08\loader.gif')}}" alt="">
			</div>
		</div>
	</div>
</div><!--.modal-->

@push('js')
<script>
    // Get Complaint Details
    $('.tab-content').on('click', '.order-completed-details', function () {
        let formData = new FormData(),
            ajaxUrl = $(this).data('url'),
            status = $(this).data('status'),
            id = $(this).data('id');
        formData.append('_token', '{{csrf_token()}}');
        formData.append('id', id);
        formData.append('status', status);

        $.ajax({
            url: ajaxUrl,
            method: 'POST',
            processData: false,
            contentType: false,
            data: formData,
            beforeSend: function () {
                $('#orderCompletedDetailsModal .model-loader').removeClass('d-none');
                $('#orderCompletedDetailsModal .model-message').addClass('d-none');
                $('#orderCompletedDetailsModal .model-content-box').addClass('d-none');
            },
            error: function (data, status) {
                console.log(data.responseJSON.error);
                $('.model-message').removeClass('d-none');
                $('.model-loader').addClass('d-none');
                $('#complaintDetailsModal').find('.model-message-content').text(data.responseJSON.error);
            },
            success: function (response, status) {
                if (status == 'success') {
                    $('.model-loader').addClass('d-none');
                    $('.model-content-box').removeClass('d-none');
                    $('#orderCompletedDetailsModal').find('.modal-ajax').html(response.view);
                    $('#complaintDetailsModal').find('.modal-body').html(JSON.parse(response.data));
                    $('#complaintDetailsModal').find('.modal-title').text(response.title);

                }
            }
        });
    });


</script>
@endpush
