@extends('layouts.app')

@section('page-title-with-icon')
<a href="{{ route('admin.unit-budget-ceiling.index', ['campus_id' => $campusBudgetCeiling->campus_id]) }}" class="text-decoration-none" style="color: #012970;">
  <i class="bi bi-arrow-left"></i>
  {{ $campusBudgetCeiling->programActivityProject?->name }}
</a>
<div class="fs-6 mt-1">
    MFO: {{ $campusBudgetCeiling->programActivityProject?->majorFinalOutput?->abbreviation }} | Fund Source: {{ $campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation }}
</div>
@endsection

@section('page-title-text')
  {{ $campusBudgetCeiling->programActivityProject?->name }}
@endsection

@section('content')
@include('message.success')
@include('message.error')
<div class="pagetitle mb-4">
  <h1 class="fs-5 card-title p-0">Budget Year {{ $campusBudgetCeiling->budgetYear?->year }}</h1>
</div>
<section class="section dashboard">
  <div class="row">
    {{-- <div class="col-3">
      <div class="card info-card sales-card">
        <div class="card-body">
          <h5 class="card-title f-6 mb-0">Details</h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-info"></i>
            </div>
            <div class="ps-3">
              <div class="mb-0">
                <span class="fs-6 fw-bold">{{ $campusBudgetCeiling->programActivityProject?->name }}</span>
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
    </div> --}}
    <div class="col-12 co-md-4 col-lg-4">
      <div class="card info-card sales-card">
        <div class="card-body">
          <h5 class="card-title f-6 mb-0">Total Assigned Budget</h5>
    
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-wallet-fill"></i>
            </div>
            <div class="ps-3 ms-auto text-end">
              @if ($campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation === "GAA" || $campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation === "TES")
                <div class="mb-1">
                  <span class="fs-6 text-muted">PS<span> {{ '₱' . number_format($campusBudgetCeiling->ps,2) }}</span></span>
                </div>
                <div class="mb-1">
                  <span class="fs-6 text-muted">MOOE<span> {{ '₱' . number_format($campusBudgetCeiling->mooe,2) }}</span></span>
                </div>
                <div class="mb-2">
                  <span class="fs-6 text-muted">CO<span> {{ '₱' . number_format($campusBudgetCeiling->co,2) }}</span></span>
                </div>
              @endif
              <div class="mb-0">
                <span class="fs-5 fw-bolder">{{ '₱' . number_format($campusBudgetCeiling->total_amount,2) }}</span>
              </div>
              {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}
    
            </div>
          </div>
        </div>
    
      </div>
    </div>
    <div class="col-12 co-md-4 col-lg-4">
      <div class="card info-card revenue-card">
        <div class="card-body">
          <h5 class="card-title f-6 mb-0">Total Allocated Budget <span></span></h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-currency-dollar"></i>
            </div>
            <div class="ps-3 ms-auto text-end">
              @if ($campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation === "GAA" || $campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation === "TES")
                <div class="mb-1">
                  <span class="fs-6 text-muted">PS<span> {{ '₱' . number_format($budgetData['unitPSTotalAllocated'],2) }}</span></span>
                </div>
                <div class="mb-1">
                  <span class="fs-6 text-muted">MOOE<span> {{ '₱' . number_format($budgetData['unitMOOETotalAllocated'],2) }}</span></span>
                </div>
                <div class="mb-2">
                  <span class="fs-6 text-muted">CO<span> {{ '₱' . number_format($budgetData['unitCOTotalAllocated'],2) }}</span></span>
                </div>
              @endif
              <div class="mb-0">
                <span class="fs-5 fw-bold">{{ '₱' . number_format($budgetData['unitTotalAllocated'],2) }}</span>
              </div>
    
            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="col-12 co-md-4 col-lg-4">
      <div class="card info-card customers-card">

        <div class="card-body">
          <h5 class="card-title f-6 mb-0"> Total Unallocated Budget</h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-currency-dollar"></i> 
            </div>
            <div class="ps-3 ms-auto text-end">
              @if ($campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation === "GAA" || $campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation === "TES")
                <div class="mb-1">
                  <span class="fs-6 text-muted">PS<span> {{ '₱' . number_format($budgetData['unitPSTotalUnallocated'],2) }}</span></span>
                </div>
                <div class="mb-1">
                  <span class="fs-6 text-muted">MOOE<span> {{ '₱' . number_format($budgetData['unitMOOETotalUnallocated'],2) }}</span></span>
                </div>
                <div class="mb-2">
                  <span class="fs-6 text-muted">CO<span> {{ '₱' . number_format($budgetData['unitCOTotalUnallocated'],2) }}</span></span>
                </div>
              @endif
              <div class="mb-0">
                <span class="fs-5 fw-bold">{{ '₱' . number_format($budgetData['unitTotalUnallocated'],2) }}</span>
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
                <div class="card-header">
                  <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#assignUnitBudgetCeilingModal">
                    <i class="bi bi-plus-circle"></i> Assign Budget
                  </button>
                  <div class="modal fade add-modal text-dark" id="assignUnitBudgetCeilingModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                          Assign Budget to Unit
                        </h5>
                      </div>

                      <form action="{{ route('admin.unit-budget-ceiling.store',['campus_budget_ceiling' => $campusBudgetCeiling->id, 'pap_id' => $campusBudgetCeiling->pap_id, 'budget_year_id' => $campusBudgetCeiling->budget_year_id ]) }}" class="allocate-budget-form" method="POST">
                        @csrf
                        <div class="modal-body p-4">
                          <div class="row mb-3">
                            <label for="" class="col-sm-4 col-form-label">Units</label>
                            <div class="col-sm-8">
                              <select name="unit" id="unit" class="form-select border-dark text-dark" data-placeholder="Choose Unit">
                                <option value=""></option>
                                @foreach ($units as $unit)
                                  <option value="{{ $unit->id }}" @if(old('unit')) selected @endif>{{ $unit->name }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          @if ($campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation === "GAA" || $campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation === "TES")
                            <div class="row mb-3">
                              <label for="" class="col-sm-4 col-form-label">PS</label>
                              <div class="col-sm-8">
                                <div class="input-group">
                                  <span class="input-group-text">&#8369;</span>
                                  <input
                                    type="text"
                                    name="ps"
                                    id="ps"
                                    class="form-control money-input text-end"
                                    placeholder="0.00"
                                    aria-describedby="helpId"
                                    value="{{ old('ps') }}"
                                    {{-- @if ($campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation !== "GAA" && $campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation !== "TES") disabled @endif --}}
                                    
                                  />
                                </div>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="" class="col-sm-4 col-form-label">MOOE</label>
                              <div class="col-sm-8">
                                <div class="input-group">
                                  <span class="input-group-text">&#8369;</span>
                                  <input
                                    type="text"
                                    name="mooe"
                                    id="mooe"
                                    class="form-control money-input text-end"
                                    placeholder="0.00"
                                    aria-describedby="helpId"
                                    value="{{ old('mooe') }}"
                                    {{-- @if ($campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation !== "GAA" && $campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation !== "TES") disabled @endif --}}
                                  />
                                </div>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label for="" class="col-sm-4 col-form-label">CO</label>
                              <div class="col-sm-8">
                                <div class="input-group">
                                  <span class="input-group-text">&#8369;</span>
                                  <input
                                    type="text"
                                    name="co"
                                    id="co"
                                    class="form-control money-input text-end"
                                    placeholder="0.00"
                                    aria-describedby="helpId"
                                    value="{{ old('co') }}"
                                    {{-- @if ($campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation !== "GAA" && $campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation !== "TES") disabled @endif --}}
                                  />
                                </div>
                              </div>
                            </div>                           
                          @endif
                          <div class="row mb-3">
                            <label for="" class="col-sm-4 col-form-label">Total Amount</label>
                            <div class="col-sm-8">
                              <div class="input-group">
                                <span class="input-group-text">&#8369;</span>
                                <input
                                  type="text"
                                  name="total"
                                  id="total"
                                  class="form-control total-input text-end fw-bold"
                                  placeholder="0.00"
                                  aria-describedby="helpId"
                                  value="{{ old('total') }}"
                                  @if ($campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation === "GAA" || $campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation === "TES") readonly @endif
                                />
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Save</button>
                          <button
                            type="button"
                            class="btn btn-outline-secondary"
                            data-bs-dismiss="modal"
                          >
                            Cancel
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>   
                </div>                   
                <div class="card-body">                  
                  <div class="table-responsive table-card mt-4">
                    <table id="unitsDataTable" class="table table-hover text-nowrap mt-0" style="width: 100%">
                      <thead class="table-secondary">
                        <tr>
                          <th>Unit</th>
                          @if ($campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation === "GAA" || $campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation === "TES")
                            <th class="text-end" style="background-color: {{ $campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation === 'GAA' ? '#cfe2ff' : '' }};">PS</th>
                            <th class="text-end" style="background-color: {{ $campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation === 'GAA' ? '#cfe2ff' : '' }};">MOOE</th>
                            <th class="text-end" style="background-color: {{ $campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation === 'GAA' ? '#cfe2ff' : '' }};">CO</th>
                          @endif
                          <th class="text-end" style="background-color: #e0f8e9; {{ $campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation === 'GAA' ? '#e0f8e9' : '' }};">Amount</th>
                          <th class="text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($unitBudgetCeilings as $unitBudgetCeiling)
                              <tr>
                                  <td class="fw-bold">{{ $unitBudgetCeiling->operatingUnit?->name }}</td>
                                  @if ($campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation === "GAA" || $campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation === "TES")
                                    <td class="text-end @if($unitBudgetCeiling->ps == 0) text-danger @endif" style="background-color: #cfe2ff;">{{ '₱' . number_format($unitBudgetCeiling->ps, 2) }}</td>
                                    <td class="text-end @if($unitBudgetCeiling->mooe == 0) text-danger @endif" style="background-color: #cfe2ff;">{{ '₱' . number_format($unitBudgetCeiling->mooe, 2) }}</td>
                                    <td class="text-end @if($unitBudgetCeiling->co == 0) text-danger @endif" style="background-color: #cfe2ff;">{{ '₱' . number_format($unitBudgetCeiling->co, 2) }}</td>
                                   @endif
                                <td class="text-end fw-bold" style="background-color: #e0f8e9;">{{ '₱' . number_format($unitBudgetCeiling->total_amount, 2) }}</td>
                                  <td class="text-center">
                                    <a href="#" class="btn btn-outline-primary btn-sm rounded-circle shadow-sm manage-btn" data-bs-placement="top" title="Manage" data-bs-toggle="modal" data-bs-target="#editModal{{ $unitBudgetCeiling->id }}">
                                      <i class="bi bi-pencil"></i>
                                    </a>                                    
                                    <!-- Modal Body -->
                                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                    <div
                                      class="modal fade edit-modal text-start"
                                      id="editModal{{ $unitBudgetCeiling->id }}"
                                      tabindex="-1"
                                      data-bs-backdrop="static"
                                      data-bs-keyboard="false"
                                      
                                      role="dialog"
                                      aria-labelledby="modalTitleId{{ $unitBudgetCeiling->id }}"
                                      aria-hidden="true"
                                    >
                                      <div
                                        class="modal-dialog modal-dialog-scrollable"
                                        role="document"
                                      >
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="{{ $unitBudgetCeiling->id }}">
                                              Modify Budget Assignment
                                            </h5>
                                            <button
                                              type="button"
                                              class="btn-close"
                                              data-bs-dismiss="modal"
                                              aria-label="Close"
                                            ></button>
                                          </div>
                                          <form action="{{ route('admin.unit-budget-ceiling.update', $unitBudgetCeiling->id) }}" method="POST" class="edit-form">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body text-start p-4">
                                              <div class="row mb-3">
                                                <label for="editUnitInput{{ $unitBudgetCeiling->id }}" class="col-sm-4 col-form-label">Units</label>
                                                <div class="col-sm-8">
                                                  <select name="unit" id="editUnitInput{{ $unitBudgetCeiling->id }}" class="form-control unit-select border-dark text-dark" data-placeholder="Choose Unit">
                                                    <option value=""></option>
                                                    @foreach ($units as $unit)
                                                      <option value="{{ $unit->id }}" @if ($unitBudgetCeiling->operating_unit === $unit->id)
                                                        selected
                                                      @endif>{{ $unit->name }}</option>
                                                    @endforeach
                                                  </select>
                                                </div>
                                              </div>
                                              @if ($unitBudgetCeiling->campusBudgetCeiling?->programActivityProject?->fundSource?->abbreviation === "GAA" || $unitBudgetCeiling->campusBudgetCeiling?->programActivityProject?->fundSource?->abbreviation === "TES")
                                                <div class="row mb-3">
                                                  <label for="editPsInput{{ $unitBudgetCeiling->id }}" class="col-sm-4 col-form-label">PS</label>
                                                  <div class="col-sm-8">
                                                    <div class="input-group">
                                                      <span class="input-group-text">&#8369;</span>
                                                      <input
                                                        type="text"
                                                        name="ps"
                                                        id="editPsInput{{ $unitBudgetCeiling->id }}"
                                                        class="form-control money-input text-end"
                                                        placeholder="0.00"
                                                        aria-describedby="helpId"
                                                        {{-- @if ($campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation !== "GAA" && $campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation !== "TES") disabled @endif --}}
                                                        value="{{ number_format($unitBudgetCeiling->ps, 2) }}"
                                                      />
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="row mb-3">
                                                  <label for="editMooeInput{{ $unitBudgetCeiling->id }}" class="col-sm-4 col-form-label">MOOE</label>
                                                  <div class="col-sm-8">
                                                    <div class="input-group">
                                                      <span class="input-group-text">&#8369;</span>
                                                      <input
                                                        type="text"
                                                        name="mooe"
                                                        id="editMooeInput{{ $unitBudgetCeiling->id }}"
                                                        class="form-control money-input text-end"
                                                        placeholder="0.00"
                                                        aria-describedby="helpId"
                                                        {{-- @if ($campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation !== "GAA" && $campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation !== "TES") disabled @endif --}}
                                                        value="{{ number_format($unitBudgetCeiling->mooe, 2) }}"
                                                      />
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="row mb-3">
                                                  <label for="editCoInput{{ $unitBudgetCeiling->id }}" class="col-sm-4 col-form-label">CO</label>
                                                  <div class="col-sm-8">
                                                    <div class="input-group">
                                                      <span class="input-group-text">&#8369;</span>
                                                      <input
                                                        type="text"
                                                        name="co"
                                                        id="editCoInput{{ $unitBudgetCeiling->id }}"
                                                        class="form-control money-input text-end"
                                                        placeholder="0.00"
                                                        aria-describedby="helpId"
                                                        {{-- @if ($campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation !== "GAA" && $campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation !== "TES") disabled @endif\ --}}
                                                        value="{{ number_format($unitBudgetCeiling->co, 2) }}"
                                                      />
                                                    </div>
                                                  </div>
                                                </div>
                                              @endif
                                              <div class="row mb-3">
                                                <label for="editTotalInput{{ $unitBudgetCeiling->id }}" class="col-sm-4 col-form-label">Total Amount</label>
                                                <div class="col-sm-8">
                                                  <div class="input-group">
                                                    <span class="input-group-text">&#8369;</span>
                                                    <input
                                                      type="text"
                                                      name="total"
                                                      id="editTotalInput{{ $unitBudgetCeiling->id }}"
                                                      class="form-control total-input text-end fw-bold"
                                                      placeholder="0.00"
                                                      aria-describedby="helpId"
                                                        @if ($campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation === "GAA" || $campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation === "TES") readonly @endif
                                                        value="{{ number_format($unitBudgetCeiling->total_amount, 2) }}"
                                                    />
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="submit" class="btn btn-primary">Update</button>
                                              <button
                                              type="button"
                                              class="btn btn-outline-secondary"
                                              data-bs-dismiss="modal"
                                            >
                                              Cancel
                                            </button>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>                                    
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <td class="text-end fw-bold">Total</td>
                          @if ($campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation === "GAA" || $campusBudgetCeiling->programActivityProject?->fundSource?->abbreviation === "TES")
                            <td class="text-end fw-bold">{{ '₱' . number_format($unitBudgetCeilings->sum('ps'), 2) }}</td>
                            <td class="text-end fw-bold">{{ '₱' . number_format($unitBudgetCeilings->sum('mooe'), 2) }}</td>
                            <td class="text-end fw-bold">{{ '₱' . number_format($unitBudgetCeilings->sum('co'), 2) }}</td>
                          @endif
                          <td class="text-end fw-bold">{{ '₱' . number_format($unitBudgetCeilings->sum('total_amount'), 2) }}</td>
                          <td></td>
                        </tr>
                      </tfoot>
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
  const calculateTotal = (modal) => {
    let total = 0;
    // Find all .money-input fields within the current modal
    const moneyInputs = $(modal).find('.money-input');
    // Iterate over each input, parse and sum the values
    moneyInputs.each(function () {
      total += parseInput($(this).val());
    });
    $(modal).find('.total-input').val(formatCurrency(total));
  };
  
  $(document).ready(function () {
    $('#unit').select2({
      theme: "bootstrap-5",
      width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
      placeholder: $( this ).data( 'placeholder' ),
      closeOnSelect: false,
      allowClear: true
    });

    $('.add-modal').on('show.bs.modal', function () {
      const moneyInputs = $(this).find('.money-input');
      const totalInput = $(this).find('.total-input');
      if (moneyInputs.length > 0) {
        moneyInputs.each(function () {
          $(this).on('input', () => {
            formatOnInput(this);  // Format the input as currency while typing
            calculateTotal($(this).closest('.add-modal')); // Update the total in real-time
          });
        });
      }
      if (totalInput.length > 0) {
        totalInput.eq(0).on('input', (event) => {
          formatOnInput(event.target); // Pass the event target
        });
      }
    });

    $('.edit-modal').on('show.bs.modal', function () {
      const currentModal = $(this);
      const unitSelect = $(this).find('.unit-select');
      const moneyInputs = $(this).find('.money-input');
      const totalInput = $(this).find('.total-input');
      $(unitSelect).select2({
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
        closeOnSelect: false,
        allowClear: true,
        dropdownParent: $(currentModal),
      });

      if (moneyInputs.length > 0) {
        moneyInputs.each(function () {
          $(this).on('input', () => {
            formatOnInput(this);  // Format the input as currency while typing
            calculateTotal($(this).closest('.edit-modal')); // Update the total in real-time
          });
        });
      }

      if (totalInput.length > 0) {
        totalInput.eq(0).on('input', (event) => {
          formatOnInput(event.target); // Pass the event target
        });
      }
    });

    $('.edit-modal').on('hidden.bs.modal', function () {
      const modalForm = $(this).find('.edit-form');
      modalForm[0].reset(); // Reset the form
    });

    $('#assignUnitBudgetCeilingModal').on('hidden.bs.modal', function () {
        const modalForm = $(this).find('.allocate-budget-form');
        modalForm.find('select, input').each(function() {
            $(this).val(''); // Set value to empty string
        });
    });

    $("#unitsDataTable").DataTable();
  });
</script>
@endpush
