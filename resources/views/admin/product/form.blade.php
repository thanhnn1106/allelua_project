@extends('admin.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Category
            @if(empty($parent_id))
            <small>Edit Main</small>
            @else
            <small>Edit Sub</small>
            @endif
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @include('notifications')
                <form role="form" action="{{ route('admin_category_edit', ['id' => $id, 'parent_id' => $parent_id]) }}" id="form-general" method="post">
                <div class="nav-tabs-custom">
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        @if(empty($parent_id))
                        <a href="{{ route('admin_category_main') }}" class="btn btn-default btn-sm">Back</a>
                        @else
                        <a href="{{ route('admin_category_sub', ['id' => $parent_id]) }}" class="btn btn-default btn-sm">Back</a>
                        @endif
                    </div>
                    @if(empty($parent_id))
                    <div class="box-body">
                        <div class="form-group @if ($errors->has('is_home')) has-error @endif">
                            <div class="checkbox">
                                <label>
                                    <input name="is_home" type="checkbox" value="1" @if(old('is_home', $category->is_home or null) == '1') checked @endif /> {{ trans('admin.category.is_home') }}
                                </label>
                            </div>
                            @if ($errors->has('is_home'))
                              <p class="help-block">{{ $errors->first('is_home') }}</p>
                            @endif
                        </div>
                    </div>
                    @endif
                    <ul class="nav nav-tabs">
                        @foreach ($languages as $lang)
                        <li @if($lang->iso2 === 'vi') class="active" @endif><a href="#tab_{{ $lang->iso2 }}" data-toggle="tab">{{ $lang->name }}</a></li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach ($categories as $cate)
                        <div class="tab-pane @if($cate->language_code === 'vi') active @endif" id="tab_{{ $cate->language_code }}">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box">
                                        <div class="box-body">
                                            <?php 
                                                $title       = 'title_'.$cate->language_code;
                                            ?>
                                            <div class="form-group @if ($errors->has($title)) has-error @endif">
                                                <label class="control-label">{{ trans('admin.title_'.$cate->language_code) }}</label>
                                                <input type="text" class="form-control border-corner title-cate" lang="{{ $cate->language_code }}" name="{{ $title }}" placeholder="Input ..."
                                                        value="{{ old($title, $cate->title) }}" />
                                                @if ($errors->has($title))
                                                  <p class="help-block">{{ $errors->first($title) }}</p>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">{{ trans('admin.slug_'.$cate->language_code) }}</label>
                                                <p class="help-block slug-{{ $cate->language_code }}">{{ $cate->slug }}</p>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- /.tab-content -->
                </div>
                </form>
                <!-- nav-tabs-custom -->
            </div>
        </div>
    </section>
</div>
@endsection

@section('footer_script')
<script>
$(function() {
    $('.title-cate').bind('keyup change', function () {
       createSlugLink($(this));
    });
    function createSlugLink(obj) {
        var lang = $(obj).attr('lang');
        var str = $(obj).val();
        var slug = formatSlug(str);
        $(obj).closest('.box-body').find('.slug-'+lang).html(slug);
    }
});
</script>

@endsection