<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>
      Events Management 
      @yield('title')
    </title>
    @include('layouts.css')
    @include('layouts.js')
</head>
<body class="bodyclass">
<div class="header navbar navbar-inverse ">

  <!-- BEGIN TOP NAVIGATION BAR -->
  <div class="navbar-inner">
    
    <div class="header-seperation">
      <ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">
        <li class="dropdown"> <a id="main-menu-toggle" href="#main-menu"  class="" >
          <div class="iconset top-menu-toggle-white"></div>
          </a> 
        </li>
      </ul>
      <!-- BEGIN LOGO -->
      <a href="index.html">
        <img src="{{ asset('assets/img/logo.png') }}" class="logo"  data-src="{{ asset('assets/img/logo.png') }}" data-src-retina="{{ asset('assets/img/logo2x.png') }}" />
      </a>
      <!-- END LOGO -->
   
    </div>
    <!-- END RESPONSIVE MENU TOGGLER -->

    @include('layouts.header')
    

  </div>
  <!-- END TOP NAVIGATION BAR -->
</div>


</div>
<!-- END HEADER -->

<!-- BEGIN CONTAINER -->
<div class="page-container row-fluid">
  @include('layouts.left_sidebar')

    <!-- BEGIN PAGE CONTAINER-->
    <div class="page-content">
        
        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <div class="clearfix"></div>
        <div class="content">
          
            @yield('content')
        </div>
  </div>
</div>
<!-- END PAGE -->

<!-- END CONTAINER -->



</body>
</html>
