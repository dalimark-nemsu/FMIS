@extends('layouts.app')

@section('page-title', 'Budget Ceiling')
@prepend('page-style')
  <style>
    /* .card-title {
      margin: 0;
      padding: 0;
    } */
  </style>
@endprepend

@section('content')
@include('message.success')
@include('message.error')
<section class="section dashboard">
  <div class="row">
    <div class="col-3">
      <div class="card info-card sales-card">
        <div class="card-body">
          <h5 class="card-title mb-0">Details</h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-info"></i>
            </div>
            <div class="ps-3">
              <div class="mb-0">
                {{-- <span class="fs-5">PAPs:</span> --}}
                <span class="fs-5 fw-bold">{{ $campusBudgetCeiling->programActivityProject?->name }}</span>
              </div>
              <div class="mb-0">
                <span class="fs-6 text-secondary">MFOs:</span>
                <span class="fs-6 fw-bold text-secondary">{{ $campusBudgetCeiling->programActivityProject?->majorFinalOutput?->abbreviation }}</span>
              </div>
              <div class="mb-0">
                <span class="fs-6  text-secondary">Fund Source:</span>
                <span class="fs-6 fw-bold text-secondary">{{ $campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation }}</span>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="col-3">
      <div class="card info-card sales-card">
        <div class="card-body">
          <h5 class="card-title mb-0">Total</h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-wallet-fill"></i>
            </div>
            <div class="ps-3 ms-auto text-end">
              <div class="mb-0">
                <span class="fs-6 text-muted">PS<span class="fw-bold"> {{ '₱' . number_format($campusBudgetCeiling->ps,2) }}</span></span>
              </div>
              <div class="mb-0">
                <span class="fs-6 text-muted">MOOE<span class="fw-bold"> {{ '₱' . number_format($campusBudgetCeiling->mooe,2) }}</span></span>
              </div>
              <div class="mb-0">
                <span class="fs-6 text-muted">CO<span class="fw-bold"> {{ '₱' . number_format($campusBudgetCeiling->co,2) }}</span></span>
              </div>
              <div class="mb-0">
                <span class="fs-5 fw-bold">{{ '₱' . number_format($campusBudgetCeiling->total_amount,2) }}</span>
              </div>
              {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="col-3">
      <div class="card info-card revenue-card">
        <div class="card-body">
          <h5 class="card-title mb-0">Allocated <span></span></h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-currency-dollar"></i>
            </div>
            <div class="ps-3 ms-auto text-end">
              <div class="mb-0">
                <span class="fs-6 text-muted">PS<span class="fw-bold"> {{ '₱' . number_format($psAllocatedSum,2) }}</span></span>
              </div>
              <div class="mb-0">
                <span class="fs-6 text-muted">MOOE<span class="fw-bold"> {{ '₱' . number_format($mooeAllocatedSum,2) }}</span></span>
              </div>
              <div class="mb-0">
                <span class="fs-6 text-muted">CO<span class="fw-bold"> {{ '₱' . number_format($coAllocatedSum,2) }}</span></span>
              </div>
              <div class="mb-0">
                <span class="fs-5 fw-bold">{{ '₱' . number_format($totalAllocatedSum,2) }}</span>
              </div>
              {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

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
            <div class="ps-3 ms-auto text-end">
              <div class="mb-0">
                <span class="fs-6 text-muted">PS<span class="fw-bold"> {{ '₱' . number_format($psUnallocated,2) }}</span></span>
              </div>
              <div class="mb-0">
                <span class="fs-6 text-muted">MOOE<span class="fw-bold"> {{ '₱' . number_format($mooeUnallocated,2) }}</span></span>
              </div>
              <div class="mb-0">
                <span class="fs-6 text-muted">CO<span class="fw-bold"> {{ '₱' . number_format($coUnallocated,2) }}</span></span>
              </div>
              <div class="mb-0">
                <span class="fs-5 fw-bold">{{ '₱' . number_format($totalUnallocated,2) }}</span>
              </div>
              {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

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
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <button
                      type="button"
                      class="btn btn-primary"
                      data-bs-toggle="modal"
                      data-bs-target="#assignUnitBudgetCeilingModal"
                    >
                      <i class="bi bi-plus-circle"></i>
                    </button>
                    <div
                    class="modal fade"
                    id="assignUnitBudgetCeilingModal"
                    tabindex="-1"
                    data-bs-backdrop="static"
                    data-bs-keyboard="false"

                    role="dialog"
                    aria-labelledby="modalTitleId"
                    aria-hidden="true"
                  >
                    <div
                      class="modal-dialog modal-lg modal-dialog-scrollable"
                      role="document"
                    >
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalTitleId">
                            Assign Allocated Budget
                          </h5>
                          <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                          ></button>
                        </div>
                        <form action="{{ route('admin.unit-budget-ceiling.store',['pap_id' => $campusBudgetCeiling->pap_id, 'budget_year_id' => $campusBudgetCeiling->budget_year_id ]) }}" method="POST">
                          @csrf
                        <div class="modal-body">
                          <div class="row mb-3">
                            <div class="col">
                              <select name="units[]" id="unit" class="form-control" data-placeholder="Choose anything" multiple>
                                {{-- <option value="" selected>--Select Office--</option> --}}
                                @foreach ($units as $unit)
                                  <option value="{{ $unit->id }}" @if ($unit->hasUnitBudgetCeilingForYear('2024'))
                                    disabled
                                  @endif>{{ $unit->name }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-4">
                              <label for="" class="form-label">PS</label>
                              <div class="input-group">
                                <span class="input-group-text">&#8369;</span>
                                <input
                                  type="text"
                                  name="ps"
                                  id="ps"
                                  class="form-control"
                                  placeholder="0.00"
                                  aria-describedby="helpId"
                                />
                              </div>
                              {{-- <small id="helpId" class="text-muted">Help text</small> --}}
                            </div>
                            <div class="col-4">
                              <label for="" class="form-label">MOOE</label>
                              <div class="input-group">
                                <span class="input-group-text">&#8369;</span>
                                <input
                                  type="text"
                                  name="mooe"
                                  id="mooe"
                                  class="form-control"
                                  placeholder="0.00"
                                  aria-describedby="helpId"
                                />
                              </div>
                              {{-- <small id="helpId" class="text-muted">Help text</small> --}}
                            </div>
                            <div class="col-4">
                              <label for="" class="form-label">CO</label>
                              <div class="input-group">
                                <span class="input-group-text">&#8369;</span>
                                <input
                                  type="text"
                                  name="co"
                                  id="co"
                                  class="form-control"
                                  placeholder="0.00"
                                  aria-describedby="helpId"
                                />
                              </div>
                              {{-- <small id="helpId" class="text-muted">Help text</small> --}}
                            </div>
                          </div>
                          <div class="row">
                            <div class="text-end">
                              <label for="total" class="form-label fs-5 fw-bold">Total:</label>
                              <span id="total" class="fs-5 fw-bold total">₱0.00</span>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Save</button>
                          <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                          >
                            Close
                          </button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive table-card mt-4">
                      <table id="papsDataTable" class="table table-hover text-nowrap table-centered mt-0" style="width: 100%">
                        <thead class="table-primary">
                          <tr>
                            <th>Unit</th>
                            @if ($campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation === "GAA")
                              <th>PS</th>
                              <th>MOOE</th>
                              <th>CO</th>
                            @endif
                            <th>Total</th>
                            <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($unitBudgetCeilings as $unitBudgetCeiling)
                                <tr>
                                    <td class="fw-bold">{{ $unitBudgetCeiling->operatingUnit?->name }}</td>
                                    @if ($unitBudgetCeiling->programActivityProject?->fundSource?->abbreviation === "GAA")
                                      <td>{{ '₱' . number_format($unitBudgetCeiling->ps, 2) }}</td>
                                      <td>{{ '₱' . number_format($unitBudgetCeiling->mooe, 2) }}</td>
                                      <td>{{ '₱' . number_format($unitBudgetCeiling->co, 2) }}</td>
                                    @endif
                                    <td>{{ '₱' . number_format($unitBudgetCeiling->total_amount, 2) }}</td>
                                    <td class="text-center">
                                      <a href="#" class="btn btn-outline-primary btn-sm rounded-circle shadow-sm manage-btn" data-bs-placement="top" title="Manage">
                                        <i class="bi bi-pencil"></i>
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
  const psInput = document.querySelector('#ps');
  const mooeInput = document.querySelector('#mooe');
  const coInput = document.querySelector('#co');
  const totalSpan = document.querySelector('#total');

  // Helper function to format number to currency with commas and decimal places
  const formatCurrency = (value) => {
    return new Intl.NumberFormat('en-PH', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }).format(value);
  };

  // Function to parse input value and remove commas
  const parseInput = (input) => {
    return parseFloat(input.replace(/,/g, '').replace(/₱/g, '')) || 0;
  };

  // Function to handle input and format it on the fly while maintaining cursor position
  const formatOnInput = (input) => {
    const value = input.value;

    // Get cursor position
    const caretPosition = input.selectionStart;

    // Remove all commas and non-digit characters except the decimal point
    const cleanValue = value.replace(/[^\d.]/g, '');

    // Format the number as currency
    const formattedValue = formatCurrency(parseInput(cleanValue));

    // Set the formatted value back to the input field
    input.value = formattedValue;

    // Adjust the cursor position
    input.setSelectionRange(caretPosition, caretPosition);
  };

  // Function to calculate and update the total
  const calculateTotal = () => {
    const ps = parseInput(psInput.value);
    const mooe = parseInput(mooeInput.value);
    const co = parseInput(coInput.value);
    const total = ps + mooe + co;

    totalSpan.textContent = '₱' + formatCurrency(total);
  };

  // Add event listeners to format the inputs and calculate the total
  const inputs = [psInput, mooeInput, coInput];
  inputs.forEach(input => {
    input.addEventListener('input', () => {
      formatOnInput(input);  // Format the input as currency while typing
      calculateTotal();      // Update the total in real-time
    });
  });

  $(document).ready(function () {
    $('#unit').select2({
      theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
    closeOnSelect: false,
    });
  });
</script>
@endpush
