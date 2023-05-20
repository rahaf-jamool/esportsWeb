@include('layouts.message')
{{--{{dd($user)}}--}}
<div class="card checkout-area pt-30 pb-30">
	<div class="your-order">
		<div class="row text-center">
			<div class="col-12"></div>
			<h4 class="p-4">{{ trans('site.SubscribeToEvents') }}</h4>
				
			<table class="table table-striped">
				<thead>
					<tr>
					<th scope="col">#</th>
					<th scope="col">{{ trans('auth.name') }} </th>
					</tr>
				</thead>
				<tbody>
					<tr>
					<th scope="row">1</th>
					<td>Mark</td>
					</tr>
					<tr>
					<th scope="row">2</th>
					<td>Jacob</td>
					</tr>
					<tr>
					<th scope="row">3</th>
					<td>Larry</td>
					</tr>
				</tbody>
			</table>


				
		</div>
	</div>
</div>
