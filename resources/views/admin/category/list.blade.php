@extends('admin.layout')
@section('content')
<style>
    .marker { opacity:0.0; }
</style>
<style name="impostor_size">
    .marker + tr { border-top-width:0px; }
</style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ trans('admin.category.lb_title_page') }}
            <small>{{ trans('admin.category.lb_title_main_page') }}</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @include('notifications')
                <form name="form1" id="form1" action="{{ route('admin_category_sort') }}" method="POST">
                <div class="box">
                    <div class="box-header with-border">
                        {{ csrf_field() }}
                        <input type="hidden" name="parent_id" value="{{ $parent_id or null }}" />
                        <a href="javascript:void(0);" onclick="updateSort();" class="btn btn-primary btn-sm">
                            {{ trans('admin.category.lb_sort') }}
                        </a>
                    </div>
                    <div class="box-body">
                        <div class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="sortable" class="table table-bordered table-striped dataTable table-hover">
                                      @if (count($categories)==0)
                                        <tr><td colspan="6" align="center">Data not found</td></tr>
                                      @else
                                        <thead>
                                        <tr>
                                            <th>#ID</th>
                                            @foreach($langs as $lang)
                                            <th>{{ trans('admin.category.lb_title') }} ({{ $lang->name }})</th>
                                            @endforeach
                                            <th>{{ trans('admin.category.lb_display_home') }}</th>
                                            <th>{{ trans('admin.category.lb_sort') }}</th>
                                            <th>{{ trans('admin.category.lb_created_date') }}</th>
                                            <th>{{ trans('admin.category.lb_action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($categories as $category)
                                        <tr class="odd ui-state-default">
                                            <?php $titles = splitTitle($category->titles, $category->langs); ?>
                                            <td>
                                                {{ $category->id }}
                                                <input type="hidden" name="sort[]" value="{{ $category->sort }}" class="sort" />
                                                <input type="hidden" name="ids[]" value="{{ $category->id }}" />
                                            </td>
                                            @foreach($titles as $code => $title)
                                            <td>
                                                <a href="{{ route('admin_category_sub', ['id' => $category->id]) }}">
                                                    {{ $title }}
                                                    <p style="color: #00a65a;">@if(isset($totalSubs[$category->id])) ({{ $totalSubs[$category->id] }}) @endif</p>
                                                </a>
                                            </td>
                                            @endforeach
                                            <td>{{ ($category->is_home == 1) ? 'Yes' : '' }}</td>
                                            <td>{{ $category->sort }}</td>
                                            <td>{{ $category->created_at }}</td>
                                            <td>
                                                <a href="{{ route('admin_category_edit', ['id' => $category->id, 'parent_id' => $parent_id]) }}" class="btn btn-default btn-xs">
                                                    {{ trans('admin.category.btn_edit') }}
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                        @endif
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="dataTables_info" role="status" aria-live="polite">Showing {{ count($categories) }} entries</div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
                </form>
            </div>
      </div>
    </section>
</div>
@endsection

@section('footer_script')
<script>
$(function() {
    if ($('style[name=impostor_size]').length) {
        var stylesheet = $('style[name=impostor_size]')[0].sheet,
        rule = stylesheet.rules ? stylesheet.rules[0].style : stylesheet.cssRules[0].style,
        setPadding = function(atHeight) {
            rule.cssText = 'border-top-width: '+atHeight+'px'; 
        };
    }

    $( "#sortable tbody" ).sortable({
        containment: 'parent',
        cursor: 'move',
        placeholder: "ui-state-highlight",
        axis:   'y',
        'start':function(ev, ui) {
            setPadding(ui.item.height());
        },
        'stop':function(ev, ui) {
            var next = ui.item.next();
            next.css({'-moz-transition':'none', '-webkit-transition':'none', 'transition':'none'});
            setTimeout(next.css.bind(next, {'-moz-transition':'border-top-width 0.1s ease-in', '-webkit-transition':'border-top-width 0.1s ease-in', 'transition':'border-top-width 0.1s ease-in'}));
        },
        helper: function(event, ui){
            var $clone =  $(ui).clone();
            $clone .css('position','absolute');
            return $clone.get(0);
        }
    });
    $( "#sortable tbody" ).disableSelection();
});
function updateSort() {
    $('.sort').each(function (index) {
        var sort = index + 1;
        $(this).val(sort);
    });
    $('#form1').submit();
}
</script>
@endsection