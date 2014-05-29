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
        <img src="{{ asset('assets/img/logo.png') }}" class="logo"  data-src="{{ asset('assets/img/logo.png') }} " data-src-retina="{{ asset('assets/img/logo2x.png') }}" />
      </a>
      <!-- END LOGO -->
   
    </div>
    <!-- END RESPONSIVE MENU TOGGLER -->

    <div class="header-quick-nav" >
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="pull-left">
            <ul class="nav quick-section">
                <li class="quicklinks"> <a href="#" class="" id="layout-condensed-toggle" >
                <div class="iconset top-menu-toggle-dark"></div>
                </a>
                </li>
                <div class="input-prepend inside search-form no-boarder"> 
                    <span class="add-on"> 
                        <a class="" href="#">
                            <div class=" top-search"></div>
                        </a>
                    </span>
                    <input type="text" style="width:250px;" placeholder="" class="no-boarder " name="">
                </div>
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->


        <!-- BEGIN CHAT TOGGLER -->
        <div class="pull-right"> 
        <div class="chat-toggler">  
            <a href="#" class="dropdown-toggle" id="my-task-list" data-placement="bottom">
                    
                <div class="user-details"> 
                    <div class="username">
                    
                        John <span class="bold">Smith</span>                                    
                    </div>                      
                </div> 
                <a data-toggle="dropdown" class="dropdown-toggle  pull-right" href="#"> 
                <div class="iconset top-down-arrow"></div>
                </a>
                
            <ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="dropdownMenu">
              <li><a href="/"> My Account</a>
              </li>
              <li><a href="/">Profile</a>
              </li>
              <li><a href="/">Recent Activity</a>
              </li>
              <li><a href="/"> Subscriptions</a>
              </li>
              
              <li><a href="/"> Customization</a>
              </li>
              <li class="divider"></li>                
              <li><a href="{{ url('users/logout') }}"><i class="icon-off"></i>&nbsp;&nbsp;Log Out</a></li>
            </ul>
           
            </a>                        
            <div class="profile-pic"> 
                <img alt="" src="{{ asset('assets/img/profiles/avatar_small.jpg') }}" data-src="{{ asset('assets/img/profiles/avatar_small.jpg') }}" data-src-retina="{{ asset('assets/img/profiles/avatar_small2x.jpg') }} " width="35" height="35" /> 
            </div>                  
        </div>
        
      </div>
      <!-- END CHAT TOGGLER -->
    </div>
    <!-- END TOP NAVIGATION MENU -->

      </div>
  <!-- END TOP NAVIGATION BAR -->
</div>
