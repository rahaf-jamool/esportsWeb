@include('layouts.message')
{{--{{dd($user)}}--}}
<div class="card checkout-area pt-30 pb-30">
    <div class="your-order">
        <div class="row ">
            <div class="col-12"></div>
            <h4 class="p-4 text-center">{{ trans('site.electronicservices') }}</h4>
            {{--<div id="tab-content-3" class="tab-content details">
                @include('auth.account.online-services-forms.Noobjectionletter', compact('user'))
                @include('auth.account.online-services-forms.Requestorganizeevent', compact('user'))
            </div>--}}
            <div class="services">
                <a class="service" href="#" data-toggle="modal"
                   data-target="#service1">{{trans('site.Noobjectionletter')}}</a>
                |<a class="service" href="#" data-toggle="modal"
                    data-target="#service2">{{trans('site.Requestorganizeevent')}}</a>
                {{--|<a class=" service" href="#"  id="Membershipcertificate">{{trans('site.Membershipcertificate')}}</a>--}}
                |<a class="service" href="{{ url(App::getLocale() . '/show-certification/Membershipcertificate') }}"
                    target="_blank">{{trans('site.Membershipcertificate')}}</a>
                |<a class="service" href="{{ url(App::getLocale() . '/membership-card-printing') }}"
                    target="_blank">{{trans('site.Membership-card-printing')}}</a>

            </div>
            <h4 class="p-4 text-center">{{ trans('site.myorders') }}</h4>

            <div class="tab__content">
                <div class="table-container text-center">
                    <table class="table table-striped table-hover" id="order-table">
                        <thead>
                        <tr>
                            <th scope="col">{{ trans('site.codeService') }} </th>
                            <th scope="col">{{ trans('site.Servicetype') }} </th>
                            <th scope="col">{{ trans('site.requestDate') }} </th>
                            {{--<th scope="col">{{ trans('site.approval') }} </th>--}}
                            <th scope="col">{{ trans('site.status') }} </th>
                            <th scope="col">{{ trans('site.operations') }} </th>
                        </tr>
                        </thead>
                        <tbody class="all-services">
                        @if (!empty($noProblemRequests['result']))
                            @foreach($noProblemRequests['result'] as $noProblemRequest)
                                <tr data-type="serviceRequest" id="{{$noProblemRequest['id']}}">
                                    <td>{{$noProblemRequest['code']}}</td>
                                    <td>{{trans('site.Noobjectionletter')}}</td>
                                    <td>{{ \Carbon\Carbon::parse($noProblemRequest['requestDate'] )->format('d/m/Y')}}</td>
                                    <td>
                                        @if($noProblemRequest['state'] == "Accepted")
                                            <p style="Color:green; font-weight: bold;">
                                                {{ trans('site.order-received') }}
                                            </p>
                                        @elseif($noProblemRequest['state'] == "Refused")
                                            <p style="Color:red; font-weight: bold;">
                                                {{ trans('site.order-Refused') }}
                                            </p>
                                        @else
                                            <p style="Color:orange; font-weight: bold;">
                                                {{ trans('site.order-waiting') }}
                                            </p>
                                        @endif
                                    </td>
                                    {{--<td>
                                        @if($noProblemRequest['isGranted'])
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
                                        <span data-id="{{$noProblemRequest['id']}}"
                                              class="m-1 show-service btn btn-success">{{ trans('site.details') }}</span>
                                        <span data-id="{{$noProblemRequest['id']}}"
                                              class="m-1 edit-service btn btn-primary">{{ trans('site.edit') }}</span>
                                        <span data-id="{{$noProblemRequest['id']}}"
                                              class="m-1 delete-service btn btn-danger">{{ trans('site.delete') }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        @if (!empty($organizationRequests))
                            @foreach($organizationRequests as $organizationRequest)
                                <tr data-type="organizationRequest" id="{{$organizationRequest['id']}}">
                                    <td>{{$organizationRequest['code']}}</td>
                                    <td>{{trans('site.Requestorganizeevent')}}</td>
                                    <td>{{ \Carbon\Carbon::parse($organizationRequest['createdAt'] )->format('d/m/Y')}}</td>
                                    <td>
                                        @if($organizationRequest['eventState'] == "Pending")
                                            <p style="Color:orange; font-weight: bold;">
                                                {{ trans('site.order-waiting') }}
                                            </p>
                                        @elseif($organizationRequest['eventState'] == "Refused")
                                            <p style="Color:red; font-weight: bold;">
                                                {{ trans('site.order-waiting') }}
                                            </p>
                                        @else
                                            <p style="Color:green; font-weight: bold;">
                                                {{ trans('site.order-received') }}
                                            </p>
                                        @endif
                                    </td>

                                    <td>
                                        <span data-id="{{$organizationRequest['id']}}"
                                              class="m-1 show-organization btn btn-success">{{ trans('site.details') }}</span>
                                        <span data-id="{{$organizationRequest['id']}}"
                                              class="m-1 edit-organization btn btn-primary">{{ trans('site.edit') }}</span>
                                        <span data-id="{{$organizationRequest['id']}}"
                                              class="m-1 delete-organization btn btn-danger">{{ trans('site.delete') }}</span>
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
                <h3>{{trans('site.Noobjectionletter')}}</h3>

                <div class="col-12 col-lg-9 form-request">
                    @include('layouts.message')
                    <form class="form-horizontal" id="NoobjectionletterForm" role="form" method="POST" action="#">
                        {{ csrf_field() }}
                        <div class="form-group required {{ $errors->has('description') ? ' has-error' : '' }}">
                            <span>  </span><label for="description"
                                                  class="col-md-9 control-label pb-2 pt-2">{{trans('site.description')}}</label>

                            <div class="col-sm-12">
                                <textarea id="descService1" name="description" rows="4" cols="50"
                                          class="form-control input-player"></textarea>
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
                <button type="button" class="btn btn-primary NoProblemSend"
                        id="NoProblemSend">{{trans('site.send')}}</button>
            </div>
        </div>
    </div>
</div>
<!--start  show service 1 -->
<!-- service1 modal -->
<div class="modal fade show-service1" id="show-service1" tabindex="-1" role="dialog" aria-labelledby="basicModal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">{{ trans('site.electronicservices') }}</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>{{trans('site.Noobjectionletter')}}</h3>

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
                    {{--<div class="col-12 approvaldate" style="display:none">
                        <div class="col-12">
                            {{ trans('site.approvaldate') }}
                        </div>
                        <div class="col-12 content">
                            <p class="approvalDateValue"></p>
                        </div>
                    </div>--}}
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
<!-- service2 modal form -->
<div class="modal fade" id="service2" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">{{ trans('site.electronicservices') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>{{trans('site.Requestorganizeevent')}}</h3>
                <div class="col-12 form-request">
                    @include('layouts.message')
                    <form class="d-flex col-12 flex-wrap form-horizontal" id="OrganizeRequestForm" role="form"
                          method="POST" action="#" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-12 col-md-6 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="name"
                                                                          class="col-9 control-label pb-2 pt-2">{{trans('site.Eventname')}}</label>
                            <div class="col-md-12  ">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                       required autofocus>
                            </div>
                            <small id="name_error" class="form-text text-danger"></small>
                        </div>
                        <div class="col-12 col-md-6 form-group{{ $errors->has('enName') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="enName"
                                                                          class="col-9 control-label  pb-2 pt-2">{{trans('site.EventEnname')}}</label>
                            <div class="col-md-12  ">
                                <input id="enName" type="text" class="form-control" name="enName"
                                       value="{{ old('enName') }}" required autofocus>
                            </div>
                            <small id="enName_error" class="form-text text-danger"></small>
                        </div>
                        <div class="col-12 col-md-6 form-group{{ $errors->has('organizerName') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="organizerName"
                                                                          class="col-9 control-label  pb-2 pt-2">{{trans('site.Organizername')}}</label>
                            <div class="col-md-12  ">
                                <input id="organizerName" type="text" class="form-control" name="organizerName"
                                       value="{{ old('organizerName') }}" required autofocus>
                            </div>
                            <small id="organizerName_error" class="form-text text-danger"></small>

                        </div>
                        <div
                            class="col-12 col-md-6 form-group{{ $errors->has('enOrganizerName') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="enOrganizerName"
                                                                          class="col-9 control-label  pb-2 pt-2">{{trans('site.enOrganizerName')}}</label>
                            <div class="col-md-12  ">
                                <input id="enOrganizerName" type="text" class="form-control" name="enOrganizerName"
                                       value="{{ old('enOrganizerName') }}" required autofocus>
                            </div>
                            <small id="enOrganizerName_error" class="form-text text-danger"></small>

                        </div>
                        <div class="col-12 col-md-6 form-group {{ $errors->has('startDate') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="startDate"
                                                                          class="col-md-9 control-label pb-2 pt-2">{{trans('site.Eventstartdate')}}</label>
                            <div class="col-sm-12">
                                <div class="input-group date">
                                    <input type="date" name="startDate" value="" data-date-format="YYYY-MM-DD"
                                           id="startDate" class="form-control input-player">
                                </div>
                                <small id="startDate_error" class="form-text text-danger"></small>

                            </div>
                        </div>
                        <div class="col-12 col-md-6 form-group {{ $errors->has('startTime') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="startTime"
                                                                          class="col-md-9 control-label pb-2 pt-2">{{trans('site.Eventstarttime')}}</label>
                            <div class="col-sm-12">
                                <div class="input-group date">
                                    <input type="time" name="startTime" value="" data-date-format="YYYY-MM-DD"
                                           id="startTime" class="form-control input-player">
                                </div>
                                <small id="startTime_error" class="form-text text-danger"></small>

                            </div>
                        </div>
                        <div class="col-12 col-md-6 form-group {{ $errors->has('endDate') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="endDate"
                                                                          class="col-md-9 control-label pb-2 pt-2">{{trans('site.Eventendtdate')}}</label>
                            <div class="col-sm-12">
                                <div class="input-group date">
                                    <input type="date" name="endDate" value="" data-date-format="YYYY-MM-DD"
                                           id="endDate" class="form-control input-player">
                                </div>
                                <small id="endDate_error" class="form-text text-danger"></small>

                            </div>
                        </div>
                        <div class="col-12 col-md-6 form-group {{ $errors->has('endTime') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="endTime"
                                                                          class="col-md-9 control-label pb-2 pt-2">{{trans('site.Eventendtime')}}</label>
                            <div class="col-sm-12">
                                <div class="input-group date">
                                    <input type="time" name="endTime" value="" data-date-format="YYYY-MM-DD"
                                           id="endTime" class="form-control input-player">
                                </div>
                                <small id="endTime_error" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div
                            class="col-12 col-md-6 form-group {{ $errors->has('registerStartDate') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="registerStartDate"
                                                                          class="col-md-9 control-label pb-2 pt-2">{{trans('site.Registrationstartdate')}}</label>
                            <div class="col-sm-12">
                                <div class="input-group date">
                                    <input type="date" name="registerStartDate" value="" data-date-format="YYYY-MM-DD"
                                           id="registerStartDate" class="form-control input-player">

                                </div>
                                <small id="registerStartDate_error" class="form-text text-danger"></small>

                            </div>
                        </div>
                        <div
                            class="col-12 col-md-6 form-group {{ $errors->has('registerEndDate') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="registerEndDate"
                                                                          class="col-md-9 control-label pb-2 pt-2">{{trans('site.Registrationexpirydate')}}</label>
                            <div class="col-sm-12">
                                <div class="input-group date">
                                    <input type="date" name="registerEndDate" value="" data-date-format="YYYY-MM-DD"
                                           id="registerEndDate" class="form-control input-player">
                                </div>
                                <small id="registerEndDate_error" class="form-text text-danger"></small>

                            </div>
                        </div>
                        <div
                            class="col-12 col-md-6 form-group residence-only {{ $errors->has('participationType') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="participationType"
                                                                          class="col-md-9 control-label pb-2 pt-2">{{trans('site.subscription-type')}}</label>
                            <div class="col-sm-12">
                                <select name="participationType" id="participationType"
                                        class="form-control jcf-reset-appearance input-player" required>
                                    <option value=""> --- {{trans('individually.please-choose')}} ---</option>
                                    <option value="Individuals">{{trans('site.participationType-Individuals')}}</option>
                                    <option value="Teams">{{trans('site.participationType-Teams')}}</option>
                                </select>
                                <small id="participationType_error" class="form-text text-danger"></small>

                            </div>
                        </div>
                        <div
                            class="col-12 col-md-6 form-group residence-only {{ $errors->has('eventClassificationId') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="eventClassificationId"
                                                                          class="col-md-9 control-label pb-2 pt-2">{{trans('site.event-type')}}</label>
                            <div class="col-sm-12">
                                <select name="eventClassificationId" id="eventClassificationId"
                                        class="form-control jcf-reset-appearance input-player" required>
                                    <option value=""> --- {{trans('individually.please-choose')}} ---</option>

                                    @foreach($EventClassifications as $EventClassification)
                                        <option
                                            value="{{$EventClassification['id']}}">{{ (App::getLocale() == 'en')? $EventClassification['enName'] :  $EventClassification['name']}}</option>
                                    @endforeach
                                </select>
                                <small id="eventClassificationId_error" class="form-text text-danger"></small>

                            </div>
                        </div>
                        <div class="col-12 col-md-6 form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="location"
                                                                          class="col-9 control-label  pb-2 pt-2">{{trans('site.arLocation')}}</label>
                            <div class="col-md-12  ">
                                <input id="location" type="text" class="form-control" name="location"
                                       value="{{ old('location') }}" required autofocus>
                            </div>
                            <small id="location_error" class="form-text text-danger"></small>

                        </div>
                        <div class="col-12 col-md-6 form-group{{ $errors->has('enLocation') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="enLocation"
                                                                          class="col-9 control-label  pb-2 pt-2">{{trans('site.enLocation')}}</label>
                            <div class="col-md-12  ">
                                <input id="enLocation" type="text" class="form-control" name="enLocation"
                                       value="{{ old('enLocation') }}" required autofocus>
                            </div>
                            <small id="enLocation_error" class="form-text text-danger"></small>

                        </div>

                        <div
                            class="col-12 col-md-6 form-group residence-only {{ $errors->has('emirates-personal-passport-photo') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="emirates-personal-passport-photo"
                                                                          class="col-9 control-label pb-2 pt-2">{{trans('site.mainImage')}}</label>
                            <div class="col-sm-12 input-group mb-3">
                                <div class="input-group">
                                    <input type="file" class="form-control" name="mainImage" id="mainImage2"
                                           aria-describedby="uploadFile" aria-label="{{trans('individually.upload')}}">
                                </div>
                                <small id="mainImage_error" class="form-text text-danger"></small>

                            </div>

                        </div>
                        <div
                            class="col-12 col-md-6 form-group residence-only {{ $errors->has('emirates-personal-passport-photo') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="emirates-personal-passport-photo"
                                                                          class="col-9 control-label pb-2 pt-2">{{trans('site.attachments')}}</label>
                            <div class="col-sm-12 input-group mb-3">
                                <div class="input-group">
                                    <input type="file" multiple class="form-control" name="attachments[]"
                                           id="attachments2"
                                           aria-describedby="uploadFile" aria-label="{{trans('individually.upload')}}">
                                </div>
                                <small id="attachments_error" class="form-text text-danger"></small>

                            </div>

                        </div>
                        <div
                            class="col-12 col-md-6 form-group required {{ $errors->has('description') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="description"
                                                                          class="col-md-9 control-label pb-2 pt-2">{{trans('site.Eventinformation')}}</label>
                            <div class="col-sm-12">
                                <textarea id="description2" name="description" rows="4" cols="50"
                                          class="form-control input-player"></textarea>
                            </div>
                            <small id="description_error" class="form-text text-danger"></small>

                        </div>
                        <div
                            class="col-12 col-md-6 form-group required {{ $errors->has('enDescription2') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="enDescription2"
                                                                          class="col-md-9 control-label pb-2 pt-2">{{trans('site.EventEninformation')}}</label>
                            <div class="col-sm-12">
                                <textarea id="enDescription2" name="enDescription2" rows="4" cols="50"
                                          class="form-control input-player"></textarea>
                            </div>
                            <small id="enDescription2_error" class="form-text text-danger"></small>

                        </div>
                        <hr>
                        <h4 class="col-12">{{ trans('site.faq') }}</h4>

                        <div class="tab__content w-100">
                            <div class="table-container text-center">
                                <table class="table table-striped table-hover" id="faq-table">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ trans('site.question') }} </th>
                                        <th scope="col">{{ trans('site.answer') }} </th>
                                        <th scope="col">{{ trans('site.enquestion') }} </th>
                                        <th scope="col">{{ trans('site.enanswer') }} </th>
                                        <th scope="col">{{ trans('site.operations') }} </th>
                                    </tr>
                                    </thead>
                                    <tbody class="faq">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 form-group">
                            <div class="col-12 form-group">
                                <label for="emirates-personal-passport-photo"
                                       class="col-9 control-label pb-2 pt-2">{{trans('site.question')}}</label>
                                <div class="col-sm-12 input-group mb-3">
                                    <div class="input-group">
                                        <input id="question" type="text" class="form-control question" name="question"
                                               autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <label for="emirates-personal-passport-photo"
                                       class="col-9 control-label pb-2 pt-2">{{trans('site.answer')}}</label>
                                <div class="col-sm-12 input-group mb-3">
                                    <div class="input-group">
                                        <input id="answer" type="text" class="form-control answer" name="answer"
                                               autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <label for="emirates-personal-passport-photo"
                                       class="col-9 control-label pb-2 pt-2">{{trans('site.enquestion')}}</label>
                                <div class="col-sm-12 input-group mb-3">
                                    <div class="input-group">
                                        <input id="enquestion" type="text" class="form-control enquestion"
                                               name="enquestion" autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <label for="emirates-personal-passport-photo"
                                       class="col-9 control-label pb-2 pt-2">{{trans('site.enanswer')}}</label>
                                <div class="col-sm-12 input-group mb-3">
                                    <div class="input-group">
                                        <input id="enanswer" type="text" class="form-control enanswer" name="enanswer"
                                               autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button"
                                        class="btn btn-primary addFAQ">{{trans('site.add-question')}}</button>
                            </div>
                        </div>
                        <h4 class="col-12">{{ trans('site.Fee') }}</h4>

                        <div class="tab__content w-100">
                            <div class="table-container text-center">
                                <table class="table table-striped table-hover" id="fee-table">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ trans('site.category') }} </th>
                                        <th scope="col">{{ trans('site.feeValue') }} </th>
                                        <th scope="col">{{ trans('site.encategory') }} </th>
                                        <th scope="col">{{ trans('site.enfeeValue') }} </th>
                                        <th scope="col">{{ trans('site.operations') }} </th>
                                    </tr>
                                    </thead>
                                    <tbody class="fee">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 form-group">
                            <div class="col-12 form-group">
                                <label for="emirates-personal-passport-photo"
                                       class="col-9 control-label pb-2 pt-2">{{trans('site.category')}}</label>
                                <div class="col-sm-12 input-group mb-3">
                                    <div class="input-group">
                                        <input id="category" type="text" class="form-control category" name="category"
                                               autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <label for="emirates-personal-passport-photo"
                                       class="col-9 control-label pb-2 pt-2">{{trans('site.feeValue')}}</label>
                                <div class="col-sm-12 input-group mb-3">
                                    <div class="input-group">
                                        <input id="feeValue" type="text" class="form-control feeValue" name="feeValue"
                                               autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <label for="emirates-personal-passport-photo"
                                       class="col-9 control-label pb-2 pt-2">{{trans('site.encategory')}}</label>
                                <div class="col-sm-12 input-group mb-3">
                                    <div class="input-group">
                                        <input id="encategory" type="text" class="form-control encategory"
                                               name="encategory" autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <label for="emirates-personal-passport-photo"
                                       class="col-9 control-label pb-2 pt-2">{{trans('site.enfeeValue')}}</label>
                                <div class="col-sm-12 input-group mb-3">
                                    <div class="input-group">
                                        <input id="enfeeValue" type="text" class="form-control enfeeValue"
                                               name="enfeeValue" autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-primary addFee">{{trans('site.add-fee')}}</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('site.cancel')}}</button>
                <button type="button" class="btn btn-primary OrganizationRequests">{{trans('site.send')}}</button>
            </div>
        </div>
    </div>
</div>
<!--start  show service 2  form-->
<!-- service2 modal  -->
<div class="modal fade show-service2" id="show-service2" tabindex="-1" role="dialog" aria-labelledby="basicModal"
     aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">{{ trans('site.electronicservices') }}</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>{{trans('site.Requestorganizeevent')}}</h3>

                <div class="d-flex flex-wrap">
                    <div class="col-12">
                        <div class="col-12 mainImage text-center">
                            <img src="" alt="" class="mainImagePath" style="height: 250px;">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="col-12">
                            {{trans('site.codeService')}}
                        </div>
                        <div class="col-12 content">
                            <p class="codeService"></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
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
                    <div class="col-12 col-md-6">
                        <div class="col-12">
                            {{trans('site.Eventname')}}
                        </div>
                        <div class="col-12 content">
                            <p class="eventname"></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="col-12">
                            {{trans('site.EventEnname')}}
                        </div>
                        <div class="col-12 content">
                            <p class="eventenName"></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="col-12">
                            {{trans('site.Organizername')}}
                        </div>
                        <div class="col-12 content">
                            <p class="organizerName"></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="col-12">
                            {{trans('site.enOrganizerName')}}
                        </div>
                        <div class="col-12 content">
                            <p class="enOrganizerName"></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="col-12">
                            {{trans('site.Eventstartdate')}}
                        </div>
                        <div class="col-12 content">
                            <p class="startDate"></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="col-12">
                            {{trans('site.Eventstarttime')}}
                        </div>
                        <div class="col-12 content">
                            <p class="Eventstarttime"></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="col-12">
                            {{trans('site.Expirydate')}}
                        </div>
                        <div class="col-12 content">
                            <p class="endDate"></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="col-12">
                            {{trans('site.Eventendtime')}}
                        </div>
                        <div class="col-12 content">
                            <p class="Eventendtime"></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="col-12">
                            {{trans('site.Registrationstartdate')}}
                        </div>
                        <div class="col-12 content">
                            <p class="registerStartDate"></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="col-12">
                            {{trans('site.Registrationexpirydate')}}
                        </div>
                        <div class="col-12 content">
                            <p class="registerEndDate"></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="col-12">
                            {{trans('site.subscription-type')}}
                        </div>
                        <div class="col-12 content">
                            <p class="participationType"></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="col-12">
                            {{trans('site.event-type')}}
                        </div>
                        <div class="col-12 content">
                            <p class="eventtype"></p>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="col-12">
                            {{trans('site.arLocation')}}
                        </div>
                        <div class="col-12 content">
                            <p class="location"></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="col-12">
                            {{trans('site.enLocation')}}
                        </div>
                        <div class="col-12 content">
                            <p class="enLocation"></p>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="col-12">
                            {{trans('site.Eventinformation')}}
                        </div>
                        <div class="col-12 content">
                            <p class="description"></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="col-12">
                            {{trans('site.EventEninformation')}}
                        </div>
                        <div class="col-12 content">
                            <p class="enDescription"></p>
                        </div>
                    </div>

                    <div class="faq2 col-12" style="display:none">
                        <h4>{{trans('site.faq')}}</h4>
                        <div class="tab__content w-100">
                            <div class="table-container text-center">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ trans('site.question') }} </th>
                                        <th scope="col">{{ trans('site.answer') }} </th>
                                    </tr>
                                    </thead>
                                    <tbody class="faq-types2">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="Fee col-12" style="display:none">
                        <h4>{{trans('site.Fee')}}</h4>
                        <div class="tab__content w-100">
                            <div class="table-container text-center">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ trans('site.category') }} </th>
                                        <th scope="col">{{ trans('site.feeValue') }} </th>
                                    </tr>
                                    </thead>
                                    <tbody class="fee-types">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="col-12 images">
                            {{trans('site.Images')}}
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
<!--end show service  -->
<!-- service1 edit modal -->
<div class="modal fade serviceEdit2" id="serviceEdit2" tabindex="-1" role="dialog" aria-labelledby="basicModal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">{{ trans('site.electronicservices') }}</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>{{trans('site.Noobjectionletter')}}</h3>

                <div class="col-12 col-lg-9 form-request">
                    @include('layouts.message')
                    <form class="form-horizontal" id="onlineServicesEditForm" role="form" method="POST" action="#">
                        {{ csrf_field() }}
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
                            <span>  </span><label for="description"
                                                  class="col-md-9 control-label pb-2 pt-2">{{trans('site.description')}}</label>

                            <div class="col-sm-12">
                                <textarea id="descServiceEdit" name="description" rows="4" cols="50"
                                          class="form-control input-player"></textarea>
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
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{trans('site.cancel')}}</button>
                <button type="button" class="btn btn-primary NonObjectionEditRequest"
                        id="NonObjectionEditRequest">{{trans('site.edit')}}</button>
                {{--  <button type="button" class="btn btn-danger NonObjectionDeleteRequest" id="NonObjectionDeleteRequest">{{trans('site.delete')}}</button>--}}
            </div>
            </form>
        </div>
    </div>
</div>
<!--start service1 edit modal -->

<!-- start service2 edit modal -->
<div class="modal fade serviceEdit3" id="serviceEdit3" tabindex="-1" role="dialog" aria-labelledby="basicModal"
     aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">{{ trans('site.electronicservices') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>{{trans('site.Requestorganizeevent')}}</h3>
                <div class="col-12 form-request">
                    @include('layouts.message')
                    <form class="d-flex col-12 flex-wrap form-horizontal" id="OrganizeEditRequestForm" role="form"
                          method="POST" action="#" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" value="" name="Id" id="idOrganizeEvent">
                        <input type="hidden" value="" name="mainImagePath" id="mainImagePath">


                        <div class="col-12 col-md-6 form-group{{ $errors->has('EcodeService') ? ' has-error' : '' }}">
                            <label for="EcodeService"
                                   class="col-9 control-label  pb-2 pt-2">{{trans('site.codeService')}}</label>
                            <div class="col-md-12  ">
                                <input id="EcodeService" type="text" class="form-control" name="code"
                                       value="{{ old('EcodeService') }}" required disabled>
                            </div>
                            <small id="code_error" class="form-text text-danger"></small>
                        </div>
                        <div class="col-12 col-md-6 form-group{{ $errors->has('EeventState') ? ' has-error' : '' }}">
                            <label for="EeventState"
                                   class="col-9 control-label  pb-2 pt-2">{{trans('site.codeService')}}</label>
                            <div class="col-md-12  ">
                                <input id="EeventState" type="text" class="form-control" name="eventState"
                                       value="{{ old('EeventState') }}" required disabled>
                            </div>
                            <small id="code_error" class="form-text text-danger"></small>
                        </div>

                        <div class="col-12 col-md-6 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="name"
                                                                          class="col-9 control-label  pb-2 pt-2">{{trans('site.Eventname')}}</label>
                            <div class="col-md-12  ">
                                <input id="organizationName" type="text" class="form-control" name="name"
                                       value="{{ old('name') }}" required autofocus>
                            </div>
                            <small id="name_error" class="form-text text-danger"></small>
                        </div>
                        <div class="col-12 col-md-6 form-group{{ $errors->has('enName') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="enName"
                                                                          class="col-9 control-label  pb-2 pt-2">{{trans('site.EventEnname')}}</label>
                            <div class="col-md-12  ">
                                <input id="EnorganizationName" type="text" class="form-control" name="enName"
                                       value="{{ old('enName') }}" required autofocus>
                            </div>
                            <small id="enName_error" class="form-text text-danger"></small>
                        </div>
                        <div class="col-12 col-md-6 form-group{{ $errors->has('organizerName') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="organizerName"
                                                                          class="col-9 control-label  pb-2 pt-2">{{trans('site.Organizername')}}</label>
                            <div class="col-md-12  ">
                                <input id="organizationorganizerName" type="text" class="form-control"
                                       name="organizerName" value="{{ old('organizerName') }}" required autofocus>
                            </div>
                            <small id="organizerName_error" class="form-text text-danger"></small>
                        </div>
                        <div
                            class="col-12 col-md-6 form-group{{ $errors->has('enOrganizerName') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="enOrganizerName"
                                                                          class="col-9 control-label  pb-2 pt-2">{{trans('site.enOrganizerName')}}</label>
                            <div class="col-md-12  ">
                                <input id="EenOrganizerName" type="text" class="form-control" name="enOrganizerName"
                                       value="{{ old('enOrganizerName') }}" required autofocus>
                            </div>
                            <small id="enOrganizerName_error" class="form-text text-danger"></small>
                        </div>
                        <div class="col-12 col-md-6 form-group {{ $errors->has('startDate') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="startDate"
                                                                          class="col-md-9 control-label pb-2 pt-2">{{trans('site.Eventstartdate')}}</label>
                            <div class="col-sm-12">
                                <div class="input-group date">
                                    <input type="date" name="startDate" value="" id="EventStartDate"
                                           class="form-control input-player">
                                </div>
                                <small id="startDate_error" class="form-text text-danger"></small>

                            </div>
                        </div>
                        <div class="col-12 col-md-6 form-group {{ $errors->has('startTime') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="startTime"
                                                                          class="col-md-9 control-label pb-2 pt-2">{{trans('site.Eventstarttime')}}</label>
                            <div class="col-sm-12">
                                <div class="input-group date">
                                    <input type="time" name="startTime" value="" id="EventStartTime"
                                           class="form-control input-player">
                                </div>
                                <small id="startTime_error" class="form-text text-danger"></small>

                            </div>
                        </div>
                        <div class="col-12 col-md-6 form-group {{ $errors->has('endDate') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="endDate"
                                                                          class="col-md-9 control-label pb-2 pt-2">{{trans('site.Eventendtdate')}}</label>
                            <div class="col-sm-12">
                                <div class="input-group date">
                                    <input type="date" name="endDate" value="" id="EventEndDate"
                                           class="form-control input-player">
                                </div>
                                <small id="endDate_error" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 form-group {{ $errors->has('endTime') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="endTime"
                                                                          class="col-md-9 control-label pb-2 pt-2">{{trans('site.Eventendtime')}}</label>
                            <div class="col-sm-12">
                                <div class="input-group date">
                                    <input type="time" name="endTime" value="" id="EventEndTime"
                                           class="form-control input-player">
                                </div>
                                <small id="endTime_error" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div
                            class="col-12 col-md-6 form-group {{ $errors->has('registerStartDate') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="registerStartDate"
                                                                          class="col-md-9 control-label pb-2 pt-2">{{trans('site.Registrationstartdate')}}</label>
                            <div class="col-sm-12">
                                <div class="input-group date">
                                    <input type="date" name="registerStartDate" value="" id="EventregisterStartDate"
                                           class="form-control input-player">

                                </div>
                                <small id="registerStartDate_error" class="form-text text-danger"></small>

                            </div>
                        </div>
                        <div
                            class="col-12 col-md-6 form-group {{ $errors->has('registerEndDate') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="registerEndDate"
                                                                          class="col-md-9 control-label pb-2 pt-2">{{trans('site.Registrationexpirydate')}}</label>
                            <div class="col-sm-12">
                                <div class="input-group date">
                                    <input type="date" name="registerEndDate" value="" id="EventregisterEndDate"
                                           class="form-control input-player">
                                </div>
                                <small id="registerEndDate_error" class="form-text text-danger"></small>

                            </div>
                        </div>
                        <div
                            class="col-12 col-md-6 form-group residence-only {{ $errors->has('participationType') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="participationType"
                                                                          class="col-md-9 control-label pb-2 pt-2">{{trans('site.subscription-type')}}</label>
                            <div class="col-sm-12">
                                <select name="participationType" id="participationType"
                                        class="form-control jcf-reset-appearance input-player" required>
                                    <option value=""> --- {{trans('individually.please-choose')}} ---</option>
                                    <option value="Individuals">{{trans('site.participationType-Individuals')}}</option>
                                    <option value="Teams">{{trans('site.participationType-Teams')}}</option>
                                </select>
                                <small id="participationType_error" class="form-text text-danger"></small>

                            </div>
                        </div>
                        <div
                            class="col-12 col-md-6 form-group residence-only {{ $errors->has('eventClassificationId') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="eventClassificationId"
                                                                          class="col-md-9 control-label pb-2 pt-2">{{trans('site.event-type')}}</label>
                            <div class="col-sm-12">
                                <select name="eventClassificationId" id="eventClassificationIdEdit"
                                        class="form-control jcf-reset-appearance input-player" required>
                                    <option value=""> --- {{trans('individually.please-choose')}} ---</option>

                                    @foreach($EventClassifications as $EventClassification)
                                        <option
                                            value="{{$EventClassification['id']}}">{{ (App::getLocale() == 'en')? $EventClassification['enName'] :  $EventClassification['name']}}</option>
                                    @endforeach
                                </select>
                                <small id="eventClassificationId_error" class="form-text text-danger"></small>

                            </div>
                        </div>
                        <div class="col-12 col-md-6 form-group{{ $errors->has('arLocation') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="arLocation"
                                                                          class="col-9 control-label  pb-2 pt-2">{{trans('site.arLocation')}}</label>
                            <div class="col-md-12  ">
                                <input id="organizationlocation" type="text" class="form-control" name="location"
                                       value="{{ old('arLocation') }}" required autofocus>
                            </div>
                            <small id="arLocation_error" class="form-text text-danger"></small>

                        </div>
                        <div class="col-12 col-md-6 form-group{{ $errors->has('enLocation') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="enLocation"
                                                                          class="col-9 control-label  pb-2 pt-2">{{trans('site.enLocation')}}</label>
                            <div class="col-md-12  ">
                                <input id="organizationEnlocation" type="text" class="form-control" name="enLocation"
                                       value="{{ old('enLocation') }}" required autofocus>
                            </div>
                            <small id="enLocation_error" class="form-text text-danger"></small>

                        </div>

                        <div
                            class="col-12 col-md-6 form-group required {{ $errors->has('description') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="description"
                                                                          class="col-md-9 control-label pb-2 pt-2">{{trans('site.Eventinformation')}}</label>
                            <div class="col-sm-12">
                                <textarea id="organizationdesc" name="description" rows="4" cols="50"
                                          class="form-control input-player"></textarea>
                            </div>
                            <small id="description_error" class="form-text text-danger"></small>
                        </div>
                        <div
                            class="col-12 col-md-6 form-group required {{ $errors->has('enDescription') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span><label for="enDescription"
                                                                          class="col-md-9 control-label pb-2 pt-2">{{trans('site.EventEninformation')}}</label>
                            <div class="col-sm-12">
                                <textarea id="organizationEndesc" name="enDescription" rows="4" cols="50"
                                          class="form-control input-player"></textarea>
                            </div>
                            <small id="enDescription_error" class="form-text text-danger"></small>
                        </div>
                        <div
                            class="col-12 col-md-6 form-group residence-only {{ $errors->has('emirates-personal-passport-photo') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span>
                            <label for="emirates-personal-passport-photo"
                                   class="col-9 control-label pb-2 pt-2">{{trans('site.mainImage')}}</label>
                            <div class="col-sm-12 input-group mb-3">
                                <div class="input-group">
                                    <input type="file" class="form-control" name="mainImage" id="mainImage3"
                                           accept=".jfif,.jpg,.jpeg,.png,.gif"
                                           aria-describedby="uploadFile" aria-label="{{trans('individually.upload')}}">
                                </div>
                                <div id="divImageMediaPreview"></div>
                                <small id="mainImage_error" class="form-text text-danger"></small>

                            </div>
                        </div>
                        <div class="col-12"></div>

                        <div
                            class="col-12 col-md-6 form-group residence-only {{ $errors->has('emirates-personal-passport-photo') ? ' has-error' : '' }}">
                            <span class="col-1 asterisks">* </span>
                            <label for="emirates-personal-passport-photo"
                                   class="col-9 control-label pb-2 pt-2">{{trans('site.attachments')}}</label>
                            <div class="col-sm-12 input-group mb-3">
                                <div class="input-group">
                                    <input type="file" multiple class="form-control" name="attachments[]"
                                           id="attachments3"
                                           aria-describedby="uploadFile" aria-label="{{trans('individually.upload')}}">
                                </div>
                                <div id="divattachmentsMediaPreview"></div>
                                <small id="attachments_error" class="form-text text-danger"></small>
                            </div>
                        </div>

                        <hr>
                        <h4 class="col-12">{{ trans('site.faq') }}</h4>

                        <div class="tab__content w-100">
                            <div class="table-container text-center">
                                <table class="table table-striped table-hover" id="faq-table">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ trans('site.arquestion') }} </th>
                                        <th scope="col">{{ trans('site.aranswer') }} </th>
                                        <th scope="col">{{ trans('site.enquestion') }} </th>
                                        <th scope="col">{{ trans('site.enanswer') }} </th>
                                        <th scope="col">{{ trans('site.operations') }} </th>
                                    </tr>
                                    </thead>
                                    <tbody class="faq faq-typesEdit">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 form-group FAQEdit">
                            <div class="col-12 form-group">
                                <label for="emirates-personal-passport-photo"
                                       class="col-9 control-label pb-2 pt-2">{{trans('site.arquestion')}}</label>
                                <div class="col-sm-12 input-group mb-3">
                                    <div class="input-group">
                                        <input id="question" type="text" class="form-control question" name="question"
                                               autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <label for="emirates-personal-passport-photo"
                                       class="col-9 control-label pb-2 pt-2">{{trans('site.aranswer')}}</label>
                                <div class="col-sm-12 input-group mb-3">
                                    <div class="input-group">
                                        <input id="answer" type="text" class="form-control answer" name="answer"
                                               autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <label for="emirates-personal-passport-photo"
                                       class="col-9 control-label pb-2 pt-2">{{trans('site.enquestion')}}</label>
                                <div class="col-sm-12 input-group mb-3">
                                    <div class="input-group">
                                        <input id="enquestion" type="text" class="form-control enquestion"
                                               name="enquestion" autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <label for="emirates-personal-passport-photo"
                                       class="col-9 control-label pb-2 pt-2">{{trans('site.enanswer')}}</label>
                                <div class="col-sm-12 input-group mb-3">
                                    <div class="input-group">
                                        <input id="enanswer" type="text" class="form-control enanswer" name="enanswer"
                                               autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button"
                                        class="btn btn-primary addFAQEdit">{{trans('site.add-question')}}</button>
                            </div>
                        </div>
                        <h4 class="col-12">{{ trans('site.Fee') }}</h4>

                        <div class="tab__content w-100">
                            <div class="table-container text-center">
                                <table class="table table-striped table-hover" id="fee-table">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ trans('site.arcategory') }} </th>
                                        <th scope="col">{{ trans('site.arfeeValue') }} </th>
                                        <th scope="col">{{ trans('site.encategory') }} </th>
                                        <th scope="col">{{ trans('site.enfeeValue') }} </th>
                                        <th scope="col">{{ trans('site.operations') }} </th>
                                    </tr>
                                    </thead>
                                    <tbody class="fee fee-typesEdit">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 form-group FeeEdit">

                            <div class="col-12 form-group">
                                <label for="emirates-personal-passport-photo"
                                       class="col-9 control-label pb-2 pt-2">{{trans('site.arcategory')}}</label>
                                <div class="col-sm-12 input-group mb-3">
                                    <div class="input-group">
                                        <input id="category" type="text" class="form-control category" name="category"
                                               autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group ">
                                <label for="emirates-personal-passport-photo"
                                       class="col-9 control-label pb-2 pt-2">{{trans('site.arfeeValue')}}</label>
                                <div class="col-sm-12 input-group mb-3">
                                    <div class="input-group">
                                        <input id="feeValue" type="text" class="form-control feeValue" name="feeValue"
                                               autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <label for="emirates-personal-passport-photo"
                                       class="col-9 control-label pb-2 pt-2">{{trans('site.encategory')}}</label>
                                <div class="col-sm-12 input-group mb-3">
                                    <div class="input-group">
                                        <input id="encategory" type="text" class="form-control encategory"
                                               name="encategory" autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group ">
                                <label for="emirates-personal-passport-photo"
                                       class="col-9 control-label pb-2 pt-2">{{trans('site.enfeeValue')}}</label>
                                <div class="col-sm-12 input-group mb-3">
                                    <div class="input-group">
                                        <input id="enfeeValue" type="text" class="form-control enfeeValue"
                                               name="enfeeValue" autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button"
                                        class="btn btn-primary addFeeEdit">{{trans('site.add-fee')}}</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('site.cancel')}}</button>
                <button type="button" class="btn btn-primary OrganizationEditRequests">{{trans('site.edit')}}</button>
                {{--<button type="button" class="btn btn-danger OrganizationDeleteRequests">{{trans('site.delete')}}</button>--}}
            </div>
        </div>
    </div>
</div>
<!--end edit service 2 -->
@push('js')

    <script>
        $(document).ready(function () {
            // addFAQ
            $('.addFAQ').click(function () {
                let question = $('input[name="question"]').val();
                let enquestion = $('input[name="enquestion"]').val();
                let answer = $('input[name="answer"]').val();
                let enanswer = $('input[name="enanswer"]').val();
                console.log(answer);
                if (question == '' || answer == '' || enquestion == '' || enanswer == '') {
                    swal(
                        '{{trans("site.questionanswer")}}', {
                            icon: "warning",
                            button: '{{trans("site.ok")}}',
                        });
                } else {
                    console.log(question);
                    console.log(answer);
                    $('.faq').append(
                        '<tr>\
                        <td><input type="text" class="form-control" name="question1[]" autofocus value="' + question + '"></td>\
						<td><input type="text" class="form-control" name="answer1[]" autofocus value="' + answer + '"></td>\
						<td><input type="text" class="form-control" name="enquestion1[]" autofocus value="' + enquestion + '"></td>\
						<td><input type="text" class="form-control" name="enanswer1[]" autofocus value="' + enanswer + '"></td>\
						<td><span class="btn btn-danger delete">{{ trans('site.delete') }}</span> </td>\
						</tr>'
                    );
                    $('.question').val('');
                    $('.answer').val('');
                    $('.enquestion').val('');
                    $('.enanswer').val('');
                }
            });
            // start addFAQ  Edit
            $('.addFAQEdit').click(function () {
                let question = $('.FAQEdit input[name="question"]').val();
                let answer = $('.FAQEdit input[name="answer"]').val();
                let enquestion = $('.FAQEdit input[name="enquestion"]').val();
                let enanswer = $('.FAQEdit input[name="enanswer"]').val();
                //	console.log(answer);
                if (question == '' || answer == '' || enquestion == '' || enanswer == '') {
                    swal(
                        '{{trans("site.questionanswer")}}', {
                            icon: "warning",
                            button: '{{trans("site.ok")}}',
                        });
                } else {
                    console.log(question);
                    console.log(answer);
                    $('.faq').append(
                        '<tr>\
                        <td style="display:none"><input type="text" class="form-control" name="id1[]" autofocus value="' + 0 + '"></td>\
						<td><input type="text" class="form-control" name="question1[]" autofocus value="' + question + '"></td>\
						<td><input type="text" class="form-control" name="answer1[]" autofocus value="' + answer + '"></td>\
						<td><input type="text" class="form-control" name="enquestion1[]" autofocus value="' + enquestion + '"></td>\
						<td><input type="text" class="form-control" name="enanswer1[]" autofocus value="' + enanswer + '"></td>\
						<td><span class="btn btn-danger delete">{{ trans('site.delete') }}</span> </td>\
						</tr>'
                    );
                    $('.question').val('');
                    $('.answer').val('');
                    $('.enquestion').val('');
                    $('.enanswer').val('');
                }
            });
            // end addFAQ  Edit


            // eventFees
            $('.addFee').click(function () {
                let category = $('input[name="category"]').val();
                let encategory = $('input[name="encategory"]').val();
                let feeValue = $('input[name="feeValue"]').val();
                let enfeeValue = $('input[name="enfeeValue"]').val();
                /* console.log('category');
                console.log(category);
                console.log('feeValue');
                console.log(feeValue); */
                if (category == '' || feeValue == '' || encategory == '' || enfeeValue == '') {
                    swal(
                        '{{trans("site.categoryfeeValue")}}', {
                            icon: "warning",
                            button: '{{trans("site.ok")}}',
                        });

                } else {
                    $('.fee').append(
                        '<tr>\
                        <td><input type="text" class="form-control" name="category1[]" autofocus value="' + category + '"></td>\
									<td><input type="text" class="form-control" name="feeValue1[]" autofocus value="' + feeValue + '"></td>\
									<td><input type="text" class="form-control" name="encategory1[]" autofocus value="' + encategory + '"></td>\
									<td><input type="text" class="form-control" name="enfeeValue1[]" autofocus value="' + enfeeValue + '"></td>\
									<td><span class="btn btn-danger delete">{{ trans('site.delete') }}</span> </td>\
									</tr>'
                    );
                    $('.category').val('');
                    $('.feeValue').val('');
                    $('.encategory').val('');
                    $('.enfeeValue').val('');
                }
            });
            // start addFAQ  Edit
            $('.addFeeEdit').click(function () {
                let category = $('.FeeEdit input[name="category"]').val();
                let feeValue = $('.FeeEdit input[name="feeValue"]').val();
                let encategory = $('.FeeEdit input[name="encategory"]').val();
                let enfeeValue = $('.FeeEdit input[name="enfeeValue"]').val();

                if (category == '' || feeValue == '' || encategory == '' || enfeeValue == '') {
                    swal(
                        '{{trans("site.categoryfeeValue")}}', {
                            icon: "warning",
                            button: '{{trans("site.ok")}}',
                        });

                } else {
                    $('.fee').append(
                        '<tr>\
                        <td><input type="text" class="form-control" name="category1[]" autofocus value="' + category + '"></td>\
									<td><input type="text" class="form-control" name="feeValue1[]" autofocus value="' + feeValue + '"></td>\
									<td><input type="text" class="form-control" name="encategory1[]" autofocus value="' + encategory + '"></td>\
									<td><input type="text" class="form-control" name="enfeeValue1[]" autofocus value="' + enfeeValue + '"></td>\
									<td><span class="btn btn-danger delete">{{ trans('site.delete') }}</span> </td>\
									</tr>'
                    );
                    $('.category').val('');
                    $('.feeValue').val('');
                    $('.encategory').val('');
                    $('.enfeeValue').val('');
                }
            });
            // end addFAQ  Edit
            // delete FAQ  and fee
            $(document).on('click', '.delete', function () {
                swal({
                    title: '{{trans("site.Areyousure")}}',
                    text: '{{trans("site.Oncedeleted")}}',
                    icon: "warning",
                    buttons: ['{{trans("site.cancel")}}', '{{trans("site.ok")}}'],
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            this.closest("tr").remove();
                            swal('{{trans("site.Deletedsuccessfully")}}', {
                                icon: "success",
                            });
                        } else {
                            /* swal("Your imaginary file is safe!"); */
                        }
                    });

            });


            // Noobjectionletter Send (No problem request)
            $('.NoProblemSend').click(function () {
                let description = $('textarea[name="description"]').val();
                console.log('description');
                console.log(description);
                if (description == '' || description == '') {
                    swal(
                        '{{trans("site.descriptionRequired")}}', {
                            icon: "warning",
                            button: '{{trans("site.ok")}}',
                        });

                } else {
                    let formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('description', description);
                    $.ajax({
                        url: '{{ url(App::getLocale() . '/send-noproblem-request') }}',
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
                            console.log(response.success.result.id);

                            var date = new Date(response.success.result.requestDate); // Or your date here
                            var requestDate = (date.getMonth() + 1) + '/' + date.getDate() + '/' + date.getFullYear()
                            /* 	console.log('requestDate',requestDate); */

                            $('.all-services').append(
                                '<tr id="' + response.success.result.id + '">\
								<td>' + response.success.result.code + '</td>\
								<td>{{trans('site.Noobjectionletter')}}</td>\
								<td>' + requestDate + '</td>\
								<td>\
									<p style="Color:orange; font-weight: bold;">\
										{{ trans('site.order-waiting') }}\
									</p>\
								</td>\
								<td>\
									<span data-id="' + response.success.result.id + '" class="m-1 show-service btn btn-success">{{ trans('site.details') }}</span>\
									<span data-id="' + response.success.result.id + '" class="m-1 edit-service btn btn-primary">{{ trans('site.edit') }}</span>\
									<span data-id="' + response.success.result.id + '" class="m-1 delete-service btn btn-danger">{{ trans('site.delete') }}</span>\
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
                            $("#NoobjectionletterForm").trigger("reset");
                        }
                    });
                }

            });

            // Noobjectionletter show-service (No problem request)
            $(document).on("click", ".show-service", function () {
                let serviceID = $(this).data('id');
                let urlService = '{{ url(App::getLocale() . '/show-noproblem-request') }}';
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
                        var date = new Date(response.success.requestDate); // Or your date here
                        var requestDate = (date.getMonth() + 1) + '/' + date.getDate() + '/' + date.getFullYear()

                        var grantDate = new Date(response.success.grantDate); // Or your date here
                        var grantDateValue = (grantDate.getMonth() + 1) + '/' + grantDate.getDate() + '/' + grantDate.getFullYear()

                        /* console.log(response.success.description);
                        console.log(response.description); */
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
                            console.log(this.path);
                        }); */
                        var $certID = response.success.id;
                        if (response.success.state == "Accepted") {
                            $('.show-service1 .download .file').append(
                                '<div>\
                                <a href="{{ url(App::getLocale())}}' + '/show-certification/noProblemcertificate/' + $certID + '" target="_blank">\
													<p class="btn btn-success">' + '{{trans("site.show")}}' + '</p>\
												</a>\
											</div>'
                            );
                            $(".show-service1 .waiting").css("display", "none");
                            $(".show-service1 .received").css("display", "block");
                            $(".show-service1 .download").css("display", "block");
                            $(".show-service1 .approvaldate").css("display", "block");
                            //	$('.show-service1 .approvalDateValue').html(grantDateValue);

                        } else {
                            $(".show-service1 .download").css("display", "none");
                            $(".show-service1 .approvaldate").css("display", "none");
                            $(".show-service1 .received").css("display", "none");
                            $(".show-service1 .waiting").css("display", "block");
                            $(".show-service1 .download").css("display", "none");
                            //	$('.show-service1 .approvalDateValue').html('');

                        }
                        $(".show-service1").modal("toggle");
                    }
                });

            });

            // Noobjectionletter delete-service (No problem request)
            $(document).on("click", ".delete-service", function () {
                let serviceTr = $(this);
                let serviceID = $(this).data('id');
                let urlService = '{{ url(App::getLocale() . '/delet-noproblem-request') }}';
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
                                data: {
                                    '_token': '{{ csrf_token() }}',
                                    '_method': 'POST',
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


            // Noobjectionletter Send delete-service modal  (No problem request)
            /* $('.NonObjectionDeleteRequest').click(function () {
                let serviceID = $('#idService').val();
                let urlService = '{{ url(App::getLocale() . '/send-noproblem-edit-request') }}';
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
											console.log('response');
										    console.log(response);
											//console.log(response.success.result);
										//	console.log(response.success.result.id);
										//	console.log(response.success.result.id);


											$("#" + response.success.result.id ).remove();
											$('#serviceEdit2').fadeOut();
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
            }); */


            // Noobjectionletter open edit-service modal
            $(document).on("click", ".edit-service", function () {
                let serviceID = $(this).data('id');
                let urlService = '{{ url(App::getLocale() . '/show-noproblem-request') }}';
                let newUrl = urlService + '/' + serviceID;
                console.log(serviceID);
                console.log(urlService);
                console.log(newUrl);

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
                        $('.serviceEdit2 #codeService').html(response.success.code);
                        $('.serviceEdit2 #descServiceEdit').html(response.success.description);
                        $('.serviceEdit2 #idService').val(response.success.id);

                        $(".serviceEdit2").modal("toggle");

                    }
                });
            });
            // Noobjectionletter Send edit-service modal
            $('.NonObjectionEditRequest').click(function () {
                let code = $('.serviceEdit2 #codeService').html();
                let serviceID = $('#idService').val();
                let urlService = '{{ url(App::getLocale() . '/send-noproblem-edit-request') }}';
                let newUrl = urlService + '/' + serviceID;
                //console.log('code');

                let CertificateType = $('.chooseType').data('type');
                let CertificateRequestTypeId = $('#CertificateRequestTypeIdEdit').val();

                let description = $('#descServiceEdit').val();

                if (description == '' || description == '') {
                    swal(
                        '{{trans("site.descriptionRequired")}}', {
                            icon: "warning",
                            button: '{{trans("site.ok")}}',
                        });

                } else {


                    //	console.log(CertificateRequestTypeId);
                    //	console.log('description');
                    //console.log(description);
                    let formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('_method', 'PUT');
                    formData.append('description', description);
                    formData.append('CertificateRequestTypeId', CertificateRequestTypeId);
                    formData.append('Id', serviceID);
                    formData.append('code', code);

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

                            $('#serviceEdit2').fadeOut();
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


            // organization open  edit-service modal
            $(document).on("click", ".edit-organization", function () {
                $('.serviceEdit3 .faq-typesEdit').empty();
                $('.serviceEdit3 .fee-typesEdit').empty();
                let serviceID = $(this).data('id');
                let urlService = '{{ url(App::getLocale() . '/show-organization-request') }}';
                let newUrl = urlService + '/' + serviceID;
                console.log(serviceID);
                console.log(urlService);
                console.log(newUrl);

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
                        console.log(response.success.name);
                        $('.serviceEdit3 #mainImagePath').val(response.success.mainImagePath);

                        $('.serviceEdit3 #EcodeService').val(response.success.code);
                        $('.serviceEdit3 #EeventState').val(response.success.eventState);
                        $('.serviceEdit3 #organizationName').val(response.success.name);
                        $('.serviceEdit3 #EnorganizationName').val(response.success.enName);
                        $('.serviceEdit3 #organizationorganizerName').val(response.success.organizerName);
                        $('.serviceEdit3 #EenOrganizerName').val(response.success.enOrganizerName);
                        $('.serviceEdit3 #organizationdesc').html(response.success.description);
                        $('.serviceEdit3 #organizationEndesc').html(response.success.enDescription);
                        $('.serviceEdit3 #organizationlocation').val(response.success.location);
                        $('.serviceEdit3 #organizationEnlocation').val(response.success.enLocation);
                        $('.serviceEdit3 #participationType').val(response.success.participationType).change();
                        $('.serviceEdit3 #eventClassificationIdEdit').val(response.success.eventClassificationId).change();
                        $('.serviceEdit3 #idOrganizeEvent').val(response.success.id);
                        /* start set startDate */
                        var startDate = new Date(response.success.startDate);
                        var day = ("0" + startDate.getDate()).slice(-2);
                        var month = ("0" + (startDate.getMonth() + 1)).slice(-2);
                        var startDate = startDate.getFullYear() + "-" + (month) + "-" + (day);
                        $('.serviceEdit3 #EventStartDate').val(startDate);
                        /* end set startDate */
                        /* start set startTime - endTime */
                        $('.serviceEdit3 #EventStartTime').val(response.success.startTime);
                        $('.serviceEdit3 #EventEndTime').val(response.success.endTime);
                        /* end set startDate - endTime */

                        /* start set endDate */
                        var endDate = new Date(response.success.endDate);
                        var day = ("0" + endDate.getDate()).slice(-2);
                        var month = ("0" + (endDate.getMonth() + 1)).slice(-2);
                        var endDate = endDate.getFullYear() + "-" + (month) + "-" + (day);
                        $('.serviceEdit3 #EventEndDate').val(endDate);
                        /* end set endDate */
                        /* start set registerStartDate */
                        var registerStartDate = new Date(response.success.registerStartDate);
                        var day = ("0" + registerStartDate.getDate()).slice(-2);
                        var month = ("0" + (registerStartDate.getMonth() + 1)).slice(-2);
                        var registerStartDate = registerStartDate.getFullYear() + "-" + (month) + "-" + (day);
                        $('.serviceEdit3 #EventregisterStartDate').val(registerStartDate);
                        /* end set registerStartDate */
                        /* start set registerEndDate */
                        var registerEndDate = new Date(response.success.registerEndDate);
                        var day = ("0" + registerEndDate.getDate()).slice(-2);
                        var month = ("0" + (registerEndDate.getMonth() + 1)).slice(-2);
                        var registerEndDate = registerEndDate.getFullYear() + "-" + (month) + "-" + (day);
                        $('.serviceEdit3 #EventregisterEndDate').val(registerEndDate);
                        /* end set registerEndDate */
                        if (response.success.eventFAQs.length > 0) {
                            $(response.success.eventFAQs).each(function () {
                                $('.serviceEdit3 .faq-typesEdit').append(
                                    '<tr>\
                                    <td style="display:none"><input type="text" class="form-control" name="id1[]" autofocus value="' + this.id + '"></td>\
														<td><input type="text" class="form-control" name="question1[]" autofocus value="' + this.question + '"></td>\
														<td><input type="text" class="form-control" name="answer1[]" autofocus value="' + this.answer + '"></td>\
														<td><input type="text" class="form-control" name="enquestion1[]" autofocus value="' + this.enQuestion + '"></td>\
														<td><input type="text" class="form-control" name="enanswer1[]" autofocus value="' + this.enAnswer + '"></td>\
														<td><span class="btn btn-danger delete">{{ trans('site.delete') }}</span> </td>\
														</tr>'
                                )
                            });
                        }
                        if (response.success.eventFees.length > 0) {
                            $(response.success.eventFees).each(function () {
                                $('.serviceEdit3 .fee-typesEdit').append(
                                    '<tr>\
                                    <td style="display:none"><input type="text" class="form-control" name="id1[]" autofocus value="' + this.id + '"></td>\
														<td><input type="text" class="form-control" name="category1[]" autofocus value="' + this.category + '"></td>\
														<td><input type="text" class="form-control" name="feeValue1[]" autofocus value="' + this.feeValue + '"></td>\
														<td><input type="text" class="form-control" name="encategory1[]" autofocus value="' + this.enCategory + '"></td>\
														<td><input type="text" class="form-control" name="enfeeValue1[]" autofocus value="' + this.enFeeValue + '"></td>\
														<td><span class="btn btn-danger delete">{{ trans('site.delete') }}</span> </td>\
														</tr>'
                                )
                            });
                        }
                        if (!response.success.mainImagePath == '') {
                            var dvPreview = $("#divImageMediaPreview");
                            dvPreview.html("");
                            dvPreview.append('<img style="width: 150px; height:100px; padding: 10px" src="http://api.emiratesesports.net/' + response.success.mainImagePath + '">'
                            );
                        }
                        if (response.success.attachments.length > 0) {
                            var dvPreview3 = $("#divattachmentsMediaPreview");
                            dvPreview3.html("");
                            $(response.success.attachments).each(function () {

                                dvPreview3.append('<img style="width: 150px; height:100px; padding: 10px" src="http://api.emiratesesports.net/' + this.path + '">'
                                );
                            });
                        }
                        $(".serviceEdit3").modal("toggle");

                    }
                });
            });


            // OrganizationRequests delete send request
            $('.OrganizationDeleteRequests').click(function () {
                /* $('.show-service2 .faq-types').empty();
                $('.show-service2 .fee-types').empty();
                $('#name_error').text('');
                $('#organizerName_error').text('');
                $('#startDate_error').text('');
                $('#startTime_error').text('');
                $('#endDate_error').text('');
                $('#endTime_error').text('');
                $('#registerStartDate_error').text('');
                $('#registerEndDate_error').text('');
                $('#participationType_error').text('');
                $('#eventClassificationId_error').text('');
                $('#location_error').text('');
                $('#mainImage_error').text('');
                $('#attachments_error').text('');
                $('#description_error').text(''); */

                let serviceID = $('#idOrganizeEvent').val();
                let urlService = '{{ url(App::getLocale() . '/send-organization-edit-request') }}';
                let newUrl = urlService + '/' + serviceID;

                let code = $('#OrganizeEditRequestForm input[name="code"]').val();
                let name = $('#OrganizeEditRequestForm input[name="name"]').val();
                let enName = $('#OrganizeEditRequestForm input[name="enName"]').val();
                let organizerName = $('#OrganizeEditRequestForm input[name="organizerName"]').val();
                let enOrganizerName = $('#OrganizeEditRequestForm input[name="enOrganizerName"]').val();
                let eventClassificationId = $('#OrganizeEditRequestForm select[name="eventClassificationId"]').val();
                let participationType = $('#OrganizeEditRequestForm select[name="participationType"]').val();
                //let description = $('#OrganizeEditRequestForm #description2').val();
                let location = $('#OrganizeEditRequestForm input[name="location"]').val();
                let formData = new FormData($('#OrganizeEditRequestForm')[0]);
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('_method', 'PUT');
                formData.append('code', code);
                formData.append('name', name);
                formData.append('enName', enName);
                formData.append('organizerName', organizerName);
                formData.append('enOrganizerName', enOrganizerName);
                formData.append('eventClassificationId', eventClassificationId);
                formData.append('participationType', participationType);
                //formData.append('description', description);
                //	formData.append('location', location);
                formData.append('id', serviceID);
                formData.append('eventState', 'Deleted-By-Client');

                //	formData.append('eventFAQs', eventFAQs);
                //	formData.append('eventFees', eventFees);


                $.ajax({
                    url: newUrl,
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    beforeSend: function () {

                    },
                    error: function (response) {
                        //swal("Oh noes!", "The AJAX request failed!", "error");
                        var response1 = $.parseJSON(response.responseText);
                        //console.log(response1);
                        $.each(response1.errors, function (key, val) {
                            $("#" + key + "_error").text(val[0]);
                        });
                    },
                    success: function (response) {
                        console.log('response');
                        console.log(response);
                        $('#serviceEdit3').fadeOut();
                        swal(
                            '{{trans("site.requestsuccessfully")}}', {
                                icon: "success",
                                button: '{{trans("site.ok")}}',
                            });


                        $('.modal-backdrop').remove();
                        $("#OrganizeEditRequestForm").trigger("reset");
                        $('.faq').html('');
                        $('.fee').html('');


                    }
                });
            });

            // OrganizationRequests Edit send request
            $('.OrganizationEditRequests').click(function () {
                /* $('.show-service2 .faq-types').empty();
                $('.show-service2 .fee-types').empty();
                $('#name_error').text('');
                $('#organizerName_error').text('');
                $('#startDate_error').text('');
                $('#startTime_error').text('');
                $('#endDate_error').text('');
                $('#endTime_error').text('');
                $('#registerStartDate_error').text('');
                $('#registerEndDate_error').text('');
                $('#participationType_error').text('');
                $('#eventClassificationId_error').text('');
                $('#location_error').text('');
                $('#mainImage_error').text('');
                $('#attachments_error').text('');
                $('#description_error').text(''); */

                let serviceID = $('#idOrganizeEvent').val();
                let urlService = '{{ url(App::getLocale() . '/send-organization-edit-request') }}';
                let newUrl = urlService + '/' + serviceID;

                let mainImage = $('#OrganizeEditRequestForm input[name="mainImage"]').val();
                let attachments = $('#OrganizeEditRequestForm input[name="attachments"]').val();
                let code = $('#OrganizeEditRequestForm input[name="code"]').val();
                let eventState = $('#OrganizeEditRequestForm input[name="eventState"]').val();
                let name = $('#OrganizeEditRequestForm input[name="name"]').val();
                let enName = $('#OrganizeEditRequestForm input[name="enName"]').val();
                let organizerName = $('#OrganizeEditRequestForm input[name="organizerName"]').val();
                let enOrganizerName = $('#OrganizeEditRequestForm input[name="enOrganizerName"]').val();
                let eventClassificationId = $('#OrganizeEditRequestForm select[name="eventClassificationId"]').val();
                let participationType = $('#OrganizeEditRequestForm select[name="participationType"]').val();
                //let description = $('#OrganizeEditRequestForm #description2').val();
                let location = $('#OrganizeEditRequestForm input[name="location"]').val();
                let formData = new FormData($('#OrganizeEditRequestForm')[0]);
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('_method', 'PUT');
                formData.append('code', code);
                formData.append('eventState', eventState);
                formData.append('name', name);
                formData.append('enName', enName);
                formData.append('organizerName', organizerName);
                formData.append('enOrganizerName', enOrganizerName);
                formData.append('eventClassificationId', eventClassificationId);
                formData.append('participationType', participationType);
                formData.append('mainImage', mainImage);
                formData.append('attachments', attachments);
                //formData.append('description', description);
                //	formData.append('location', location);
                formData.append('id', serviceID);
                //	formData.append('eventFAQs', eventFAQs);
                //	formData.append('eventFees', eventFees);


                $.ajax({
                    url: newUrl,
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    beforeSend: function () {

                    },
                    error: function (response) {
                        //swal("Oh noes!", "The AJAX request failed!", "error");
                        var response1 = $.parseJSON(response.responseText);
                        //console.log(response1);
                        $.each(response1.errors, function (key, val) {
                            $("#" + key + "_error").text(val[0]);
                        });
                    },
                    success: function (response) {
                        console.log('response');
                        console.log(response);
                        $('#serviceEdit3').fadeOut();
                        swal(
                            '{{trans("site.requestsuccessfully")}}', {
                                icon: "success",
                                button: '{{trans("site.ok")}}',
                            });


                        $('.modal-backdrop').remove();
                        $("#OrganizeEditRequestForm").trigger("reset");
                        $('.faq').html('');
                        $('.fee').html('');


                    }
                });
            });


            // OrganizationRequests Send
            $('.OrganizationRequests').click(function () {
                $('.show-service2 .faq-types').empty();
                $('.show-service2 .fee-types').empty();
                $('#name_error').text('');
                //$('#ُEnName_error').text('');
                $('#organizerName_error').text('');
                $('#enOrganizerName_error').text('');
                $('#startDate_error').text('');
                $('#startTime_error').text('');
                $('#endDate_error').text('');
                $('#endTime_error').text('');
                $('#registerStartDate_error').text('');
                $('#registerEndDate_error').text('');
                $('#participationType_error').text('');
                $('#eventClassificationId_error').text('');
                $('#location_error').text('');
                $('#enLocation_error').text('');
                $('#mainImage_error').text('');
                $('#attachments_error').text('');
                $('#description_error').text('');
                $('#description_error').text('');


                let name = $('#name').val();
                let enName = $('input[name="enName"]').val();
                let organizerName = $('input[name="organizerName"]').val();
                let enOrganizerName = $('input[name="enOrganizerName"]').val();
                let endDate = $('input[name="endDate"]').val();
                let eventClassificationId = $('select[name="eventClassificationId"]').val();
                let participationType = $('select[name="participationType"]').val();
                let description = $('#description2').val();
                let enDescription = $('#enDescription2').val();
                let location = $('input[name="location"]').val();
                let enLocation = $('input[name="enLocation"]').val();
                let formData = new FormData($('#OrganizeRequestForm')[0]);
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('name', name);
                formData.append('enName', enName);
                formData.append('organizerName', organizerName);
                formData.append('enOrganizerName', enOrganizerName);
                formData.append('endDate', endDate);
                formData.append('eventClassificationId', eventClassificationId);
                formData.append('participationType', participationType);
                formData.append('description', description);
                formData.append('enDescription', enDescription);
                formData.append('location', location);
                formData.append('enLocation', enLocation);
                //	formData.append('eventFAQs', eventFAQs);
                //	formData.append('eventFees', eventFees);

                console.log('name', name);

                $.ajax({
                    url: '{{ url(App::getLocale() . '/send-organization-request') }}',
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    beforeSend: function () {

                    },
                    error: function (response) {
                        //swal("Oh noes!", "The AJAX request failed!", "error");
                        var response1 = $.parseJSON(response.responseText);
                        //console.log(response1);
                        $.each(response1.errors, function (key, val) {
                            $("#" + key + "_error").text(val[0]);
                        });
                    },
                    success: function (response) {
                        console.log('response');
                        console.log(response);
                        var date = new Date(response.success.result.createdAt); // Or your date here
                        var createdAt = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear()
                        /* 	console.log('requestDate',requestDate); */
                        $('.all-services').append(
                            '<tr id="' + response.success.result.id + '">\
								<td>' + response.success.result.code + '</td>\
								<td>{{trans('site.Requestorganizeevent')}}</td>\
								<td>' + createdAt + '</td>\
								<td>\
									<p style="Color:orange; font-weight: bold;">\
										{{ trans('site.order-waiting') }}\
									</p>\
								</td>\
								<td>\
									<span data-id="' + response.success.result.id + '" class="m-1 show-organization btn btn-success">{{ trans('site.details') }}</span>\
									<span data-id="' + response.success.result.id + '" class="m-1 edit-organization btn btn-primary">{{ trans('site.edit') }}</span>\
									<span data-id="' + response.success.result.id + '" class="m-1 delete-organization btn btn-danger">{{ trans('site.delete') }}</span>\
								</td>\
								</tr>'
                        );
                        $('#service2').fadeOut();

                        swal(
                            '{{trans("site.requestsuccessfully")}}', {
                                icon: "success",
                                button: '{{trans("site.ok")}}',
                            });


                        $('.modal-backdrop').remove();
                        $("#OrganizeRequestForm").trigger("reset");
                        $('.faq').html('');
                        $('.fee').html('');
                    }
                });
            });


            // OrganizationRequests show-service
            $(document).on("click", ".show-organization", function () {
                $('.show-service2 .faq-types2').empty();
                $('.show-service2 .fee-types').empty();
                $('.show-service2 .images').empty();
                let serviceID = $(this).data('id');
                let urlService = '{{ url(App::getLocale() . '/show-organization-request') }}';
                let newUrl = urlService + '/' + serviceID;
                console.log(serviceID);
                console.log(urlService);
                console.log(newUrl);
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
                        //	console.log(response.success.description);
                        var startDate = new Date(response.success.createdAt); // Or your date here
                        var startDate = (startDate.getMonth() + 1) + '/' + startDate.getDate() + '/' + startDate.getFullYear()

                        var endDate = new Date(response.success.endDate); // Or your date here
                        var endDate = (endDate.getMonth() + 1) + '/' + endDate.getDate() + '/' + endDate.getFullYear()

                        //	console.log(response.success.registerStartDate);
                        var registerStartDate = new Date(response.success.registerStartDate); // Or your date here
                        var registerStartDate = (registerStartDate.getMonth() + 1) + '/' + registerStartDate.getDate() + '/' + registerStartDate.getFullYear()

                        var registerEndDate = new Date(response.success.registerEndDate); // Or your date here
                        var registerEndDate = (registerEndDate.getMonth() + 1) + '/' + registerEndDate.getDate() + '/' + registerEndDate.getFullYear()

                        if (response.success.participationType == 'Teams') {
                            var participationType = '{{trans("site.Teams")}}';
                        } else {
                            var participationType = '{{trans("site.Individuals")}}';
                        }


                        $('.show-service2 .mainImagePath').attr('src', 'http://api.emiratesesports.net/' + response.success.mainImagePath);
                        $('.show-service2 .codeService').html(response.success.code);
                        $('.show-service2 .eventname').html(response.success.name);
                        $('.show-service2 .eventenName	').html(response.success.enName);
                        $('.show-service2 .organizerName').html(response.success.organizerName);
                        $('.show-service2 .enOrganizerName').html(response.success.enOrganizerName);
                        $('.show-service2 .startDate').html(startDate);
                        $('.show-service2 .endDate').html(endDate);
                        $('.show-service2 .registerStartDate').html(registerStartDate);
                        $('.show-service2 .registerEndDate').html(registerEndDate);
                        $('.show-service2 .eventClassificationId').html(response.success.eventClassificationId);
                        $('.show-service2 .participationType').html(participationType);
                        /* $('.show-service2 .Categories').html(response.success.Categories); */
                        $('.show-service2 .location').html(response.success.location);
                        $('.show-service2 .enLocation').html(response.success.enLocation);
                        /* 	$('.show-service2 .Fee').html(response.success.Fee); */
                        $('.show-service2 .description').html(response.success.description);
                        $('.show-service2 .enDescription').html(response.success.enDescription);
                        $('.show-service2 .eventtype').html(response.success.eventClassificationName);
                        $('.show-service2 .Eventstarttime').html(response.success.startTime);
                        $('.show-service2 .Eventendtime').html(response.success.endTime);
                        if (response.success.eventState == "Pending") {
                            $(".show-service2 .waiting").css("display", "block");
                            $(".show-service2 .received").css("display", "none");

                        } else {
                            $(".show-service2 .waiting").css("display", "none");
                            $(".show-service2 .received").css("display", "block");
                        }
                        if (response.success.eventFAQs.length == 0) {
                            $(".show-service2 .faq2").css("display", "none");
                        } else {
                            $(".show-service2 .faq2").css("display", "block");
                            $(response.success.eventFAQs).each(function () {
                                //console.log(this);
                                $('.show-service2 .faq-types2').append(
                                    '<tr>\
                                    <td>' + this.question + '</td>\
															<td>' + this.answer + '</td>\
															</tr><tr>\
															<td>' + this.enQuestion + '</td>\
															<td>' + this.enAnswer + '</td>\
															</tr>'
                                );
                            });
                        }
                        if (response.success.eventFees.length == 0) {
                            $(".show-service2 .Fee").css("display", "none");
                        } else {
                            $(".show-service2 .Fee").css("display", "block");
                            $(response.success.eventFees).each(function () {
                                //console.log(this);
                                $('.show-service2 .fee-types').append(
                                    '<tr>\
                                    <td>' + this.category + '</td>\
															<td>' + this.feeValue + '</td>\
															</tr><tr>\
															<td>' + this.enCategory + '</td>\
															<td>' + this.enFeeValue + '</td>\
															</tr>'
                                );
                            });
                        }
                        if (response.success.attachments.length == 0) {
                            $(".show-service2 .images").css("display", "none");
                        } else {
                            $(".show-service2 .images").css("display", "block");
                            $(response.success.attachments).each(function () {
                                //console.log(this);
                                $('.show-service2 .images').append(
                                    '<div class="col-12 col-md-2 mainImage text-center">\
                                        <img src="http://api.emiratesesports.net/' + this.path + '" alt="" style="height: 250px;">\
															</div>'
                                );
                            });
                        }
                        $(".show-service2").modal("toggle");
                    }
                });
            });


            // OrganizationRequests delete-organization
            $(document).on("click", ".delete-organization", function () {
                let serviceTr = $(this);
                let serviceID = $(this).data('id');
                let urlService = '{{ url(App::getLocale() . '/delet-organization-request') }}';
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
                                type: 'PUT',
                                dataType: 'JSON',
                                data: {
                                    '_token': '{{ csrf_token() }}',
                                    '_method': 'PUT',
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
                            /* swal("Your imaginary file is safe!"); */
                        }
                    });

            });

            $("#mainImage3").change(function () {
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = $("#divImageMediaPreview");
                    dvPreview.html("");
                    $($(this)[0].files).each(function () {
                        var file = $(this);
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            var img = $("<img />");
                            img.attr("style", "width: 150px; height:100px; padding: 10px");
                            img.attr("src", e.target.result);
                            dvPreview.append(img);
                        }
                        reader.readAsDataURL(file[0]);
                    });
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
            });
            $("#attachments3").change(function () {
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = $("#divattachmentsMediaPreview");
                    dvPreview.html("");
                    $($(this)[0].files).each(function () {
                        var file = $(this);
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            var img = $("<img />");
                            img.attr("style", "width: 150px; height:100px; padding: 10px");
                            img.attr("src", e.target.result);
                            dvPreview.append(img);
                        }
                        reader.readAsDataURL(file[0]);
                    });
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
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
                        if (response.success.joinDate === null) {
                            swal(
                                '{{trans("site.notamember")}}', {
                                    icon: "warning",
                                    button: '{{trans("site.ok")}}',
                                });
                        } else {
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
