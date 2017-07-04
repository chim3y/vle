@extends('layouts.index')

@section('title', 'Home | Dashboard')
@section('main_title', 'DASHBOARD')
@section('sub_title', 'Control Panel')
@section('current_page', 'Dashboard')
@section('content')

@section('name')
{{ ucfirst(trans(Auth::guard('web')->user()->name)) }} 
@endsection

@section('role', 'Student')

@section('link_dashboard')
<a href='/student/dasboard'> Dashboard </a>
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
            <h3> <a href="/student/courses" style="color:inherit" id="two">Courses </a></h3>
            <br/>
            </div>
            <div class="icon">
              <i class="ion ion-ios-book"></i>
            </div>
          

         
        <!-- ./col -->
      </div>
      </div>

      <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><a href="/student/grades" style="color: inherit;" id="three"> Grade </a></h3>
              <br/>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
     
          </div>
        </div>
        <!-- ./col -->
      </div>


    </section>
    <!-- /.content -->

  @endsection
 
