@include('layouts.message')
<style>
    .ck-editor__editable[role="textbox"] {
        /* editing area */
        min-height: 200px;
    }

    .ck-content .image {
        /* block images */
        max-width: 80%;
        margin: 20px auto;
    } 
    .show-article,
    .edit-article,
    .delete-article {
        padding:5px;
        margin: 2px;
        font-size: 11px;
    }
</style>
{{--{{dd($user)}}--}}
<div class="card checkout-area pt-30 pb-30">
    <div class="your-order">
        <div class="row ">
            <div class="col-12"></div>
            <h4 class="p-4 text-center">{{ trans('site.articles') }}</h4>
            <div class="services">
                <a class="service chooseType" href="#" data-toggle="modal"
                   data-target="#article1" style="background-color: green; color: #fff;">{{trans('site.addarticles')}}</a>
            </div>
            <h4 class="p-4 text-center">{{ trans('site.myarticles') }}</h4>

            <div class="tab__content">
                <div class="table-container text-center">
                    <table class="table table-striped table-hover" id="order-table">
                        <thead>
                        <tr>

                        <!-- <th scope="col">{{ trans('site.Servicename') }} </th> -->
                            <th scope="col">{{ trans('site.articlesTitle') }} </th>
                            <th scope="col">{{trans('site.authorName')}} </th>
                            <th scope="col">{{ trans('site.requestDate') }} </th>
                            <th scope="col">{{ trans('site.approval') }} </th>
                            <th scope="col">{{ trans('site.status') }} </th>
                            <th scope="col">{{ trans('site.operations') }} </th>
                        </tr>
                        </thead>
                        <tbody class="all-articles">
                        @if (!empty($articles))
                            @foreach($articles as $article)
                                <tr id="{{$article['id']}}">
                                    <td>
                                        {{ (App::getLocale() == 'en')? $article['enTitle']:  $article['title']}}
                                    </td>
                                    <td>
                                        {{ (App::getLocale() == 'en')? $article['enAuthorName'] : $article['authorName']}}
                                    </td>
                                    <td>	{{ \Carbon\Carbon::parse($article['requestDate'] )->format('d/m/Y')}}

                                    </td>
                                    <td>
                                        @if($article['state'] == "Accepted")
                                            <p style="Color:green; font-weight: bold;">
                                                {{ trans('site.order-received') }}
                                            </p>
                                        @elseif($article['state'] == "Refused")
                                            <p style="Color:red; font-weight: bold;">
                                                {{ trans('site.order-Refused') }}
                                            </p>
                                        @else 
                                            <p style="Color:orange; font-weight: bold;">
                                                {{ trans('site.order-waiting') }} 
                                            </p>
                                        @endif
                                    </td>
                                    <td>
                                        @if($article['isActive'])
                                            <p style="Color:green; font-weight: bold;">
                                                {{ trans('site.order-isActive') }}
                                            </p>
                                        @else
                                            <p style="Color:orange; font-weight: bold;">
                                                {{ trans('site.order-Inactive') }}
                                            </p>
                                        @endif
                                    </td>
                                    <td >
									<span data-id="{{$article['id']}}" class="show-article btn btn-success ">{{ trans('site.details') }}</span>
									<span data-id="{{$article['id']}}" class="edit-article btn btn-primary ">{{ trans('site.edit') }}</span>
									<span data-id="{{$article['id']}}" class="delete-article btn btn-danger ">{{ trans('site.delete') }}</span>
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

<!-- start article1 modal form -->
<div class="modal fade" id="article1" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">{{ trans('site.articles') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 class="">{{trans('site.addarticles')}}</h3>

                <div class="col-12 form-request">
                    @include('layouts.message')
                    <form class="col-12 form-horizontal" id="articleForm" role="form" method="POST" action="#"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="d-flex flex-wrap">
                            <div class="col-12 col-lg-6 form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <div class="col-12 d-flex align-items-center p-0">
                                    <span class="asterisks">* </span>
                                    <label for="title" class="col-12 control-label  pb-2 pt-2">{{trans('site.articlesTitle')}}</label>
                                </div>
                                <div class="col-12 p-0">
                                    <input id="title" type="text" class="form-control" name="title" required autofocus>
                                    <small id="title_error" class="form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 form-group{{ $errors->has('enTitle') ? ' has-error' : '' }}">
                                <div class="col-12 d-flex align-items-center p-0">
                                    <span class="asterisks">* </span>
                                    <label for="enTitle" class="col-12 control-label  pb-2 pt-2">{{trans('site.articlesenTitle')}}</label>
                                </div>
                                <div class="col-12 p-0">
                                    <input id="enTitle" type="text" class="form-control" name="enTitle" required autofocus>
                                    <small id="enTitle_error" class="form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 form-group{{ $errors->has('authorName') ? ' has-error' : '' }}">
                                <div class="col-12 d-flex align-items-center p-0">
                                    <span class="asterisks">* </span>
                                    <label for="authorName" class="col-12 control-label  pb-2 pt-2">{{trans('site.arauthorName')}}</label>
                                </div>
                                  <div class="col-12 p-0">
                                    <input id="authorName" type="text" class="form-control" name="authorName" required
                                           autofocus>
                                           <small id="authorName_error" class="form-text text-danger"></small>

                                </div>
                            </div>
                            <div class="col-12 col-lg-6 form-group{{ $errors->has('enAuthorName') ? ' has-error' : '' }}">
                                <div class="col-12 d-flex align-items-center p-0">
                                    <span class="asterisks">* </span>
                                    <label for="enAuthorName" class="col-12 control-label  pb-2 pt-2">{{trans('site.enAuthorName')}}</label>
                                </div>
                                  <div class="col-12 p-0">
                                    <input id="enAuthorName" type="text" class="form-control" name="enAuthorName" required
                                           autofocus>
                                           <small id="enAuthorName_error" class="form-text text-danger"></small>

                                </div>
                            </div>
                        </div>

                        <div class="form-group required {{ $errors->has('description') ? ' has-error' : '' }}">
                            <div class="col-12 d-flex align-items-center">
                                <span class="asterisks">* </span>
                                <label for="description" class="col-12 control-label  pb-2 pt-2">{{trans('site.ardescription')}}</label>
                            </div>
                            <div class="col-sm-12">
                                <textarea id="editor" name="description" class="form-control input-player"></textarea>
                            </div>
                            <small id="description_error" class="form-text text-danger"></small>

                        </div>

                        <div class="form-group required {{ $errors->has('enDescription') ? ' has-error' : '' }}">
                            <div class="col-12 d-flex align-items-center">
                                <span class="asterisks">* </span>
                                <label for="enDescription" class="col-12 control-label  pb-2 pt-2">{{trans('site.enDescription')}}</label>
                            </div>
                            <div class="col-sm-12">
                                <textarea id="editor1" name="enDescription" class="form-control input-player"></textarea>
                            </div>
                            <small id="enDescription_error" class="form-text text-danger"></small>

                        </div> 
                        <div
                            class="form-group residence-only {{ $errors->has('emirates-personal-passport-photo') ? ' has-error' : '' }}">
                            <span class="asterisks">* </span><label for="emirates-personal-passport-photo"
                                                                    class="col-11 control-label pb-2 pt-2">{{trans('site.mainImage')}}</label>
                            <div class="col-sm-12 input-group mb-3">
                                <div class="input-group">
                                    <input type="file" class="form-control" name="mainImage" id="mainImage"
                                           aria-describedby="uploadFile" aria-label="{{trans('individually.upload')}}">
                                </div>
                            </div>
                            <small id="mainImage_error" class="form-text text-danger"></small>

                        </div>
                        <div
                            class="form-group residence-only {{ $errors->has('emirates-personal-passport-photo') ? ' has-error' : '' }}">
                            <span class="asterisks">*  </span><label for="emirates-personal-passport-photo"
                                                                    class="col-11 control-label pb-2 pt-2">{{trans('site.attachments')}}</label>
                            <div class="col-sm-12 input-group mb-3">
                                <div class="input-group">
                                    <input type="file" class="form-control" name="attachments[]" id="attachments"
                                           aria-describedby="uploadFile" aria-label="{{trans('individually.upload')}}">
                                    
                                </div>
                                <small id="attachments_error" class="form-text text-danger"></small>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('site.cancel')}}</button>
                <button type="button" class="btn btn-primary articleRequest"
                        id="articleRequest">{{trans('site.send')}}</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- end article1 modal form -->



<!-- article1 modal -->
<div class="modal fade show-article1" id="show-article1" tabindex="-1" role="dialog" aria-labelledby="basicModal"
     aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">{{ trans('site.detailsarticles') }}</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 class="nameofservice"></h3>

                <div class="col-12 col-lg-9 form-request">
                    <div class="col-12">
                        <div class="col-12">
                            {{trans('site.mainImage')}}
                        </div>
                        <div class="col-12 content text-center">
                            <img class="responsive mainImage" src="" width="350" alt="logo"
                                 onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';"
                                 style="height: 70%;">
                        </div>
                    </div>

                    <div class="d-flex col-12 flex-wrap">
                        <div class="col-12 col-md-6">
                            <div class="col-12">
                                {{trans('site.articlesTitle')}}
                            </div>
                            <div class="col-12 content">
                                <p class="artitle"></p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="col-12">
                                {{trans('site.articlesenTitle')}}
                            </div>
                            <div class="col-12 content">
                                <p class="entitle"></p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="col-12">
                                {{trans('site.arauthorName')}}
                            </div>
                            <div class="col-12 content">
                                <p class="arauthorName"></p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="col-12">
                                {{trans('site.enAuthorName')}}
                            </div>
                            <div class="col-12 content">
                                <p class="enauthorName"></p>
                            </div>
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
                            {{ trans('site.approval') }}
                        </div>
                        <div class="col-12 content approval">
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
                            {!! trans('site.approvaldate') !!}
                        </div>
                        <div class="col-12 content">
                            <p class="approvalDateValue"></p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="col-12">
                            {{ trans('site.status') }}
                        </div>
                        <div class="col-12 content Active">
                            <p class="isActive" style="Color:green; font-weight: bold; display:none">
                                {{ trans('site.order-isActive') }}
                            </p>

                            <p class="Inactive" style="Color:orange; font-weight: bold; display:none">
                                {{ trans('site.order-Inactive') }}
                            </p>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="col-12">
                            {{trans('site.ardescription')}}
                        </div>
                        <div class="col-12 content">
                            <p class="ardescription"></p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="col-12">
                            {{trans('site.enDescription')}}
                        </div>
                        <div class="col-12 content">
                            <p class="endescription"></p>
                        </div>
                    </div>


                    <div class="col-12 download">
                        <div class="col-12">
                            {{ trans('site.attachments') }}
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

<!-- start article1 modal form edit-->
<div class="modal fade" id="articleEdit" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">{{ trans('site.articles') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 class="">{{trans('site.addarticles')}}</h3>

                <div class="col-12 form-request">
                    @include('layouts.message')
                    <form class="col-12 form-horizontal" id="articleFormEdit" role="form" method="POST" action="#"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input id="articleID" type="hidden" class="form-control" name="id" required>
                        <input id="articlestate" type="hidden" class="form-control" name="state" required>
                        <input id="articleisActive" type="hidden" class="form-control" name="isActive" required>
                        <input id="articlemainImagePath" type="hidden" class="form-control" name="mainImagePath" required>

                        <div class="d-flex flex-wrap">
                            <div class="col-12 col-lg-6 form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <div class="col-12 d-flex align-items-center p-0">
                                    <span class="asterisks">* </span>
                                    <label for="title" class="col-12 control-label  pb-2 pt-2">{{trans('site.articlesTitle')}}</label>
                                </div>
                                <div class="col-12 p-0">
                                    <input id="Etitle" type="text" class="form-control" name="title" required autofocus>
                                    <small id="Etitle_error" class="form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 form-group{{ $errors->has('enTitle') ? ' has-error' : '' }}">
                                <div class="col-12 d-flex align-items-center p-0">
                                    <span class="asterisks">* </span>
                                    <label for="enTitle" class="col-12 control-label  pb-2 pt-2">{{trans('site.articlesenTitle')}}</label>
                                </div>
                                <div class="col-12 p-0">
                                    <input id="EenTitle" type="text" class="form-control" name="enTitle" required autofocus>
                                    <small id="EenTitle_error" class="form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 form-group{{ $errors->has('authorName') ? ' has-error' : '' }}">
                                <div class="col-12 d-flex align-items-center p-0">
                                    <span class="asterisks">* </span>
                                    <label for="authorName" class="col-12 control-label  pb-2 pt-2">{{trans('site.arauthorName')}}</label>
                                </div>
                                  <div class="col-12 p-0">
                                    <input id="EauthorName" type="text" class="form-control" name="authorName" required
                                           autofocus>
                                           <small id="EauthorName_error" class="form-text text-danger"></small>

                                </div>
                            </div>
                            <div class="col-12 col-lg-6 form-group{{ $errors->has('enAuthorName') ? ' has-error' : '' }}">
                                <div class="col-12 d-flex align-items-center p-0">
                                    <span class="asterisks">* </span>
                                    <label for="enAuthorName" class="col-12 control-label  pb-2 pt-2">{{trans('site.enAuthorName')}}</label>
                                </div>
                                  <div class="col-12 p-0">
                                    <input id="EenAuthorName" type="text" class="form-control" name="enAuthorName" required
                                           autofocus>
                                           <small id="EenAuthorName_error" class="form-text text-danger"></small>

                                </div>
                            </div>
                        </div>

                        <div class="form-group required {{ $errors->has('description') ? ' has-error' : '' }}">
                            <div class="col-12 d-flex align-items-center">
                                <span class="asterisks">* </span>
                                <label for="description" class="col-12 control-label  pb-2 pt-2">{{trans('site.description')}}</label>
                            </div>
                            <div class="col-sm-12">
                                <textarea id="editorEdit" name="description" class="form-control input-player description"></textarea>
                            </div>
                            <small id="Edescription_error" class="form-text text-danger"></small>

                        </div>
                        <div class="form-group required {{ $errors->has('enDescription') ? ' has-error' : '' }}">
                            <div class="col-12 d-flex align-items-center">
                                <span class="asterisks">* </span>
                                <label for="enDescription" class="col-12 control-label  pb-2 pt-2">{{trans('site.enDescription')}}</label>
                            </div>
                            <div class="col-sm-12">
                                <textarea id="editorEdit1" name="enDescription" class="form-control input-player description"></textarea>
                            </div>
                            <small id="EenDescription_error" class="form-text text-danger"></small>

                        </div>
                        <div
                            class="form-group residence-only {{ $errors->has('emirates-personal-passport-photo') ? ' has-error' : '' }}">
                            <span class="asterisks">* </span><label for="emirates-personal-passport-photo"
                                                                    class="col-11 control-label pb-2 pt-2">{{trans('site.mainImage')}}</label>
                            <div class="col-sm-12 input-group mb-3">
                                <div class="input-group">
                                    <input type="file" class="form-control" name="mainImage" id="mainImage4"
                                           aria-describedby="uploadFile" aria-label="{{trans('individually.upload')}}">
                                </div>
                            </div>
                            <div id="divImageMediaPreview"></div>

                            <small id="EmainImage_error" class="form-text text-danger"></small>

                        </div>
                        <div
                            class="form-group residence-only {{ $errors->has('emirates-personal-passport-photo') ? ' has-error' : '' }}">
                            <span class="asterisks">*  </span><label for="emirates-personal-passport-photo"
                                                                    class="col-11 control-label pb-2 pt-2">{{trans('site.attachments')}}</label>
                            <div class="col-sm-12 input-group mb-3">
                                <div class="input-group">
                                    <input type="file" class="form-control" name="attachments[]" id="attachments4"
                                           aria-describedby="uploadFile" aria-label="{{trans('individually.upload')}}">
                                    
                                </div>
                                <div id="divattachmentsMediaPreview"></div>

                                <small id="Eattachments_error" class="form-text text-danger"></small>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('site.cancel')}}</button>
                <button type="button" class="btn btn-primary articleEditRequest"
                        id="articleEditRequest">{{trans('site.send')}}</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- end article1 modal form edit-->

@push('js')
    <script>
        var editor = CKEDITOR.replace('editor', {
            filebrowserUploadUrl: "{{ url(App::getLocale() . '/ckeditor/upload?_token=' . csrf_token()) }}",
            filebrowserUploadMethod: 'form'
        });
        CKFinder.setupCKEditor(editor);

        var editor1 = CKEDITOR.replace('editor1', {
            filebrowserUploadUrl: "{{ url(App::getLocale() . '/ckeditor/upload?_token=' . csrf_token()) }}",
            filebrowserUploadMethod: 'form'
        });
        CKFinder.setupCKEditor(editor1);


        var editorEdit = CKEDITOR.replace('editorEdit', {
            filebrowserUploadUrl: "{{ url(App::getLocale() . '/ckeditor/upload?_token=' . csrf_token()) }}",
            filebrowserUploadMethod: 'form'
        });
        CKFinder.setupCKEditor(editorEdit);

        var editorEdit1 = CKEDITOR.replace('editorEdit1', {
            filebrowserUploadUrl: "{{ url(App::getLocale() . '/ckeditor/upload?_token=' . csrf_token()) }}",
            filebrowserUploadMethod: 'form'
        });
        CKFinder.setupCKEditor(editorEdit1);
    </script>
    <script>
        $(document).ready(function () {
            // start article Send
            $('.articleRequest').click(function () {
                $(".articleRequest").attr("disabled", true);
                $('#title_error').text('');
                $('#authorName_error').text('');
                $('#description_error').text('');
                $('#enTitle_error').text('');
                $('#enAuthorName_error').text('');
                $('#enDdescription_error').text('')

                $('#mainImage_error').text('');
                $('#attachments_error').text('');
                let articleTitle = $('input[name="title"]').val();
                let articleEnTitle = $('input[name="enTitle"]').val();
                let articleAuthorName = $('input[name="authorName"]').val();
                let articleEnAuthorName = $('input[name="enAuthorName"]').val();
                let description = editor.getData();
                let enDescription = editor1.getData();
               // console.log('description');
              //  console.log(description);

                let formData = new FormData($('#articleForm')[0]);
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('description', description);
                formData.append('enDescription', enDescription);
                formData.append('title', articleTitle);
                formData.append('enTitle', articleEnTitle);
                formData.append('authorName', articleAuthorName);
                formData.append('enAuthorName', articleEnAuthorName);
                $.ajax({
                    url: '{{ url(App::getLocale() . '/send-article-request') }}',
                    type: 'POST',
                    // enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    data: formData,
                    beforeSend: function () {
                    },
                    error: function (response) {
                       // swal("Oh noes!", "The AJAX request failed!", "error");
                        var response1 = $.parseJSON(response.responseText);
                        //console.log(response1);
                        $.each(response1.errors, function (key, val) {
                            $("#" + key + "_error").text(val[0]);
                        });
                        $("#articleRequest").removeAttr("disabled");
                    },
                    success: function (response) {
                        var date = new Date(response.success.result.requestDate); // Or your date here
                        var requestDate = (date.getMonth() + 1) + '/' + date.getDate() + '/' +  date.getFullYear();

                      
                     //  $('#'+response.success.result.id ).remove();
                     if("{{App::getLocale() == 'en'}}"){
                        articleTitle = response.success.result.enTitle;
                        articleauthorName = response.success.result.enAuthorName;
                    }else{
                        
                        articleTitle = response.success.result.title;
                        articleauthorName = response.success.result.authorName;
                    }

                        $('.all-articles').append(
                            '<tr id="' + response.success.result.id + '">\
								<td>' + articleTitle + '</td>\
								<td>' + articleauthorName + '</td>\
								<td>' + requestDate + '</td>\
								<td>\
									<p style="Color:orange; font-weight: bold;">\
										{{ trans('site.order-waiting') }}\
									</p>\
								</td>\
								<td>\
									<p style="Color:orange; font-weight: bold;">\
										{{ trans('site.order-Inactive') }}\
									</p>\
								</td>\
                                <td>\
									<span data-id="' + response.success.result.id + '" class="show-article btn btn-success ">{{ trans('site.details') }}</span>\
									<span data-id="' + response.success.result.id + '" class="edit-article btn btn-primary ">{{ trans('site.edit') }}</span>\
									<span data-id="' + response.success.result.id + '" class="delete-article btn btn-danger ">{{ trans('site.delete') }}</span>\
								</td>\
								</tr>'
                        );
                        $('#article1').fadeOut();
                        $("#articleRequest").removeAttr("disabled");
                        swal({
                            title: '{{trans("site.congratulation")}}',
                            text: '{{trans("site.aticlesuccessfully")}}',
                            icon: 'success',
                            button: '{{trans("site.ok")}}',
                        });
                        $("#articleForm").trigger("reset");
                        $('.modal-backdrop').remove();
                    }
                });

                
            });
            // end article Send

            //  show-article
            $(document).on("click", ".show-article", function () {
                let serviceID = $(this).data('id');
                let urlService = '{{ url(App::getLocale() . '/show-article-request') }}';
                let newUrl = urlService + '/' + serviceID;
                console.log(serviceID);
                console.log(urlService);
                console.log(newUrl);
                $(".show-article1 .download .file").empty();
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
                        var acceptDate = new Date(response.success.acceptDate); // Or your date here
                        var grantDateValue = (acceptDate.getMonth() + 1) + '/' + acceptDate.getDate() + '/' + acceptDate.getFullYear()
                        $('.show-article1 .artitle').html(response.success.title);
                        $('.show-article1 .entitle').html(response.success.enTitle);
                        $('.show-article1 .arauthorName').html(response.success.authorName);
                        $('.show-article1 .enauthorName').html(response.success.enAuthorName);
                        $('.show-article1 .ardescription').html(response.success.description);
                        $('.show-article1 .endescription').html(response.success.enDescription);
                        $('.show-article1 .requestDate').html(requestDate);
                        if (response.success.mainImagePath != null) {
                            $('.show-article1 .mainImage').attr("src", 'http://api.emiratesesports.net/' + response.success.mainImagePath);
                        }
                        $(response.success.attachments).each(function () {
                            $('.show-article1 .download .file').append(
                                '<div>\
                                <a href="http://api.emiratesesports.net/' + this.path + '" target="_blank">\
                                                <p>' + this.name + '</p>\
                                            </a>\
                                        </div>'
                            );
                            console.log(this.path);
                        });
                    $(".show-article1 .download").css("display", "block");
                    if (response.success.state == "Accepted") {
                        $(".show-article1 .waiting").css("display", "none");
                        $(".show-article1 .received").css("display", "block");
                        $(".show-article1 .approvaldate").css("display", "block");
                        $('.show-article1 .approvalDateValue').html(grantDateValue);
                    } else {
                        $(".show-article1 .approvaldate").css("display", "none");
                        $(".show-article1 .received").css("display", "none");
                        $(".show-article1 .waiting").css("display", "block");
                        $('.show-article1 .approvalDateValue').html('');
                    }

                    if (response.success.isActive) {
                        $(".show-article1 .Inactive").css("display", "none");
                        $(".show-article1 .isActive").css("display", "block");
                    } else {
                        $(".show-article1 .isActive").css("display", "none");
                        $(".show-article1 .Inactive").css("display", "block");

                        }
                    $(".show-article1").modal("toggle");
                    }
                });
            });
            //  start open form edit article
            $(document).on("click", ".edit-article", function () {
                let serviceID = $(this).data('id');
                let urlService = '{{ url(App::getLocale() . '/show-article-request') }}';
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

                        $('#articleEdit #articleID').val(response.success.id);
                        $('#articleEdit #articlestate').val(response.success.state);
                        $('#articleEdit #articleisActive').val(response.success.isActive);
                        $('#articleEdit #articlemainImagePath').val(response.success.mainImagePath);

                        
                        $('#articleEdit #Etitle').val(response.success.title);
                        $('#articleEdit #EenTitle').val(response.success.enTitle);
                        $('#articleEdit #EauthorName').val(response.success.authorName);
                        $('#articleEdit #EenAuthorName').val(response.success.enAuthorName);

                        editorEdit.setData(response.success.description);
                        editorEdit1.setData(response.success.enDescription);
                        

                        if(!response.success.mainImagePath == ''){
                                var dvPreview = $("#divImageMediaPreview");
                                dvPreview.html("");
                                dvPreview.append('<img style="width: 150px; height:100px; padding: 10px" src="http://api.emiratesesports.net/'+response.success.mainImagePath+'">'
                                );
                            }
                         /*    if(response.success.attachments.length > 0){
                                var dvPreview3 = $("#divattachmentsMediaPreview");
                                        dvPreview3.html("");
                                    $(response.success.attachments).each(function() {
                                        
                                        dvPreview3.append('<p>'+ this.name +'</p>'
                                        );
                                    });
                            } */



                    $("#articleEdit").modal("toggle");
                    }
                });
            });
            //  end open form edit article
            // start article Send edit
            $('.articleEditRequest').click(function () {
                $('#title_error').text('');
                $('#authorName_error').text('');
                $('#description_error').text('');
                $('#enDescription_error').text('');
                $('#mainImage_error').text('');
                $('#mainImage_error').text('');
                $('#attachments_error').text('');
                
                let id = $('#articleEdit #articleID').val();
                let articleTitle = $('#articleEdit input[name="title"]').val();
                let articleEnTitle = $('#articleEdit input[name="enTitle"]').val();
                let articleAuthorName = $('#articleEdit input[name="authorName"]').val();
                let articleEnAuthorName = $('#articleEdit input[name="enAuthorName"]').val();
                let mainImage = $('#articleEdit input[name="mainImage"]').val();
                let attachments = $('#articleEdit input[name="attachments"]').val();
                let description = editorEdit.getData();
                let enDescription = editorEdit1.getData();
             //   console.log('description');
            //    console.log(description);

                let formData = new FormData($('#articleFormEdit')[0]);
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('description', description);
                formData.append('enDescription', enDescription);
                formData.append('title', articleTitle);
                formData.append('enTitle', articleEnTitle);
                formData.append('authorName', articleAuthorName);
                formData.append('enAuthorName', articleEnAuthorName);
                formData.append('mainImage', mainImage);
                formData.append('attachments', attachments);
                $.ajax({
                    url: '{{ url(App::getLocale() . '/send-article-edit-request') }}',
                    type: 'POST',
                    // enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    data: formData,
                    beforeSend: function () {
                    },
                    error: function (response) {
                       // swal("Oh noes!", "The AJAX request failed!", "error");
                        var response1 = $.parseJSON(response.responseText);
                        //console.log(response1);
                        $.each(response1.errors, function (key, val) {
                            $("#" + key + "_error").text(val[0]);
                        });
                    },
                    success: function (response) {
                        var date = new Date(response.success.result.requestDate); // Or your date here
                        var requestDate = (date.getMonth() + 1) + '/' + date.getDate() + '/' +  date.getFullYear();

                        
                        $('#'+response.success.result.id ).replaceWith( '<tr id="' + response.success.result.id + '">\
								<td>' + response.success.result.title + '</td>\
								<td>' + response.success.result.authorName + '</td>\
								<td>' + requestDate + '</td>\
								<td>\
									<p style="Color:orange; font-weight: bold;">\
										{{ trans('site.order-waiting') }}\
									</p>\
								</td>\
								<td>\
									<p style="Color:orange; font-weight: bold;">\
										{{ trans('site.order-Inactive') }}\
									</p>\
								</td>\
                                <td>\
									<span data-id="' + response.success.result.id + '" class="show-article btn btn-success  ">{{ trans('site.details') }}</span>\
									<span data-id="' + response.success.result.id + '" class="edit-article btn btn-primary ">{{ trans('site.edit') }}</span>\
									<span data-id="' + response.success.result.id + '" class="delete-article btn btn-danger ">{{ trans('site.delete') }}</span>\
								</td>\
								</tr>');

                        $('#articleEdit').fadeOut();
                        swal({
                            title: '{{trans("site.congratulation")}}',
                            text: '{{trans("site.aticlesuccessfullyEdit")}}',
                            icon: 'success',
                            button: '{{trans("site.ok")}}',
                        });
                        $("#articleEdit").trigger("reset");
                        $('.modal-backdrop').remove();
                    }
                });
            });
            // end article Send edit

            // article Request delete-service
			$(document).on("click", ".delete-article" , function() {
							let serviceTr = $(this);
							let serviceID = $(this).data('id');
							let urlService = '{{ url(App::getLocale() . '/delet-article-request') }}';
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



            $("#mainImage4").change(function () {
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
		
            
		
        });
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@endpush
