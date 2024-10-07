@extends('layouts.app')

@section('page-title', 'Budget Ceiling')

@section('content')
<div id="app-content">
    <!-- Container fluid -->
    <div class="app-content-area">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="my-3 mt-4">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <!-- Cards on the Left in a single line -->
                        <div class="d-flex flex-wrap">
                            <!-- Grand Total Card -->
                            <div class="card shadow border-0 rounded-3 me-4" style="min-width: 200px; max-width: 100%;">
                                <div class="card-body d-flex justify-content-start align-items-center p-3 bg-light rounded-3">
                                    <div class="icon-container me-3" style="width: 50px; height: 50px; background-color: #e9ecef; border-radius: 50%; display: flex; justify-content: center; align-items: center;">
                                        <i class="bi bi-cash-stack fs-4 text-primary"></i>
                                    </div>
                                    <div class="text-start">
                                        <h5 class="text-muted mb-0">Grand Total</h5>
                                        <p class="fs-5 fw-bold text-dark mb-0 mt-1">&#8369 {{ number_format($campusBudgetCeilings->sum('total_amount'), 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>

            @include('message.success')
            @include('message.error')

            <!-- row -->
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header d-md-flex border-bottom-0">
                    <div class="flex-grow-1">
                    </div>
                        <div class="mt-3 mt-md-0">
                            {{-- <a href="#addBudgetYearModal"
                                class="btn btn-outline-primary shadow-sm btn-sm"
                                data-bs-toggle="modal"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Create New Budget Year">
                                <i class="bi bi-plus-lg"></i>
                            </a> --}}
                        </div>
                  </div>
                  <div class="card-body">
                    <div class="row mt-2 mb-2">
                      <div class="col-auto d-flex align-items-center">
                          <select name="" id="" class="form-select me-2 border-secondary">
                            <option value="" selected>Budget Year</option>
                            @foreach ($budgetYears as $budgetYear)
                              <option value="{{ $budgetYear->id }}" @if($budgetYear->id === $activeYear->id) selected @endif>{{ $budgetYear->year }}</option>
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
   });

</script>
@endpush
