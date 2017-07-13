@extends('admin.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>General
            <small>Edit</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @include('notifications')
                <form role="form" action="{{ route('admin_setting_general') }}" id="form-general" method="post" enctype="multipart/form-data">
                <div class="nav-tabs-custom">
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <input type="file" name="data" />
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
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
                                                $title       = 'title_'.$lang->iso2;
                                                $description = 'description_'.$lang->iso2;
                                                $seoKeyword  = 'seo_keyword_'.$lang->iso2;
                                                $logo        = 'logo_'.$lang->iso2;
                                                $chk         = 'check_'.$lang->iso2;
                                                $logoRow     = isset($generals[$lang->iso2]['logo']) ? $generals[$lang->iso2]['logo'] : '';
                                            ?>
                                            <div class="form-group @if ($errors->has($title)) has-error @endif">
                                                <label class="control-label">{{ trans('admin.title_'.$lang->iso2) }}</label>
                                                <input type="text" class="form-control border-corner" name="{{ $title }}" placeholder="Input ..."
                                                        value="{{ old($title, isset($generals[$lang->iso2]['title']) ? $generals[$lang->iso2]['title'] : '') }}" />
                                                @if ($errors->has($title))
                                                  <p class="help-block">{{ $errors->first($title) }}</p>
                                                @endif
                                            </div>

                                            <div class="form-group @if ($errors->has($description)) has-error @endif">
                                                <label class="control-label">{{ trans('admin.description_'.$lang->iso2) }}</label>
                                                <textarea name="{{ $description }}" class="form-control border-corner" rows="3" placeholder="Input ...">{{ old($description, isset($generals[$lang->iso2]['description']) ? $generals[$lang->iso2]['description'] : '') }}</textarea>
                                                @if ($errors->has($description))
                                                  <p class="help-block">{{ $errors->first($description) }}</p>
                                                @endif
                                            </div>

                                            <div class="form-group @if ($errors->has($seoKeyword)) has-error @endif">
                                                <label class="control-label">{{ trans('admin.seo_keyword_'.$lang->iso2) }}</label>
                                                <textarea name="{{ $seoKeyword }}" class="form-control border-corner" rows="3" placeholder="Input ...">{{ old($seoKeyword, isset($generals[$lang->iso2]['seo_keyword']) ? $generals[$lang->iso2]['seo_keyword'] : '') }}</textarea>
                                                @if ($errors->has($seoKeyword))
                                                  <p class="help-block">{{ $errors->first($seoKeyword) }}</p>
                                                @endif
                                            </div>

                                            <div class="form-group @if ($errors->has($logo)) has-error @endif">
                                                <label class="control-label">{{ trans('admin.logo_'.$lang->iso2) }}</label>
                                                <input name="{{ $logo }}" type="file">
                                                <?php $logoPath = getLogoImage($logoRow); ?>
                                                @if(!empty($logoPath))
                                                <a target="_blank" href="{{ $logoPath }}">View Logo</a>
                                                @endif
                                                @if ($errors->has($logo))
                                                  <p class="help-block">{{ $errors->first($logo) }}</p>
                                                @endif
                                            </div>
                                            <div class="form-group @if ($errors->has($chk)) has-error @endif">
                                                <div class="checkbox">
                                                    <label>
                                                        <input name="{{ $chk }}" type="checkbox" value="1"> {{ trans('admin.check_'.$lang->iso2) }}
                                                    </label>
                                                </div>
                                                @if ($errors->has($chk))
                                                  <p class="help-block">{{ $errors->first($chk) }}</p>
                                                @endif
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

@endsection