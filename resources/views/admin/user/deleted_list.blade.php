@extends('admin.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ trans('admin.user.lb_user') }}
            <small>{{ trans('admin.user.lb_manage') }}</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @include('notifications')
                <div class="box">
                    <div class="box-header with-border">
                        <a href="{{ route('admin_user_add') }}" class="btn btn-default btn-sm">{{ trans('admin.user.btn_add_new') }}</a>
                    </div>
                    <div class="box-body">
                        <div class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-striped dataTable table-hover">
                                      @if (count($users)==0)
                                        <tr><td colspan="9" align="center">Data not found</td></tr>
                                      @else
                                        <tr>
                                            <th>#ID</th>
                                            <th>{{ trans('admin.user.lb_company_name') }}</th>
                                            <th>{{ trans('admin.user.lb_email') }}</th>
                                            <th>{{ trans('admin.user.lb_phone') }}</th>
                                            <th>{{ trans('admin.user.lb_country') }}</th>
                                            <th>{{ trans('admin.user.lb_role') }}</th>
                                            <th>{{ trans('admin.user.lb_status') }}</th>
                                            <th>{{ trans('admin.user.lb_deleted_date') }}</th>
                                            <th>{{ trans('admin.user.lb_action') }}</th>
                                        </tr>
                                        @foreach($users as $user)
                                        <?php 
                                            $roleAdmin = config('allelua.roles.administrator');
                                        ?>
                                        <tr class="odd">
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->company_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone_number }}</td>
                                            <td>{{ $user->country_name }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>
                                                @if(isAdmin($user->role))
                                                <span class="label {{ getUserStatusIcon($user->status) }}">{{ getUserStatus($user->status) }}</span>
                                                @else
                                                <a href="javascript:void(0);" onclick="fncUpdateStatus('{{ route('admin_user_status', array('id' => $user->id)) }}');">
                                                    <span class="label {{ getUserStatusIcon($user->status) }}">{{ getUserStatus($user->status) }}</span>
                                                </a>
                                                @endif
                                            </td>
                                            <td>{{ $user->deleted_at }}</td>
                                            <td>
                                                @if(!isAdmin($user->role))
                                                <a href="javascript:void(0);" onclick="fncRestore('{{ route('admin_user_restore', array('id' => $user->id)) }}');" class="btn btn-danger btn-xs">
                                                    {{ trans('admin.user.btn_restore') }}
                                                </a>
                                                <a href="javascript:void(0);" onclick="fncDeleteForce('{{ route('admin_user_force_deleted', array('id' => $user->id)) }}');" class="btn btn-danger btn-xs">
                                                    {{ trans('admin.user.btn_delete') }}
                                                </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="dataTables_info" role="status" aria-live="polite">Showing {{ $users->firstItem() }} to {{ $users->count() }} of {{ $users->total() }} entries</div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="dataTables_paginate paging_simple_numbers">
                                        {{ $users->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
      </div>
    </section>
</div>
@endsection

@section('footer_script')
<script>
function fncUpdateStatus(url)
{
    if (!confirm('Are you sure active or inactive this account ?')) {
        return false;
    }
    window.location.href = url;
}
function fncRestore(url)
{
    if (!confirm('Are you sure restore this account ?')) {
        return false;
    }
    window.location.href = url;
}
function fncDeleteForce(url)
{
    if (!confirm('Are you sure delete forever this account ?')) {
        return false;
    }
    window.location.href = url;
}
</script>
@endsection