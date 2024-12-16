<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">

    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link {{ request()->is('admin/home') ? '' : 'collapsed' }}" href="{{ route('admin.home') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <!-- Budget Ceiling -->
    @if(auth()->user()->hasRole(['budget-officer-iii', 'super-admin']))
    <li class="nav-item">
      <a class="nav-link {{ request()->is('admin/budget-ceiling') ? '' : 'collapsed' }}" href="{{ route('budget-ceilings.index') }}">
        <i class="bi bi-menu-button-wide"></i>
        <span>Budget Ceiling</span>
      </a>
    </li>
    @elseif(auth()->user()->hasRole('budget-officer-ii'))
    <li class="nav-item">
      <a class="nav-link {{ request()->is('admin/unit/budget-ceiling') ? '' : 'collapsed' }}" href="{{ route('admin.unit-budget-ceiling.index') }}">
        <i class="bi bi-menu-button-wide"></i>
        <span>Budget Ceiling</span>
      </a>
    </li>
    @endif

    <!-- Maintenance Section -->
    <li class="nav-heading">Maintenance</li>

        <!-- MFOs -->
    <li class="nav-item">
      <a class="nav-link {{ request()->is('admin/mfos') ? '' : 'collapsed' }}" href="{{ route('mfos.index') }}">
        <i class="bi bi-diagram-3"></i>
        <span>MFOs</span>
      </a>
    </li>

    <!-- PAP Settings -->
    <li class="nav-item">
      <a class="nav-link {{ request()->is('admin/pap-settings*') ? '' : 'collapsed' }}" data-bs-target="#papSettingsNav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gear"></i>
        <span>PAP Settings</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="papSettingsNav" class="nav-content collapse {{ request()->is('admin/pap-settings*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('paps.index') }}" class="{{ request()->is('admin/pap-settings/paps') ? 'active' : '' }}">
            <i class="bi bi-circle"></i><span>PAPs</span>
          </a>
        </li>
        <li>
          <a href="{{ route('pap-types.index') }}" class="{{ request()->is('admin/pap-settings/pap-types') ? 'active' : '' }}">
            <i class="bi bi-circle"></i><span>PAP Types</span>
          </a>
        </li>
       
      </ul>
    </li>



    <!-- Fund Settings -->
    <li class="nav-item">
      <a class="nav-link {{ request()->is('admin/fund-sources') || request()->is('admin/fund-sources/*') ? '' : 'collapsed' }}" data-bs-target="#fundSourcesNav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-cash"></i>
        <span>Fund Settings</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="fundSourcesNav" class="nav-content collapse {{ request()->is('admin/fund-sources') || request()->is('admin/fund-sources/*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('fund-sources.index') }}" class="{{ request()->is('admin/fund-sources') ? 'active' : '' }}">
            <i class="bi bi-circle"></i><span>Fund Sources</span>
          </a>
        </li>
        <li>
          <a href="{{ route('budget-types.index') }}" class="{{ request()->is('admin/budget-types') ? 'active' : '' }}">
            <i class="bi bi-circle"></i><span>Budget Types</span>
          </a>
        </li>
        <li>
          <a href="{{ route('sub-funds.index') }}" class="{{ request()->is('admin/sub-funds') ? 'active' : '' }}">
            <i class="bi bi-circle"></i><span>Sub Funds</span>
          </a>
        </li>
        <li>
          <a href="{{ route('school-fee-classifications.index') }}" class="{{ request()->is('admin/school-fee-classifications') ? 'active' : '' }}">
            <i class="bi bi-circle"></i><span>School Fee Classifications</span>
          </a>
        </li>
      </ul>
    </li>

    <!-- Units -->
    <li class="nav-item">
      <a class="nav-link {{ request()->is('admin/units') ? '' : 'collapsed' }}" href="{{ route('units.index') }}">
        <i class="bi bi-building"></i>
        <span>Units</span>
      </a>
    </li>

    <!-- Campus -->
    @permission('read-campus')
    <li class="nav-item">
      <a class="nav-link {{ request()->is('admin/campuses') ? '' : 'collapsed' }}" href="{{ route('campuses.index') }}">
        <i class="bi bi-geo-alt"></i>
        <span>Campus</span>
      </a>
    </li>
    @endpermission

    <!-- Budget Year -->
    <li class="nav-item">
      <a class="nav-link {{ request()->is('admin/budget-year') ? '' : 'collapsed' }}" href="{{ route('budget-year.index') }}">
        <i class="bi bi-calendar"></i>
        <span>Budget Years</span>
      </a>
    </li>



<!-- Procurement Settings -->
    <li class="nav-item">
      <a class="nav-link {{ request()->is('admin/procurement-settings*') ? '' : 'collapsed' }}" data-bs-target="#procurementSettingsNav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-clipboard-data"></i>
        <span>Procurement Settings</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="procurementSettingsNav" class="nav-content collapse {{ request()->is('admin/procurement-settings*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('allotment-classes.index') }}" class="{{ request()->is('admin/allotment-classes') ? 'active' : '' }}">
            <i class="bi bi-circle"></i><span>Allotment Classes</span>
          </a>
        </li>
        <li>
          <a href="{{ route('object-expenditures.index') }}" class="{{ request()->is('admin/object-expenditures') ? 'active' : '' }}">
            <i class="bi bi-circle"></i><span>Object Expenditures</span>
          </a>
        </li>
        <li>
            <a href="{{ route('identified-expenses.index') }}" class="{{ request()->is('admin/identified-expenses') ? 'active' : '' }}">
            <i class="bi bi-circle"></i><span>Identified Expenses</span>
          </a>
        </li>
      </ul>
    </li>



  <li class="nav-item">
      <a class="nav-link {{ request()->is('admin/products*') || request()->is('admin/product-categories*') ? '' : 'collapsed' }}" data-bs-target="#productSettingsNav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-box"></i>
          <span>Product Settings</span>
          <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="productSettingsNav" class="nav-content collapse {{ request()->is('admin/products*') || request()->is('admin/product-categories*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
          <li>
              <a href="{{ route('products.index') }}" class="{{ request()->is('admin/products') ? 'active' : '' }}">
                  <i class="bi bi-circle"></i><span>Products</span>
              </a>
          </li>
          <li>
              <a href="{{ route('product-categories.index') }}" class="{{ request()->is('admin/product-categories') ? 'active' : '' }}">
                  <i class="bi bi-circle"></i><span>Product Categories</span>
              </a>
          </li>
      </ul>
  </li>

  </ul>
</aside>
