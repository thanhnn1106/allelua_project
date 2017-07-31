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
                                                                  class="form-control border-corner title-slug"
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
<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    @foreach ($languages as $lang)
        <?php
            $content = 'content_' . $lang->iso2;
        ?>
        CKEDITOR.replace(<?php echo $content; ?>);
    @endforeach
  });
</script>

@endsection