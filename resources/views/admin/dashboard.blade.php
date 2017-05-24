@extends('layouts.index_admin')

@section('title', 'Home | Dashboard')
@section('main_title', 'DASHBOARD')
@section('sub_title', 'Control Panel')
@section('current_page', 'Dashboard')
@section('content')

 <!-- Content Wrapper. Contains page content -->
     <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <h3> <a href="/admin/courses" style="color:inherit">Courses </a></h3>
              <p><a href="/admin/courses/create" style="color:inherit"> Add Course </a></p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-book"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><a href="/admin/programmes" style="color: inherit">Programme </a></h3>

              <p><a href="admin/programmes/create" style="color: inherit"> Add Programme </a> </p>
            </div>
            <div class="icon">
              <i class="ion ion-trophy"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><a href="/admin/users" style="color: inherit">USERS </a></h3>

              <p><a href="/admin/users/create" style="color: inherit"> Add User </a></p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><a href="/admin/grades" style="color: inherit;"> Grade </a></h3>

              <p><a href="/admin/grades/reports" style="color: inherit"> Reports </a></p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

 <div class="row">
       <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><a href="/admin/departments" style="color: inherit">Department </a></h3>

              <p><a href="/admin/departments/create" style="color: inherit"> Add Department </a> </p>
            </div>
            <div class="icon">
              <i class="ion ion-trophy"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
  </div>
    </section>
    <!-- /.content -->

  @endsection
 
