<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">

    {{-- @if(auth()->user()->hasRole(['barangay_user', 'barangay_admin', 'municipal_admin', 'provincial_admin', 'super_admin'])) --}}
        <li class="nav-item">
          <a class="nav-link {{(request()->is('home')) ? '' : 'collapsed' }}" href="#">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <!-- End Dashboard Nav -->


        <li class="nav-item">
            <a class="nav-link {{(request()->is('budget-ceiling')) ? '' : 'collapsed' }}" href="#">
                <i class="bi bi-bar-chart"></i>
                <span>Budget Ceiling</span>
            </a>
        </li>
        <!-- End Profile Page Nav -->


        {{-- <li class="nav-heading">Master List</li>

        <li class="nav-item">
          <a class="nav-link {{(request()->is('residents')) ? '' : 'collapsed' }}" href="#">
            <i class="bi bi-briefcase"></i>
            <span>Youths</span>
          </a>
        </li> --}}
        <!-- End Residents Nav -->
    {{-- @endif --}}



    {{-- @if(auth()->user()->hasRole(['barangay_admin', 'municipal_admin', 'provincial_admin', 'super_admin'])) --}}
    <li class="nav-heading">Maintenance</li>

    <li class="nav-item">
      <a class="nav-link {{(request()->is('paps')) ? '' : 'collapsed' }}" href="#">
        <i class="bi bi-list-check"></i>
        <span>PAPs</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{(request()->is('mfos')) ? '' : 'collapsed' }}" href="#">
        <i class="bi bi-diagram-3"></i>
        <span>MFOs</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{(request()->is('fund-sources')) ? '' : 'collapsed' }}" href="{{ route('fund-sources.index') }}">
        <i class="bi bi-cash"></i>
        <span>Fund Sources</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{(request()->is('units')) ? '' : 'collapsed' }}" href="{{ route('units.index') }}">
        <i class="bi bi-building"></i>
        <span>Units</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{(request()->is('campus')) ? '' : 'collapsed' }}" href="#">
        <i class="bi bi-geo-alt"></i>
        <span>Campus</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{(request()->is('budget-year')) ? '' : 'collapsed' }}" href="#">
        <i class="bi bi-calendar"></i>
        <span>Budget Year</span>
      </a>
    </li>

    <!-- End Users Nav -->

    {{-- <li class="nav-item">
      <a class="nav-link {{(request()->is('officials')) ? '' : 'collapsed' }}" href="#">
        <i class="bi bi-people"></i>
        <span>Officials</span>
      </a>
    </li> --}}
    <!-- End Officials Nav -->

    {{-- <li class="nav-item">
      <a class="nav-link {{(request()->is('positions')) ? '' : 'collapsed' }}" href="#">
        <i class="bi bi-person-badge"></i>
        <span>Positions</span>
      </a>
    </li> --}}
    <!-- End Positions Nav -->

    {{-- <li class="nav-item">
      <a class="nav-link {{(request()->is('puroks')) ? '' : 'collapsed' }}" href="#">
        <i class="bi bi-house-door"></i>
        <span>Puroks</span>
      </a>
    </li> --}}
    <!-- End Puroks Nav -->
    {{-- @endif --}}

    {{-- @if(auth()->user()->hasRole(['municipal_admin', 'provincial_admin', 'super_admin'])) --}}
    {{-- <li class="nav-item">
      <a class="nav-link {{(request()->is('barangays')) ? '' : 'collapsed' }}" href="#">
        <i class="bi bi-geo-alt"></i>
        <span>Barangays</span>
      </a>
    </li> --}}
    <!-- End Barangays Nav -->
    {{-- @endif --}}

    {{-- @if(auth()->user()->hasRole(['provincial_admin', 'super_admin'])) --}}
    {{-- <li class="nav-item">
      <a class="nav-link {{(request()->is('municipalities')) ? '' : 'collapsed' }}" href="#">
        <i class="bi bi-building"></i>
        <span>Municipalities</span>
      </a>
    </li> --}}
    <!-- End Municipalities Nav -->
    {{-- @endif --}}

    {{-- @if(auth()->user()->hasRole(['super_admin'])) --}}
    {{-- <li class="nav-item">
      <a class="nav-link {{(request()->is('provinces')) ? '' : 'collapsed' }}" href="#">
        <i class="bi bi-geo-alt-fill"></i>
        <span>Provinces</span>
      </a>
    </li> --}}
    <!-- End Provinces Nav -->

    {{-- <li class="nav-item">
      <a class="nav-link {{(request()->is('regions')) ? '' : 'collapsed' }}" href="#">
        <i class="bi bi-globe"></i>
        <span>Regions</span>
      </a>
    </li> --}}
    <!-- End Regions Nav -->
    {{-- @endif --}}

    {{-- @if(auth()->user()->hasRole(['barangay_admin', 'municipal_admin', 'provincial_admin', 'super_admin'])) --}}
      {{-- <li class="nav-item">
        <a class="nav-link {{ request()->is('reports') ? '' : 'collapsed' }}" href="#">

          <i class="bi bi-file-bar-graph"></i>
          <span>Reports</span>
        </a>
      </li> --}}
      <!-- End Reports Nav -->
    {{-- @endif --}}

  </ul>
</aside>
