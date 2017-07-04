@extends('layouts.index_tutor')

@section('title', 'Home | Dashboard')
@section('main_title', 'DASHBOARD')
@section('sub_title', 'Control Panel')
@section('current_page', 'Dashboard')
@section('content')



@section('role', 'Tutor')


 <!-- Content Wrapper. Contains page content -->
     <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <h3> <a href="/tutor/courses" style="color:inherit" id="two">Courses </a></h3>
              <p><a href="/tutor/courses/create" style="color:inherit"> Add Course </a></p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-book"></i>
            </div>
      
          </div>
        </div>

       
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><a href="/tutor/student" style="color: inherit" id="three">Students </a></h3>

              <p><a href="/tutor/student/add" style="color: inherit"> Add Student </a></p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
           
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><a href="/tutor/grades" style="color: inherit;" id="four"> Grade </a></h3>

              <p><a href="/tutor/grades/reports" style="color: inherit"> Reports </a></p>
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
 @push('scripts')

