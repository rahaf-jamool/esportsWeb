@include('layouts.message')
{{--{{dd($user)}}--}}
<div class="card checkout-area pt-30 pb-30">
	<div class="your-order">
		<div class="row ">
			<div class="col-12"></div>
			<h4 class="p-4 text-center">{{ trans('site.electronicservices') }}</h4>
			<div class="services">
				<a class="service chooseType" href="#" data-toggle="modal" data-target="#service1" data-type="1">{{trans('site.Issuanceaffiliationcertificate')}}</a></a>
				|<a class="service chooseType" href="#" data-toggle="modal" data-target="#service1"  data-type="2">{{trans('site.Toissuexperiencecertificate')}}</a>
				|<a class="service chooseType" href="#" data-toggle="modal" data-target="#service1"  data-type="3">{{trans('site.Issuancejoiningcertificate')}}</a>
				{{--|<a class=" service" href="#"  id="Membershipcertificate">{{trans('site.Membershipcertificate')}}</a>--}}
				|<a class="service" href="{{ url(App::getLocale() . '/show-certification/Membershipcertificate') }}"  target="_blank">{{trans('site.Membershipcertificate')}}</a>
				|<a class="service" href="{{ url(App::getLocale() . '/membership-card-printing') }}"  target="_blank">{{trans('site.Membership-card-printing')}}</a>

			</div>
			<h4 class="p-4 text-center">{{ trans('site.myorders') }}</h4>

			<div class="tab__content">
				<div class="table-container text-center" >
				<table class="table table-striped table-hover" id="order-table">
					<thead>
						<tr>

							<th scope="col">{{ trans('site.codeService') }} </th>
							<th scope="col">{{ trans('site.Servicetype') }} </th>
							<th scope="col">{{ trans('site.requestDate') }} </th>
						{{--	<th scope="col">{{ trans('site.approval') }} </th>--}}
                            <th scope="col">{{ trans('site.status') }} </th>
							<th scope="col">{{ trans('site.operations') }} </th>
						</tr>
					</thead>
					<tbody class="all-services">
						@if (!empty($certificateRequests))
							@foreach($certificateRequests as $certificateRequest)
							<tr id="{{$certificateRequest['id']}}">
							{{--	<td >
									@if($certificateRequest['certificateRequestTypeId'] == '1')
										{{trans('site.Issuanceaffiliationcertificate')}}
									@elseif($certificateRequest['certificateRequestTypeId'] == '2')
										{{trans('site.Toissuexperiencecertificate')}}
									@elseif($certificateRequest['certificateRequestTypeId'] == '3')
										{{trans('site.Issuancejoiningcertificate')}}
									@endif
								</td>--}}
								<td>
									{{$certificateRequest['code']}}
								</td>
								<td>
									{{ (App::getLocale() == 'en')? $certificateRequest['certificateRequestType']['enName'] :  $certificateRequest['certificateRequestType']['name']}}
								</td>
								<td>{{ \Carbon\Carbon::parse($certificateRequest['requestDate'] )->format('d/m/Y')}}</td>

								{{--<td>
								@if($certificateRequest['isGranted'])
									<p style="Color:green; font-weight: bold;">
									{{ trans('site.order-received') }}
									</p>
								@else
									<p style="Color:orange; font-weight: bold;">
										{{ trans('site.order-waiting') }}
									</p>
								@endif
								</td>--}}
								<td>
									@if($certificateRequest['state'] == "Accepted")
										<p style="Color:green; font-weight: bold;">
											{{ trans('site.order-received') }}
										</p>
									@elseif($certificateRequest['state'] == "Refused")
										<p style="Color:red; font-weight: bold;">
											{{ trans('site.order-Refused') }}
										</p>
									@else
										<p style="Color:orange; font-weight: bold;">
											{{ trans('site.order-waiting') }}
										</p>
									@endif
								</td>
								<td >
									<span data-id="{{$certificateRequest['id']}}" class="m-1 show-service btn btn-success">{{ trans('site.details') }}</span>
									<span data-id="{{$certificateRequest['id']}}" class="m-1 edit-service btn btn-primary">{{ trans('site.edit') }}</span>
									<span data-id="{{$certificateRequest['id']}}" class="m-1 delete-service btn btn-danger">{{ trans('site.delete') }}</span>
								</td>
							</tr>
							@endforeach
						@endif
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- service1 modal -->
<div class="modal fade" id="service1" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">{{ trans('site.electronicservices') }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3 class="title-service"></h3>

		<div class="col-12 col-lg-9 form-request">
			@include('layouts.message')
			<form class="form-horizontal" id="onlineServicesForm" role="form" method="POST" action="#">
				{{ csrf_field() }}
				<input type="hidden" value="" name="CertificateRequestTypeId" id="CertificateRequestTypeId">
				<div class="form-group required {{ $errors->has('description') ? ' has-error' : '' }}">
					<span>  </span><label for="description" class="col-md-4 control-label pb-2 pt-2">{{trans('site.description')}}</label>

					<div class="col-sm-12">
						<textarea id="descService1" name="description" rows="4" cols="50" maxlength="200"  class="form-control input-player"></textarea>
					</div>
					@if ($errors->has('description'))
						<span class="help-block">
							<strong>{{ $errors->first('description') }}</strong>
						</span>
					@endif
				</div>
            </form>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('site.cancel')}}</button>
        <button type="button" class="btn btn-primary certificateRequest" id="certificateRequest">{{trans('site.send')}}</button>
      </div>
    </div>
  </div>
</div>
<!--start  show service 1 -->
<!-- service1 modal -->
<div class="modal fade show-service1" id="show-service1" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">{{ trans('site.electronicservices') }}</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3 class="nameofservice"></h3>

		<div class="col-12 col-lg-9 form-request">
			<div class="col-12">
				<div class="col-12">
					{{trans('site.codeService')}}
				</div>
				<div class="col-12 content">
					<p class="codeService"></p>
				</div>
			</div>
			<div class="col-12">
				<div class="col-12">
					{{trans('site.description')}}
				</div>
				<div class="col-12 content">
					<p class="description"></p>
				</div>
			</div>
			<div class="col-12">
				<div class="col-12">
					{{trans('site.requestDate')}}
				</div>
				<div class="col-12 content">
					<p class="requestDate"></p>
				</div>
			</div>

			<div class="col-12">
				<div class="col-12">
					{{ trans('site.status') }}
				</div>
				<div class="col-12 content status">
					<p class="received" style="Color:green; font-weight: bold; display:none">
						{{ trans('site.order-received') }}
					</p>

					<p class="waiting" style="Color:orange; font-weight: bold; display:none">
						{{ trans('site.order-waiting') }}
					</p>
				</div>
			</div>
			<div class="col-12 approvaldate" style="display:none">
				<div class="col-12">
					{{ trans('site.approvaldate') }}
				</div>
				<div class="col-12 content">
					<p class="approvalDateValue"></p>
				</div>
			</div>
			<div class="col-12 download" style="display:none">
				<div class="col-12">
					{{ trans('site.CertificationFile') }}
				</div>
				<div class="col-12 content file">
				</div>
			</div>

		</div>
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{trans('site.ok')}}</button>
      </div>
    </div>
  </div>
</div>
<!--end show service 1 -->

<!-- service1 edit modal -->
<div class="modal fade serviceEdit" id="serviceEdit" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">{{ trans('site.electronicservices') }}</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <h3 class="nameofservice"></h3>

		<div class="col-12 col-lg-9 form-request">
			@include('layouts.message')
			<form class="form-horizontal" id="onlineServicesEditForm" role="form" method="POST" action="#">
				{{ csrf_field() }}
				<input type="hidden" value="" name="CertificateRequestTypeId" id="CertificateRequestTypeIdEdit">
				<input type="hidden" value="" name="Id" id="idService">

				<div class="col-12">
					<div class="col-12">
						{{trans('site.codeService')}}
					</div>
					<div class="col-12 content">
						<p id="codeService"></p>
					</div>
				</div>
				<div class="form-group required {{ $errors->has('description') ? ' has-error' : '' }}">
					<span>  </span><label for="description" class="col-md-4 control-label pb-2 pt-2">{{trans('site.description')}}</label>

					<div class="col-sm-12">
						<textarea id="descServiceEdit" name="description" rows="4" cols="50" maxlength="200"  class="form-control input-player"></textarea>
					</div>
					@if ($errors->has('description'))
						<span class="help-block">
							<strong>{{ $errors->first('description') }}</strong>
						</span>
					@endif
				</div>

		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{trans('site.cancel')}}</button>
        <button type="button" class="btn btn-primary certificateEditRequest" id="certificateEditRequest">{{trans('site.edit')}}</button>
       {{-- <button type="button" class="btn btn-danger certificateDeleteRequest" id="certificateDeleteRequest">{{trans('site.delete')}}</button>--}}
      </div>
	  </form>
    </div>
  </div>
</div>
<!--start service1 edit modal -->


@push('js')
<script>
        $(document).ready(function() {
			$(".chooseType").click(function () {
				$('#CertificateRequestTypeId').val($(this).data('type'));
				console.log($(this).data('type'));
				if($(this).data('type') == 1){
					$(".title-service").html("{{trans('site.Issuanceaffiliationcertificate')}}");
				}
				else if($(this).data('type') == '2'){
					$(".title-service").html("{{trans('site.Toissuexperiencecertificate')}}");
				} else {
					$(".title-service").html("{{trans('site.Issuancejoiningcertificate')}}");
				}
			});

            // Certificate Send
            $('.certificateRequest').click(function () {
				let CertificateType = $('.chooseType').data('type');
				let CertificateRequestTypeId = $('input[name="CertificateRequestTypeId"]').val();

				let description = $('textarea[name="description"]').val();

				if (description == '' || description == '' ) {
					swal(
						'{{trans("site.descriptionRequired")}}', {
							icon: "warning",
							button: '{{trans("site.ok")}}',
					});
				} else {
					console.log('CertificateRequestTypeId');
                    console.log(CertificateRequestTypeId);
                    let formData = new FormData();
                        formData.append('_token', '{{ csrf_token() }}');
						formData.append('description', description);
						formData.append('CertificateRequestTypeId', CertificateRequestTypeId);
    				$.ajax({
                            url: '{{ url(App::getLocale() . '/send-certificate-request') }}',
                            type: 'POST',
                            processData: false,
                            contentType: false,
                            data: formData,
                            beforeSend: function () {

                            },
                            error: function (response) {
								swal("Oh noes!", "The AJAX request failed!", "error");
                            },
                            success: function (response) {
								console.log(response);
								 console.log(response.result);

								var date = new Date(response.success.result.requestDate); // Or your date here
								var requestDate = (date.getMonth() + 1) + '/' + date.getDate() + '/' +  date.getFullYear()
                                /* 	console.log('requestDate',requestDate); */

                                if ( response.success.result.certificateRequestTypeId == 1 ){
                                    certificateRequestType = '{{trans('site.Issuanceaffiliationcertificate')}}' ;
                                } else if ( response.success.result.certificateRequestTypeId == 2 ){
                                    certificateRequestType = '{{trans('site.Toissuexperiencecertificate')}}' ;
                                } else {
                                    certificateRequestType = '{{trans('site.Issuancejoiningcertificate')}}' ;
                                }


                                $('.all-services').append(
									'<tr id="'+ response.success.result.id +'">\
                                        <td>'+ response.success.result.code +'</td>\
                                        <td>'+ certificateRequestType +'</td>\
                                        <td>' + requestDate +'</td>\
                                        <td>\
                                            <p style="Color:orange; font-weight: bold;">\
                                                {{ trans('site.order-waiting') }}\
                                            </p>\
                                        </td>\
                                        <td>\
                                            <span data-id="'+ response.success.result.id +'" class="m-1 show-service btn btn-success">{{ trans('site.details') }}</span>\
                                            <span data-id="'+ response.success.result.id +'" class="m-1 edit-service btn btn-primary">{{ trans('site.edit') }}</span>\
                                            <span data-id="'+ response.success.result.id +'" class="m-1 delete-service btn btn-danger">{{ trans('site.delete') }}</span>\
                                        </td>\
                                    </tr>'
								);

								$('#service1').fadeOut();
								swal(
									'{{trans("site.requestsuccessfully")}}', {
										icon: "success",
										button: '{{trans("site.ok")}}',
								});
								$('.modal-backdrop').remove();
								$("#onlineServicesForm").trigger("reset");
                            }
                        });
				}

            });

			 // Certificate show-service
			$(document).on("click", ".show-service" , function() {
				let serviceID = $(this).data('id');
							let urlService = '{{ url(App::getLocale() . '/show-certificate-request') }}';
							let newUrl = urlService + '/' + serviceID;
							console.log(serviceID);
							console.log(urlService);
							console.log(newUrl);
							$(".show-service1 .download .file").empty();
							let formData = new FormData();
									formData.append('_token', '{{ csrf_token() }}');
							$.ajax({
										url: newUrl,
										type: 'Get',
										processData: false,
										contentType: false,
										data: formData,
										beforeSend: function () {

										},
										error: function (response) {

											console.log(response);
										},
										success: function (response) {
											console.log(response);
											console.log(response.success);
											console.log(response.success.id);
											var	$certId = response.success.id;


											var date = new Date(response.success.requestDate); // Or your date here
											var requestDate = (date.getMonth() + 1) + '/' + date.getDate() + '/' +  date.getFullYear()

											var grantDate = new Date(response.success.grantDate); // Or your date here
											var grantDateValue = (grantDate.getMonth() + 1) + '/' + grantDate.getDate() + '/' +  grantDate.getFullYear()

											/* console.log(response.success.description);
											console.log(response.description); */
											if("{{App::getLocale() == 'en'}}"){
												$('.show-service1 .nameofservice').html(response.success.certificateRequestType.enName);
											}else{
												$('.show-service1 .nameofservice').html(response.success.certificateRequestType.name);
											}


											$('.show-service1 .codeService').html(response.success.code);
											$('.show-service1 .description').html(response.success.description);
											$('.show-service1 .requestDate').html(requestDate);

											/* $(response.success.attachments).each(function() {
												$('.show-service1 .download .file').append(
													'<div>\
													<a href="http://api.emiratesesports.net/'+ this.path +'" target="_blank">\
														<p>'+this.name +'</p>\
													</a>\
												</div>'
												);
											});
 													*/

 										var $certID = response.success.id;
										/* 	$('.show-service1 .file').html(response.success.description); */
											if( response.success.state == "Accepted" ){
												$('.show-service1 .download .file').append(
													'<div>\
													<a href="{{ url(App::getLocale())}}' + '/download-certification/' +  $certID +'" target="_blank">\
														<p class="btn btn-success">'+ '{{trans("site.show")}}' +'</p>\
													</a>\
												</div>');
												$(".show-service1 .waiting").css("display", "none");
												$(".show-service1 .received").css("display", "block");
												$(".show-service1 .download").css("display", "block");
												$(".show-service1 .approvaldate").css("display", "block");
												$('.show-service1 .approvalDateValue').html(grantDateValue);



											} else {
												$(".show-service1 .download").css("display", "none");
												$(".show-service1 .approvaldate").css("display", "none");
												$(".show-service1 .received").css("display", "none");
												$(".show-service1 .waiting").css("display", "block");
												$(".show-service1 .download").css("display", "none");
												$('.show-service1 .approvalDateValue').html('');

											}


											$(".show-service1").modal("toggle");



										}
									});
			});


			 // Certificate edit-service modal
			$(document).on("click", ".edit-service" , function() {
							let serviceID = $(this).data('id');
							let urlService = '{{ url(App::getLocale() . '/show-certificate-request') }}';
							let newUrl = urlService + '/' + serviceID;
						//	console.log(serviceID);
						//	console.log(urlService);
						//	console.log(newUrl);

								let formData = new FormData();
									formData.append('_token', '{{ csrf_token() }}');
							$.ajax({
										url: newUrl,
										type: 'Get',
										processData: false,
										contentType: false,
										data: formData,
										beforeSend: function () {

										},
										error: function (response) {

											console.log(response);
										},
										success: function (response) {
											console.log(response);


											if("{{App::getLocale() == 'en'}}"){
												$('.serviceEdit .nameofservice').html(response.success.certificateRequestType.enName);
											}else{
												$('.serviceEdit .nameofservice').html(response.success.certificateRequestType.name);
											}

											$('.serviceEdit #codeService').html(response.success.code);
											$('.serviceEdit #descServiceEdit').html(response.success.description);
											$('.serviceEdit #CertificateRequestTypeIdEdit').val(response.success.certificateRequestTypeId);
											$('.serviceEdit #idService').val(response.success.id);

											$(".serviceEdit").modal("toggle");

										}
									});


			});


			// Certificate Send edit-service modal
			$('.certificateEditRequest').click(function () {
				let serviceID = $('#idService').val();
				let urlService = '{{ url(App::getLocale() . '/send-certificate-edit-request') }}';
				let newUrl = urlService + '/' + serviceID;


				let CertificateType = $('.chooseType').data('type');
				let CertificateRequestTypeId = $('#CertificateRequestTypeIdEdit').val();

				let description = $('#descServiceEdit').val();

				if(description ==''  ||  description =='' ){
					swal(
						'{{trans("site.descriptionRequired")}}', {
							icon: "warning",
							button: '{{trans("site.ok")}}',
					});

				}else{
				console.log('CertificateRequestTypeId');
				console.log(CertificateRequestTypeId);
				console.log('description');
				console.log(description);
				let formData = new FormData();
                        formData.append('_token', '{{ csrf_token() }}');
                        formData.append('_method', 'PUT');
						formData.append('description', description);
						formData.append('CertificateRequestTypeId', CertificateRequestTypeId);
						formData.append('Id', serviceID);

				$.ajax({
                            url: newUrl,
                            type: 'POST',
                            processData: false,
                            contentType: false,
                            data: formData,
                            beforeSend: function () {

                            },
                            error: function (response) {

								swal("Oh noes!", "The AJAX request failed!", "error");
                            },
                            success: function (response) {
								console.log('response');
								console.log(response);
								 console.log(response.result);
							//	console.log(response.success.result.id);

								$('#serviceEdit').fadeOut();
								swal(
									'{{trans("site.requestEditsuccessfully")}}', {
										icon: "success",
										button: '{{trans("site.ok")}}',
								});

								$('.modal-backdrop').remove();
								$("#onlineServicesEditForm").trigger("reset");
                            }
                        });
				}
            });
			// Certificate Send delete-service modal with edit
			/* $('.certificateDeleteRequest').click(function () {
				let serviceID = $('#idService').val();
				let urlService = '{{ url(App::getLocale() . '/send-certificate-edit-request') }}';
				let newUrl = urlService + '/' + serviceID;


				let CertificateType = $('.chooseType').data('type');
				let CertificateRequestTypeId = $('#CertificateRequestTypeIdEdit').val();

				let description = $('#descServiceEdit').val();

				if(description ==''  ||  description =='' ){
					swal(
						'{{trans("site.descriptionRequired")}}', {
							icon: "warning",
							button: '{{trans("site.ok")}}',
					});

				}else{
				console.log('CertificateRequestTypeId');
				console.log(CertificateRequestTypeId);
				console.log('description');
				console.log(description);
				let formData = new FormData();
                        formData.append('_token', '{{ csrf_token() }}');
                        formData.append('_method', 'PUT');
						formData.append('description', description);
						formData.append('CertificateRequestTypeId', CertificateRequestTypeId);
						formData.append('Id', serviceID);
						formData.append('state', 'Deleted-By-Client');
						swal({
								title: '{{trans("site.Areyousure")}}',
								text: '{{trans("site.Oncedeleted")}}',
								icon: "warning",
								buttons: ['{{trans("site.cancel")}}', '{{trans("site.ok")}}'],
								dangerMode: true,
								})
								.then((willDelete) => {
								if (willDelete) {
									$.ajax({
										url: newUrl,
										type: 'POST',
										processData: false,
										contentType: false,
										data: formData,
										beforeSend: function () {

										},
										error: function (response) {

											swal("Oh noes!", "The AJAX request failed!", "error");
										},
										success: function (response) {
											$("#" + response.success.result.id ).remove();
											$('#serviceEdit').fadeOut();
											swal(
												'{{trans("site.Deletedsuccessfully")}}', {
													icon: "success",
													button: '{{trans("site.ok")}}',
											});

											$('.modal-backdrop').remove();
											$("#onlineServicesEditForm").trigger("reset");
										}
									});

								} else {

								}
							});

				}
            });
 */
			// Certificate Request delete-service
		 	$(document).on("click", ".delete-service" , function() {
							let serviceTr = $(this);
							let serviceID = $(this).data('id');
							let urlService = '{{ url(App::getLocale() . '/delet-certificate-request') }}';
							let newUrl = urlService + '/' + serviceID;

							swal({
								title: '{{trans("site.Areyousure")}}',
								text: '{{trans("site.Oncedeleted")}}',
								icon: "warning",
								buttons: ['{{trans("site.cancel")}}', '{{trans("site.ok")}}'],
								dangerMode: true,
								})
								.then((willDelete) => {
								if (willDelete) {
									$.ajax({
										url: newUrl,
										type: 'POST',
										dataType: 'JSON',
										data:{
											'_token': '{{ csrf_token() }}',
                                            '_method': 'POST',
											'Id': serviceID,
											'id': serviceID,
										},
										beforeSend: function () {
										},
										success: function () {
											serviceTr.closest("tr").remove();
											swal('{{trans("site.Deletedsuccessfully")}}', {
											icon: "success",
											button: '{{trans("site.ok")}}',
											});
											console.log('DELETED');
										},
										error: function (xhr) {
											console.log(xhr.responseText);
										}
									})
								} else {
								}
							});

			});




			// Certificate download
			$('#Membershipcertificate').click(function (e) {
				e.preventDefault();
				let urlService = '{{ url(App::getLocale() . '/show-certification') }}';


				let formData = new FormData();
                        formData.append('_token', '{{ csrf_token() }}');
                        formData.append('_method', 'GET');

				$.ajax({
                            url: urlService,
                            type: 'GET',
                            processData: false,
                            contentType: false,
                            data: formData,
                            beforeSend: function () {

                            },
                            error: function (response) {
								swal("Oh noes!", "The AJAX request failed!", "error");
                            },
                            success: function (response) {
								console.log(response);
								if(response.success.joinDate === null){
									swal(
									'{{trans("site.notamember")}}', {
										icon: "warning",
										button: '{{trans("site.ok")}}',
									});
								}else{
									var win = window.open('{{ url(App::getLocale() . '/show-certification/Membershipcertificate') }}', '_blank');
									win.focus();
								}

                            }
                        });

            });

	    });
</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


@endpush
