@include('layouts.message')
@include('sweetalert::alert')
<div class="card checkout-area pt-30 pb-30">
    <div class="your-order">
        <div class="row">
            <div class="col-12 col-md-10 col-lg-8 col-xl-6 mx-auto">
                <div class="profile-membership-card position-relative" id="player_membership_card">
                    <img src="{{ asset('assets/img/Mumbership-ID1.png') }}" alt="Account"
                        class="img-responsive" style="width: 100%;">
                    <div class="cart-content print-cart-js">
                        <div class="row w-100 h-100 align-items-center mx-auto">
                            <div class="col-4 h-100">
                                @if (!empty($user['personInfo']['imagePath']))
                                    <img class="responsive" id="original_card_image" src="{{ config('app.base_address') . $user['personInfo']['imagePath'] }}" alt="">
{{--                                    <img class="responsive" id="card_image" src="{{ asset('SD08/clock.jpg') }}" alt="">--}}
                                @else
                                    <img class="responsive" id="card_image" src="{{ asset('SD08/default-user-image.png') }}" alt="">
                                @endif
                            </div>
                            <div class="col-8 pl-0">
                                <div class="cart-content-info">
                                    <ul class="list-unstyled">
                                        <li>{{trans('auth.name')}} : <span id="card_firstName">{{ $user['client']['name'] }}</span></li>
                                        <li>{{trans('individually.date-birth')}} : <span
                                                id="card_BirthDate">{{ \Carbon\Carbon::parse($user['personInfo']['birthDate'])->format('Y-m-d') }}</span></li>
                                        <li>{{trans('auth.account-type')}} : <span
                                                id="card_account-type">{{ $user['client']['type'] }}</span></li>
                                        <li>{{trans('individually.nationality')}} : <span
                                                id="card_NationalityId">{{ $user['personInfo']['nationalityName'] }}</span></li>
                                        <li>{{trans('individually.emirates-number')}} : <span
                                                id="card_uaeIdNumber">{{ $user['personInfo']['membershipNumber'] }}</span></li>
                                        <li>{{trans('individually.emirates-expiry-date')}} : <span
                                                id="card_uaeIdEndDate">{{ \Carbon\Carbon::parse($user['membershipEndDate'])->format('Y-m-d') }}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!--.cart-content-->
                </div><!--#Player_member_ship-->
                <div class="download-link text-center my-3">
{{--                    <a href="{{ url(App::getlocale() . '/downloadPdf') }}" >{{ trans('site.download-as-pdf') }}</a>--}}
                    <a href="javascript:void(0)" id="card_canv" class="btn btn-outline-success" class="btn btn-outline-success">{{ trans('site.download-as-pdf') }}</a>
                </div>
                <div id="img_out"><img src="" /></div>
            </div>
            <div class="player-membership-card-mobile-box d-none" style="width: 600px; height: 500px; max-width: unset;">
                <div class="position-relative" id="origin_player_membership_card">
                    <img src="{{ asset('assets/img/Mumbership-ID1.png') }}" alt="Account"
                         class="img-responsive" style="width: 100%;">
                    <div class="cart-content print-cart-js">
                        <div class="row w-100 h-100 align-items-center mx-auto">
                            <div class="col-4 h-100">
                                @if (!empty($user['personInfo']['imagePath']))
{{--                                        <img class="img-fluid" id="card_image" src="{{ config('app.base_address') . $user['personInfo']['imagePath'] }}" alt="">--}}
                                    <img class="responsive" id="pdf_card_image" src="" alt="">
{{--                                    <img class="responsive" id="card_image" src="{{ Storage::url("SD08/StaticFiles\Images\Players\18f93967-4bad-4a9c-ba85-864213a5941f_61ghDjhS8vL._AC_UX569_.jpg") }}" alt="">--}}
                                @else
                                    <img class="responsive" id="card_image" src="{{ asset('SD08/default-user-image.png') }}" alt="">
                                @endif
                            </div>
                            <div class="col-8 pl-0">
                                <div class="cart-content-info">
                                    <ul class="list-unstyled">
                                        <li>{{trans('auth.name')}} : <span id="card_firstName">{{ $user['client']['name'] }}</span></li>
                                        <li>{{trans('individually.date-birth')}} : <span
                                                id="card_BirthDate">{{ \Carbon\Carbon::parse($user['personInfo']['birthDate'])->format('Y-m-d') }}</span></li>
                                        <li>{{trans('auth.account-type')}} : <span
                                                id="card_account-type">{{ $user['client']['type'] }}</span></li>
                                        <li>{{trans('individually.nationality')}} : <span
                                                id="card_NationalityId">{{ $user['personInfo']['nationalityName'] }}</span></li>
                                        <li>{{trans('individually.emirates-number')}} : <span
                                                id="card_uaeIdNumber">{{ $user['personInfo']['membershipNumber'] }}</span></li>
                                        <li>{{trans('individually.emirates-expiry-date')}} : <span
                                                id="card_uaeIdEndDate">{{ \Carbon\Carbon::parse($user['membershipEndDate'])->format('Y-m-d') }}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!--.cart-content-->
                </div><!--#Player_member_ship-->
            </div>
        </div>
    </div>
</div>

@push('js')
{{--    <script src="https://code.jquery.com/jquery-2.1.3.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>--}}

    <script>
        $(document).ready(function () {
            $("#card_canv").click(function() {
                const url = $('#original_card_image').attr('src');
                StorageImage(url);
            });
            function StorageImage(url) {
                $.ajax({
                    url: '{{ url(App::getLocale() . '/profile/storage-image-from-url') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        url: url
                    },
                    beforeSend: function () {
                        activePreloader();
                    },
                    success: function (response) {
                        if (!response.error) {
                            $('#pdf_card_image').attr('src', response.full_url);
                            let hangerImageContainer = document.querySelector("#origin_player_membership_card");
                            $('.player-membership-card-mobile-box').removeClass('d-none');
                            html2canvas(hangerImageContainer, {
                                allowTaint : true,  // this is for include image with pdf
                                scale : 2           // this is for resolution
                            }).then(canvas => {
                                var image = canvas.toDataURL("image/png");
                                var doc = new jsPDF();
                                doc.addImage(image, 'PNG', 15, 40, 180, 180);
                                doc.save('card-membership' + '.pdf');
                                $('.player-membership-card-mobile-box').addClass('d-none');
                                deactivatePreloader();
                                deleteStorageImage(response.result);
                            });
                        } else {
                            window.alert(response.message);
                        }
                    }
                });
            }
            function activePreloader() {
                $('body').prepend(`
                    <div id="preloader">
                      <div id="preloaders" class="preloader">
                        <img id="logoLoader" class="logoLoader" src="{{asset('assets/img/wlogo.png')}}" alt="">
                        <img class="Loader" src="{{asset('assets/img/logoLoading7.svg')}}" alt="">
                        </div>
                      </div><div class="overlay"></div>
               `);
            }

            function deactivatePreloader() {
                $('#preloader').fadeOut('slow', function () {
                    $(this).remove();
                });
            }
            function deleteStorageImage(url) {
                $.ajax({
                    url: '{{ url(App::getLocale() . '/profile/delete-storage-image-from-url') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        url: url
                    },
                    beforeSend: function () {},
                    error: function (response) {},
                    success: function (response) { }
                })
            }

        });
    </script>
@endpush
