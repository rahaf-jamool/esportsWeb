
<div class="card checkout-area pt-30 pb-30">
	<div class="account-header">
		<div class="card-body">
			<ul class="account-nav nav nav-tabs">
				<li class="account-link active">
					<a data-id="#prev-orders">
						<span>{{ trans('product.previous-orders') }}</span>
					</a>
				</li>
				<li class="account-link">
					<a data-id="#current-orders">
						<span>{{ trans('product.current-orders') }}</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
    <div class="tab-content">
        <div id="prev-orders" class="tab-pane active">
            @include('user.orders-completed-table', ['orders' => $orders, 'status' => true])
        </div>
        <div id="current-orders" class="tab-pane">
            @include('user.orders-pending-table', ['orders' => $orders, 'status' => false])
        </div>
    </div>
</div>
