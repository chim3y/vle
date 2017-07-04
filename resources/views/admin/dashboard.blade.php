@extends('layouts.index_admin')

@section('title', 'Home | Dashboard')
@section('main_title')
DASHBOARD 
@endsection

@section('sub_title', 'Control Panel')
@section('current_page', 'Dashboard')
@section('content')
     <div id="one"> </div>
 <!-- Content Wrapper. Contains page content -->

     <!-- Main content -->
    <section class="content">
     <div class="row">
       <!-- ./col -->
        <div class="col-lg-4 col-xs-7">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3><a href="/admin/departments" style="color: inherit" id="two">   Department  </a></h3>
 
              <p><a href="/admin/departments/create" style="color: inherit">Add Department  </a> </p>

            </div>

            <div class="icon">

              <i class="ion ion-trophy"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->


    <!-- ./col -->
        <div class="col-lg-4 col-xs-7">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><a href="/admin/programmes" style="color: inherit" id="three">Programme </a></h3>

              <p><a href="admin/programmes/create" style="color: inherit"> &nbsp; Add Programme </a> </p>
            </div>
            <div class="icon">
              <i class="ion ion-trophy"></i>
            </div>
      
          </div>
        </div>

          <div class="col-lg-4 col-xs-7">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
            <h3> <a href="/admin/semesters" style="color:inherit"> Semesters </a></h3>
              <p><a href="/admin/semessters" style="color:inherit"> Add Semester </a></p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-book"></i>
            </div>
          
          </div>
        </div>
          </div>
        

      <!-- Small boxes (Stat box) -->
  <div class="row">
         <div class="col-lg-4 col-xs-7">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <h3> <a href="/admin/courses" style="color:inherit" id="four">Courses </a></h3>
              <p><a href="/admin/courses/create" style="color:inherit"> Add Course </a></p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-book"></i>
            </div>
          
          </div>
        </div>

        <!-- ./col -->
       
         <div class="col-lg-4 col-xs-7">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><a href="/admin/users" style="color: inherit" id="five">USERS </a></h3>

              <p><a href="/admin/users/create" style="color: inherit"> Add User </a></p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
         <div class="col-lg-4 col-xs-7">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><a href="/admin/grades" style="color: inherit;" id="six"> Grade </a></h3>

              <p><a href="/admin/grades/reports" style="color: inherit"> Reports </a></p>
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
 
