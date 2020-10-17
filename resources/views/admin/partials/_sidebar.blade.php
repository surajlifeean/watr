    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin')}}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
@if(Auth::guard('admin')->check())
  Admin
@endif

@if(Auth::guard('member')->check())
  Partner
@endif


          Panel<!-- <sup>2</sup> --></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
@if(Auth::guard('admin')->check())

        <a class="nav-link" href="{{route('admin')}}">
@elseif(Auth::guard('member')->check())

        <a class="nav-link" href="{{route('member')}}">
        
@endif
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <hr class="sidebar-divider">


@if(Auth::guard('admin')->check())

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
          <i class="fas fa-fw fa-folder"></i>
          <span>User</span>
        </a>
        <div id="collapseUsers" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <a class="collapse-item" href="{{route('parameter.create')}}">Add</a> -->
            <a class="collapse-item" href="{{route('admin.user.index')}}">List</a>
        </div>
       </div>
     </li>


      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Parameter</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('parameter.create')}}">Add</a>
            <a class="collapse-item" href="{{route('parameter.index')}}">List</a>
            </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTest" aria-expanded="true" aria-controls="collapseTest">
          <i class="fas fa-fw fa-folder"></i>
          <span>Test</span>
        </a>
        <div id="collapseTest" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('test.create')}}">Add</a>
            <a class="collapse-item" href="{{route('test.index')}}">List</a>
            </div>
        </div>
      </li>


      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePartner" aria-expanded="true" aria-controls="collapsePartner">
          <i class="fas fa-fw fa-folder"></i>
          <span>Partner</span>
        </a>
        <div id="collapsePartner" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <a class="collapse-item" href="{{route('partner.create')}}">Add</a> -->
            <a class="collapse-item" href="{{route('partner.index')}}">List</a>
            <a class="collapse-item" href="{{route('assistance.index')}}">Assist Partners</a>

            <!-- <a class="collapse-item" href="forgot-password.html">Forgot Password</a> -->
         </div>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrder" aria-expanded="true" aria-controls="collapseOrder">
          <i class="fas fa-fw fa-folder"></i>
          <span>Order</span>
        </a>
        <div id="collapseOrder" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <a class="collapse-item" href="{{route('partner.create')}}">Add</a> -->
            <a class="collapse-item" href="{{route('order.index')}}">List</a>
            <!-- <a class="collapse-item" href="forgot-password.html">Forgot Password</a> -->
         </div>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRecom" aria-expanded="true" aria-controls="collapseRecom">
          <i class="fas fa-fw fa-folder"></i>
          <span>Recommendation</span>
        </a>
        <div id="collapseRecom" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('recommendation.index')}}">Recommendation</a>
            <a class="collapse-item" href="{{route('param-recomm.index')}}">Assign Recomendations</a>

         </div>
        </div>
      </li>




      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAbout" aria-expanded="true" aria-controls="collapseAbout">
          <i class="fas fa-fw fa-folder"></i>
          <span>About us</span>
        </a>
        <div id="collapseAbout" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <a class="collapse-item" href="{{route('partner.create')}}">Add</a> -->
            <a class="collapse-item" href="{{route('aboutus.index')}}">Show/Edit</a>
            <!-- <a class="collapse-item" href="forgot-password.html">Forgot Password</a> -->
            <a class="collapse-item" href="{{route('aboutus.create')}}">Add</a>

         </div>
        </div>
      </li>



      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="{{route('contact.index')}}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Contacts</span></a>
      </li>

@elseif(Auth::guard('member')->check())

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrder" aria-expanded="true" aria-controls="collapseOrder">
          <i class="fas fa-fw fa-folder"></i>
          <span>Order</span>
        </a>
        <div id="collapseOrder" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <a class="collapse-item" href="{{route('partner.create')}}">Add</a> -->
            <a class="collapse-item" href="{{route('order-member.index')}}">List</a>
            <!-- <a class="collapse-item" href="forgot-password.html">Forgot Password</a> -->
         </div>
        </div>
      </li>

@endif
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
