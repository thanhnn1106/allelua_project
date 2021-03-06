@extends('admin.layout')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Dashboard
        <small>Control panel</small>
    </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> Manage</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>44</h3>
                <p>User Registrations</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
  </div>
  <!-- /.row -->
</section>
@endsection

@section('footer_script')
@endsection