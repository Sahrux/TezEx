  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      
      <li class="nav-item menu-open">
        <a href="#" class="nav-link {{ Route::is("home") ? "active" : "" }}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Home
          </p>
        </a>
      </li>
      @if(has_access_to("show_admins"))
      <li class="nav-item menu-open">
        <a href="{{ route("admins") }}" class="nav-link {{ Route::is("admins") ? "active" : "" }}">
          <i class="fas fa-users-cog"></i>&nbsp
          <p>
            Admins
          </p>
        </a>
      </li>
       @endif
     
      @if(has_access_to("show_customers"))
      <li class="nav-item menu-open">
        <a href="{{ route("customers") }}" class="nav-link {{ Route::is("customers") ? "active" : "" }}">
          <i class="fas fa-users"></i>&nbsp
          <p>
            Customers
          </p>
        </a>
      </li>
      @endif
      @if(has_access_to("show_branches"))
      <li class="nav-item menu-open">
        <a href="{{ route("branches") }}" class="nav-link {{ Route::is("branches") ? "active" : "" }}">
          <i class="fas fa-warehouse"></i>&nbsp
          <p>
            Branches
          </p>
        </a>
      </li>
      @endif
      @if(has_access_to("show_packages"))
      <li class="nav-item menu-open">
        <a href="{{ route("packs") }}" class="nav-link {{ Route::is("packs") ? "active" : "" }}">
          <i class="fas fa-box-open"></i>&nbsp
          <p>
            Packages
          </p>
        </a>
      </li>
      @endif
      @if(has_access_to("show_roles"))
      <li class="nav-item menu-open">
        <a href="{{ route("roles") }}" class="nav-link {{ Route::is("roles") ? "active" : "" }}">
          <i class="fas fa-cogs"></i>&nbsp
          <p>
            Roles and Privileges
          </p>
        </a>
      </li>
      @endif
      @if(has_access_to("make_sorting"))
      <li class="nav-item menu-open">
        <a href="{{ route("sorting") }}" class="nav-link {{ Route::is("sorting") ? "active" : "" }}">
          &nbsp<i class="fas fa-filter"></i>&nbsp
          <p>
            Sorting
          </p>
        </a>
      </li>
      @endif
    </ul>
  </nav>
  <!-- /.sidebar-menu -->