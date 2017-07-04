<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title> @yield('title') </title>
     <!-- Datatables -->
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css" >
  <link rel="stylesheet" href="/plugins/datepicker/datepicker3.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->

   <link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  
  <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">

    <link rel="stylesheet" href="/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet"  href="/bootstrap/css/bootstrap-tour.min.css" rel="stylesheet">
<link rel="stylesheet"  href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" >


<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">



 


  @yield('stylesheets')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
   <!-- Logo -->
    <a href="/admin/dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>e</b>LP</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>eLearning Portal</b></span>

    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">

        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
        

           <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                @if( !empty (Auth::user()->image))
                <img src="{{ asset('/images/users/'.Auth::user()->image) }}" style="height:20px ; width:20px " class="img-circle" alt="User Image">
          @else
          <img src="{{ asset('/images/users/user_default.png') }}"  style="height:20px ; width:20px " class="img-circle" alt="User Image">
          @endif
              <span class="hidden-xs">   </span>
            </a>

            <ul class="dropdown-menu">
                <li class="user-header">
         @if( !empty (Auth::user()->image))
                <img src="{{ asset('/images/users/'.Auth::user()->image) }}"   style="height:70px; width:70px" class="img-circle" alt="User Image">
          @else
          <img src="{{ asset('/images/users/user_default.png') }}"   style="height:70px; width:70px" class="img-circle" alt="User Image">
          @endif
                <p>

             
                 {{Auth::user()->name}}
                  <small>Admin</small>
                </p>
                </li>

          <li class="user-footer">
                <div class="pull-left">
                  <a href="/users/{{Auth::user()->id}}/{{ str_slug(Auth::user()->name)}}/profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">

         <a href="{{ url('/logout') }}"
                                          style="color:#4c4c4c"   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-power-off" aria-hidden="true"></i> Logout
                                        </a>


                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            </ul>
         </li>
        </ul>
      </div>
    </nav>
  </header>
               
       
   
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
 
         <!-- search form -->
      <form action="#" method="get" class="sidebar-form">

        <div class="input-group">

          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
     <ul class="sidebar-menu">
        <li class="header" > MAIN NAVIGATION</li>
        <li class="active treeview">
       <a href="{{ URL::route('admin.dashboard') }}"> 
            <i class="fa fa-dashboard" ></i> <span >Dashboard</span>
          </a>
        </li>
        <li>
       <a href="{{ URL::route('admin.users') }}"> 
            <i class="fa fa-users"></i> <span>Users</span>
          </a>
        </li>
        <li>
       <a href="{{ URL::route('admin.tutors') }}"> 
            <i class="fa fa-user "></i> <span>Tutors</span>
          </a>
        </li>
        <li >
       <a href="{{ URL::route('admin.students') }}"> 
            <i class="fa fa-user"></i> <span>Students</span>
          </a>
        </li>
        
        <li>
       <a href="{{ URL::route('admin.courses') }}"> 
            <i class="fa fa-book"></i> <span>Courses</span>
          </a>
        </li>

          <li>
       <a href="/admin/semesters"> 
            <i class="fa fa-users"></i> <span>Semesters</span>
          </a>
        </li>
      
       <li>
       <a href="{{ URL::route('admin.departments') }}"> 
            <i class="fa fa-building-o"></i> <span>Departments</span>
          </a>
        </li>

         <li>
       <a href="{{ URL::route('admin.programmes') }}"> 
            <i class="fa fa-graduation-cap"></i> <span>  Programme</span>
          </a>
        </li>

      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       @yield('main_title')
        <small>@yield('sub_title')</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/" style="color: inherit;"><i class="fa fa-dashboard"></i>  Home</a></li>
        <li class="active">@yield('current_page')</li>
      </ol>
    </section>
    <div class="container">
  @yield('content')
    <!-- /.content -->
</div>
</div>
</div>
  <!-- /.content-wrapper -->
 
  <footer class="main-footer">
    <strong>Copyright &copy; 2017-2018 <a href="#" id="#one">eLearning Portal </a>.</strong> All rights
    reserved.
  </footer>


<!-- ./wrapper -->


<!-- jQuery 2.2.3 -->

<script src="/plugins/jQuery/jquery-3.1.1.min.js"></script>



<!-- Bootstrap 3.3.6 -->

<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/bootstrap/js/bootstrap-tour.min.js"></script>
<!-- DataTables -->

<script src="/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->

<script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- AdminLTE App -->

<script src="/dist/js/app.min.js"></script>
<!-- bootstrap datepicker -->
<script src="/plugins/datepicker/bootstrap-datepicker.js"></script>



<script src="https://cdn.datatables.net/1.10.15/js/buttons.print.js"> </script>
<script src="https://cdn.datatables.net/1.10.15/js/buttons.flash.js"> </script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"> </script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"> </script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"> </script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"> </script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js"> </script>



<script>
// Instance the tour
var tour = new Tour({
  debug: true,
  storage: true,
  steps: [
  {
    element: "#one",
    title: "Hello {{Auth::user()->name}}",
    content: "Welcome to Admin Dashboard, I will help you get started.",
    placement: "bottom",
    duration:4000,

  },
 {
    element: "#two",
    title: "Department",
    content: "Lets Start with Department.click on Department Module to view Department Page.",
    placement: "left",
    duration:4000,
    
  },
  {
    element: "#three",
    title: "Programme",
    content: "Click on Programme to view all the Programme listed.",
    placement: "bottom",
     duration:4000,
    },
    {
    element: "#four",
    title: "Course",
    content: "Click on Course to view all the Courses and there page.",
    placement: "bottom",
     duration:4000,
    },
    {
    element: "#five",
    title: "Users",
    content: "You can view all the users here.",
    placement: "bottom",
     duration:4000,
    },
    
      {
    element: "#",
    title: "View grade",
    content: "Click on Grade module to View students grade",
    placement: "top",
    onShow: function() {
      return $("#aone").addClass("open");
    },      onHide: function() {
      $("#one").removeClass("open"); 
    } 
  }    
]});

if (tour.ended()) {
  tour.restart();
} else {
  tour.init();
  tour.start();
  window.localStorage.clear();
}

</script>


@stack('scripts')


</body>
</html>