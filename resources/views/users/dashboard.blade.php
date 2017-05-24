@extends('layouts.index')

@section('title', 'Home | Dashboard')
@section('main_title', 'DASHBOARD')
@section('sub_title', 'Control Panel')
@section('current_page', 'Dashboard')
@section('content')

@section('name')
{{ ucfirst(trans(Auth::guard('web')->user()->name)) }} 
@endsection

@section('role', 'User')

@section('link_dashboard')
<a href='/dasboard'> Dashboard </a>
@endsection
 <!-- Content Wrapper. Contains page content -->
     <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <h3> <a href="/courses" style="color:inherit">Courses </a></h3>
              <p><a href="/courses/create" style="color:inherit"> Add Course </a></p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-book"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

       


    </section>
    <!-- /.content -->

  @endsection
 
