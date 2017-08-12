@extends('admin.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ trans('admin.static_page.lb_title_list') }}
            <small>{{ trans('admin.static_page.lb_title_edit_small') }}</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @include('notifications')
                <form role="form" action="{{ route('admin_edit_static_page') }}" id="form-product" method="POST" enctype="multipart/form-data">
                <div class="nav-tabs-custom">
                    <div class="box-body">
                        <ul class="nav nav-tabs">
                            @foreach ($languages as $lang)
                            <li @if($lang->iso2 === 'vi') class="active" @endif><a href="#tab_{{ $lang->iso2 }}" data-toggle="tab">{{ $lang->name }}</a></li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach ($languages as $lang)
                            <div class="tab-pane @if($lang->iso2 === 'vi') active @endif" id="tab_{{ $lang->iso2 }}">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="box">
                                            <div class="box-body">
                                                <?php 
                                                    $content = 'content_'.$lang->iso2;
                                                ?>
                                                <div class="form-group @if ($errors->has($content)) has-error @endif">
                                                @foreach($pageTranslateInfo as $item)
                                                    @if ($item->language_code === $lang->iso2)
                                                        <label class="control-label"><h2>{{ trans('admin.static_page.lb_page_name') }}</h2></label><br />
                                                        <span>{{ $item->title }}</label><br />
                                                        <label class="control-label"><h2>{{ trans('admin.static_page.lb_slug') }}</h2></label><br />
                                                        <span>{{ $item->slug }}</span>
                                                        <hr>
                                                        <textarea type="text"
                                                                  class="form-control border-corner title-slug editor-content"
                                                                  lang="{{ $lang->iso2 }}"
                                                                  id="{{ $content }}"
                                                                  name="{{ $content }}">{{ $item->content }}</textarea>
                                                        @if ($errors->has($content))
                                                            <p class="help-block">{{ $errors->first($content) }}</p>
                                                        @endif
                                                    @endif
                                                @endforeach
                                                <p class="help-block"></p>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <input type="hidden" id="page_id" name="page_id" value="{{ $pageInfo->id }}" />
                        <button type="submit" class="btn btn-primary pull-right">{{ trans('admin.static_page.btn_save') }}</button>
                        <a href="{{ route('admin_manage_static_page') }}" class="btn btn-default pull-right" style="margin-right: 10px;">{{ trans('admin.static_page.btn_back') }}</a>
                    </div>
                </form>
                <!-- nav-tabs-custom -->
            </div>
        </div>
    </section>
</div>
@endsection

@section('footer_script')
<!-- TinyMCE -->
<script type="text/javascript" src="{{ asset('/plugins/tinymce/tinymce.min.js') }}"></script>
<script>
$(function () {
    tinymce.init({
        selector: ".editor-content", 
        theme: "modern", 
        height: 400,
        subfolder:"",
        plugins: [ 
        "advlist autolink link image lists charmap print preview hr anchor pagebreak", 
        "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking", 
        "table contextmenu directionality emoticons paste textcolor filemanager" 
        ], 
        image_advtab: true, 
        toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code"
    });
});
</script>

@endsection