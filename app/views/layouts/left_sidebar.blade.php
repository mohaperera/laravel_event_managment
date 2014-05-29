 <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar" id="main-menu">
    <!-- BEGIN MINI-PROFILE -->
    <div class="user-info-wrapper">
      <div class="profile-wrapper"> <img src="{{ asset('assets/img/profiles/avatar.jpg') }} " data-src="{{ asset('assets/img/profiles/avatar.jpg') }}" data-src-retina="{{ asset('assets/img/profiles/avatar2x.jpg') }}" width="69" height="69" /> </div>
      <div class="user-info">
        <div class="greeting">Welcome</div>
        <div class="username">John <span class="semi-bold">Smith</span></div>
        <div class="status">Status<a href="#">
          <div class="status-icon green"></div>
          Online</a></div>
      </div>
    </div>
    <!-- END MINI-PROFILE -->
    <!-- BEGIN SIDEBAR MENU -->
   
    <ul>
  
        <li class="active"> 
            <a href="{{ url('/') }}" data-toggle="tooltip" title="Dashboard" data-original-title="Dashboard">  
                <img width="20" src="{{ asset('assets/img/selecticon/home.png') }}"/> 
                <span class="title">Dashboard</span> 
            </a> 
        </li>
        <li class="" > 
            <a href="{{ url('managers') }}" data-toggle="tooltip" title="Managers" data-original-title="Managers">
                <img width="20" src="{{ asset('assets/img/icon_speakers@2x.png') }}"/> 
                <span class="title">Speakers</span>  
            </a> 
        </li>

        <li class=""> 
            <a href="{{ url('events') }}" data-toggle="tooltip" title="Events" data-original-title="Events">
                <img width="20" src="{{ asset('assets/img/Sessions.png') }}"/>
                 <span class="title">Sessions</span>  
            </a> 
        </li>

        <li class=""> 
            <a href="{{ url('sponsors') }}" data-toggle="tooltip" title="Sponsors" data-original-title="Sponsors"> 
                <img width="20" src="{{ asset('assets/img/award@2x.png') }}"/>
                 <span class="title">Sponsors</span>  </a> </li>
        

        <li class=""> 
            <a href="{{ url('session') }}" data-toggle="tooltip" title="Session" data-original-title="Session"> 
                <img width="20" src="{{ asset('assets/img/icon_exhibitors@2x.png') }}"/> 
                <span class="title">Exhibitors</span>  </a> 
        </li>

        <li class=""> 
            <a href="Exhibitors.html" data-toggle="tooltip" title="Exhibitors" data-original-title="Exhibitors"> 
                <img width="20" src="{{ asset('assets/img/icon_exhibitors@2x.png') }}"/> 
                <span class="title">Exhibitors</span>  </a> 
        </li>
        
        <li class=""> 
            <a href="Booths.html" data-toggle="tooltip" title="Booths" data-original-title="Booths"> 
                <img width="20" src="{{ asset('assets/img/booths.png') }}"/> 
                <span class="title">Booths</span>  </a> </li>
        
        <li class=""> 
            <a href="Attendee.html" data-toggle="tooltip" title="Attendee" data-original-title="Attendee"> 
                <img width="20" src="{{ asset('assets/img/Attendee.png') }}"/> 
                <span class="title">Attendee</span>  </a> </li>
        
        <li class=""> 
            <a href="Hotels.html" data-toggle="tooltip" title="Hotels" data-original-title="Hotels"> 
                <img width="20" src="{{ asset('assets/img/icon_hotels@2x.png') }}"/> 
                <span class="title">Hotels</span>  
            </a> 
        </li>
        
        <li class=""> 
            <a href="Messaging.html" data-toggle="tooltip" title="Push Messaging" data-original-title="Push Messaging"> 
                <img width="20" src="{{ asset('assets/img/messages@2x.png') }}"/> 
                <span class="title">Push Messaging</span>  
            </a> 
        </li>
   
    </ul>

    <a href="#" class="scrollup">Scroll</a>
    <div class="clearfix"></div>
    <!-- END SIDEBAR MENU -->
  </div>
  <!-- END SIDEBAR -->
  <script>
  $("a[data-toggle='tooltip']").tooltip();
  </script>