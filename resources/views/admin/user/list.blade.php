@extends('admin.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Users
            <small>Manage</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @include('notifications')
                <div class="box">
                    <div class="box-header with-border">
                        <a href="{{ route('admin_user_add') }}" class="btn btn-default btn-sm">Add new</a>
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
                                            <th>Company name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Country</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Create date</th>
                                            <th>Action</th>
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
                                            <td>{{ $user->created_at }}</td>
                                            <td>
                                                @if(!isAdmin($user->role))
                                                <a href="{{ route('admin_user_edit', ['id' => $user->id]) }}" class="btn btn-default btn-xs">Edit</a>
                                                <a href="javascript:void(0);" onclick="fncDelete('{{ route('admin_user_delete', array('id' => $user->id)) }}');" class="btn btn-danger btn-xs">Delete</a>
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
function fncDelete(url)
{
    if (!confirm('Are you sure delete this account ?')) {
        return false;
    }
    window.location.href = url;
}
</script>
@endsection