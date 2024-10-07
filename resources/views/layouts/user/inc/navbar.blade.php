<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="{{ url('/') }}" class="logo d-flex align-items-center">
    <img src="{{ asset('assets/login-workspace/images/skp_s_logo.png') }}" alt="">
    <span class="d-none d-lg-block">FMIS</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

{{-- <div class="search-bar">
  <form class="search-form d-flex align-items-center" method="POST" action="#">
    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
  </form>
</div><!-- End Search Bar --> --}}




<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    {{-- <li class="nav-item d-block d-lg-none">
      <a class="nav-link nav-icon search-bar-toggle " href="#">
        <i class="bi bi-search"></i>
      </a>
    </li><!-- End Search Icon--> --}}








    <li class="nav-item dropdown pe-3">

      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        {{-- <img src="{{ asset('assets/layouts/img/profile-img.png') }}" alt="Profile" class="rounded-circle"> --}}
        {{-- {{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('assets/layouts/img/profile-img.png') }} --}}
        <img src="{{ !is_null(Auth::user()->avatar) ? asset('assets/layouts/img/' . Auth::user()->avatar) : asset('assets/layouts/img/profile-img.png') }}" alt="Profile" class="rounded-circle">
        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
        {{-- <span class="d-none d-md-block dropdown-toggle ps-2">{{ implode(' ', array_filter([Auth::user()->first_name, Auth::user()->middle_name ? substr(Auth::user()->middle_name, 0, 1).'.' : '', Auth::user()->last_name])) }}</span> --}}

      </a><!-- End Profile Iamge Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <h6>{{ Auth::user()->name }}</h6>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        @role(['super-admin', 'budget-officer-iii', 'budget-officer-ii'])
          <li>
            <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.home') }}" target="_blank">
              <i class="bi bi-toggles"></i>
              <span>Admin Console</span>
            </a>
          </li>
        @endrole
        <li>
          <hr class="dropdown-divider">
        </li>

        <!-- <li>
          <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
            <i class="bi bi-gear"></i>
            <span>Account Settings</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li> -->

        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{-- {{ __('Logout') }}
                                    </a> --}}
            <i class="bi bi-box-arrow-right"></i>
            <span>Sign Out</span>

          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
          </form>

        </li>


      </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->
