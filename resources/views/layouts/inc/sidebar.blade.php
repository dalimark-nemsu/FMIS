<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
          <a class="nav-link {{(request()->is('admin/home')) ? '' : 'collapsed' }}" href="{{ route('admin.home') }}">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <!-- End Dashboard Nav -->
      @if(auth()->user()->hasRole(['budget-officer-iii', 'super-admin']))
        <!-- Budget Officer III: Access to Budget Ceiling -->
        <li class="nav-item">
            <a class="nav-link {{ request()->is('budget-ceiling') ? '' : 'collapsed' }}" href="{{ route('budget-ceilings.index') }}">
                <i class="bi bi-menu-button-wide"></i>
                <span>Budget Ceiling</span>
            </a>
        </li>
      @elseif(auth()->user()->hasRole('budget-officer-ii'))
        <!-- Budget Officer II: Access to Unit Budget Ceiling -->
        <li class="nav-item">
            <a class="nav-link {{ request()->is('unit/budget-ceiling') ? '' : 'collapsed' }}" href="{{ route('admin.unit-budget-ceiling.index') }}">
              <i class="bi bi-menu-button-wide"></i>
                <span>Budget Ceiling</span>
            </a>
        </li>
      @endif

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
      <a class="nav-link {{(request()->is('paps')) ? '' : 'collapsed' }}" href="{{ route('paps.index') }}">
        <i class="bi bi-list-check"></i>
        <span>PAPs</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{(request()->is('mfos')) ? '' : 'collapsed' }}" href="{{ route('mfos.index') }}">
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

    @permission('read-campus')
      <li class="nav-item">
        <a class="nav-link {{(request()->is('campus')) ? '' : 'collapsed' }}" href="{{ route('campuses.index') }}">
          <i class="bi bi-geo-alt"></i>
          <span>Campus</span>
        </a>
      </li>
    @endpermission

    <li class="nav-item">
      <a class="nav-link {{(request()->is('budget-year')) ? '' : 'collapsed' }}" href="{{ route('budget-year.index') }}">
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
