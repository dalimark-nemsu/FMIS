@extends('layouts.app')

@section('page-title', 'Unit Budget Ceiling')

@section('content')
<div class="pagetitle mb-4">
  <h1 class="fs-4">Budget Year {{ $selectedYear->year }}</h1>
</div>
<section class="section dashboard">
  <div class="row">
    <div class="col-3">
      <div class="card info-card sales-card">
        <div class="card-body">
          <h5 class="card-title mb-0">Amount</h5>
    
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-wallet-fill"></i>
            </div>
            <div class="ps-3 ">
              <div class="mb-0">
                <span class="fs-5 fw-bold">{{ '₱' . number_format($campusBudgetCeilings->sum('total_amount'),2) }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card info-card revenue-card">
        <div class="card-body">
          <h5 class="card-title mb-0">Allocated</h5>
    
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-currency-dollar"></i> 
            </div>
            <div class="ps-3 ">
              <div class="mb-0">
                <span class="fs-5 fw-bold">{{ '₱' . number_format($allocated, 2) }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card info-card customers-card">
        <div class="card-body">
          <h5 class="card-title mb-0">Unallocated</h5>
    
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-currency-dollar"></i> 
            </div>
            <div class="ps-3 ">
              <div class="mb-0">
                <span class="fs-5 fw-bold">{{ '₱' . number_format($unAllocated) }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div id="app-content">
  <!-- Container fluid -->
  <div class="app-content-area">
    <!-- row -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-md-flex border-bottom-0">
            <div class="flex-grow-1">
            </div>
          </div>
          <div class="card-body">
            <div class="row mt-2 mb-2">
              <div class="col-auto d-flex align-items-center">
                  <select id="budgetYear" class="form-select me-2 border-secondary">
                    <option value="" selected>Budget Year</option>
                    @foreach ($budgetYears as $budgetYear)
                      <option value="{{ $budgetYear->id }}" @if($budgetYear->id === $selectedYear->id) selected @endif>{{ $budgetYear->year }}</option>
                    @endforeach
                  </select>
                  <select name="fund_source" id="fundSource" class="form-select border-secondary me-2">
                    <option value="" selected>Fund Source</option>
                    @foreach ($fundSources as $fundSource)
                      <option value="{{ $fundSource->abbreviation }}">{{ $fundSource->abbreviation }}</option>
                    @endforeach
                  </select>
                  <select name="mfo" id="mfo" class="form-select border-secondary">
                    <option value="" selected>MFOs</option>
                    @foreach ($majorFinalOutputs as $majorFinalOutput)
                      <option value="{{ $majorFinalOutput->abbreviation }}">{{ $majorFinalOutput->abbreviation }}</option>
                    @endforeach
                  </select>
              </div>
              <div class="col-3 ms-auto">
                  <div class="input-group">
                      <span class="input-group-text">
                          <i class="bi bi-search"></i> <!-- Bootstrap 5 search icon -->
                      </span>
                      <input type="text" id="customSearch" class="form-control" placeholder="Search" aria-label="Search">
                  </div>
              </div>
            </div>
          
            <div class="table-responsive table-card">
              <table id="papsDataTable" class="table table-hover text-nowrap table-centered mt-0" style="width: 100%">
                <thead class="table-primary">
                  <tr>
                    <th>PAPs</th>
                    <th class="text-center">Fund Source</th>
                    <th class="text-center">MFOs</th>
                    <th class="text-center">PS</th>
                    <th class="text-center">MOOE</th>
                    <th class="text-center">CO</th>
                    <th class="text-center">Total</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($campusBudgetCeilings as $campusBudgetCeiling)
                        <tr>
                            <td class="fw-bold">{{ $campusBudgetCeiling->programActivityProject?->name }}</td>
                            <td class="text-center">{{ $campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation }}</td>
                            <td class="text-center">{{ $campusBudgetCeiling->programActivityProject?->majorFinalOutput?->abbreviation }}</td>
                            <td class="text-center">{{ '₱' . number_format($campusBudgetCeiling->ps, 2) }}</td>
                            <td class="text-center">{{ '₱' . number_format($campusBudgetCeiling->mooe, 2) }}</td>
                            <td class="text-center">{{ '₱' . number_format($campusBudgetCeiling->co, 2) }}</td>
                            <td class="text-center">{{ '₱' . number_format($campusBudgetCeiling->total_amount, 2) }}</td>
                            <td class="text-center">
                              <a href="{{ route('admin.unit-budget-ceiling.show', $campusBudgetCeiling->id) }}" class="btn btn-outline-success btn-sm rounded-circle shadow-sm manage-btn" data-bs-placement="top" title="Manage">
                                <i class="bi bi-gear"></i>
                              </a>
                            </td>
                        </tr>
                    @empty
                        
                    @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection

@push('page-scripts')
<script>
$(document).ready(function() {
  let table = $('#papsDataTable').DataTable({
    "dom": '<"top">rt<"bottom"p><"clear">'
  })

  // Custom search functionality
  $('#customSearch').on('keyup', function() {
      table.search(this.value).draw();  // Perform search and redraw the table
  });

  $('#fundSource').on('change', function() {
        let fundSource = $(this).val();

        // Filter the DataTable
        table.columns(1).search(fundSource ? '^' + fundSource + '$' : '', true, false).draw();
  });

  $('#mfo').on('change', function() {
        let mfo = $(this).val();

        // Filter the DataTable
        table.columns(2).search(mfo ? '^' + mfo + '$' : '', true, false).draw();
  });

  const budgetYearSelect = document.getElementById('budgetYear');
  budgetYearSelect.addEventListener('change', function() {
      const selectedBudgetYearId = this.value;

      // Ensure the user has selected a budget year
      if (selectedBudgetYearId) {
          const url = new URL(window.location.origin + '/admin/unit/budget-ceiling');
          url.searchParams.set('budget_year_id', selectedBudgetYearId);
          // Redirect to the route with the query string
          window.location.href = url.toString();
      }
  });
});

</script>
@endpush
