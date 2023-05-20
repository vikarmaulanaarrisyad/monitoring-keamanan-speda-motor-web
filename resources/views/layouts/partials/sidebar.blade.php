 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="index3.html" class="brand-link">
         <img src="{{ asset('/AdminLTE') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">AdminLTE 3</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="{{ asset('/AdminLTE') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                     alt="User Image">
             </div>
             <div class="info">
                 <a href="javascript:void(0)" class="d-block">{{ auth()->user()->name }}</a>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">

                 <li class="nav-item">
                     <a href="{{ route('dashboard') }}"
                         class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             Dashboard
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('relay.index') }}" class="nav-link {{ request()->is('relay') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-table"></i>
                         <p>
                             Management Sensor
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('location.index') }}" class="nav-link {{ request()->is(['location*',]) ? 'active' : '' }}">
                         <i class="nav-icon fas fa-map-marker-alt"></i>
                         <p>
                             Lokasi
                         </p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="javascript:void(0);" class="nav-link"
                         onclick="document.querySelector('#form-logout').submit()">
                         <i class="nav-icon fas fa-sign-in-alt"></i>
                         <p>
                             Logout
                         </p>
                     </a>
                     <form action="{{ route('logout') }}" method="post" id="form-logout">
                         @csrf
                     </form>
                 </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
