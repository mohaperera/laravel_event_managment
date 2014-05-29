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

  
    

  </div>
  <!-- END TOP NAVIGATION BAR -->
</div>


</div>
<!-- END HEADER -->

<div class="page-container row-fluid">

    <!-- BEGIN PAGE CONTAINER-->
    <div class="page-content">
        
        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <div class="clearfix"></div>
        <div class="content">

     {{ Form::open( array( 'action' => 'UsersController@postSignin', 'method'=>'post') ) }}
     <fieldset>
          <legend>Login</legend>

		<div class="control-group">
		    <label class="control-label" for="email">
				{{ Form::label('email', 'Email') }} 
			</label>
			<div class="controls">
				{{  Form::text('email') }}
				<span class="help-inline">{{ $errors->first('email','<span class="error">:message</span>'); }}</span>
			</div>
		</div>

		<div class="control-group">
		    <label class="control-label" for="password">
				{{ Form::label('password', 'Password') }} 
			</label>
			<div class="controls">
				{{  Form::password('password') }}<span class="help-inline">{{ $errors->first('password','<span class="error">:message</span>'); }}</span>
			</div>
		</div>


		<div class="control-group">
		   <div class="controls">
			{{ Form::submit('Login', array('class'=>'btn btn-primary')) }}
			</div>
		</div>

	</fieldset>
		

{{ Form::close() }}
	</div>
	  </div>
	</div>
<!-- END PAGE -->

<!-- END CONTAINER -->



</body>
</html>

