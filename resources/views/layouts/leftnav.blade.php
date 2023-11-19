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
      <li class="nav-item menu-open">
        <a href="#" class="nav-link {{ Route::is("admins") ? "active" : "" }}">
          <i class="fas fa-users-cog"></i>&nbsp
          <p>
            Admins
          </p>
        </a>
      </li>
      <li class="nav-item menu-open">
        <a href="#" class="nav-link {{ Route::is("customers") ? "active" : "" }}">
          <i class="fas fa-users"></i>&nbsp
          <p>
            Customers
          </p>
        </a>
      </li>
      <li class="nav-item menu-open">
        <a href="#" class="nav-link {{ Route::is("branches") ? "active" : "" }}">
          <i class="fas fa-warehouse"></i>&nbsp
          <p>
            Branches
          </p>
        </a>
      </li>
      <li class="nav-item menu-open">
        <a href="#" class="nav-link {{ Route::is("packs") ? "active" : "" }}">
          <i class="fas fa-box-open"></i>&nbsp
          <p>
            Packages
          </p>
        </a>
      </li>
      <li class="nav-item menu-open">
        <a href="#" class="nav-link {{ Route::is("roles") ? "active" : "" }}">
          <i class="fas fa-cogs"></i>&nbsp
          <p>
            Roles and Privileges
          </p>
        </a>
      </li>
      <li class="nav-item menu-open">
        <a href="#" class="nav-link {{ Route::is("sorting") ? "active" : "" }}">
          &nbsp<i class="fas fa-filter"></i>&nbsp
          <p>
            Sorting
          </p>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->