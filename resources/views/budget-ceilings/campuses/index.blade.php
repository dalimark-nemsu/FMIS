@extends('layouts.app')

@section('page-title', 'Budget Ceiling')

@section('content')
<div id="app-content">
    <!-- Container fluid -->
    <div class="app-content-area">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
            </div>
          </div>
          <div>

            @include('message.success')
            @include('message.error')

            <!-- row -->
            <div class="row">
              <div class="col-12">
                <div class="card">
                    <div class="card-header d-md-flex border-bottom-0">
                        <div class="flex-grow-1"></div>
                        <div class="mb-3 d-flex align-items-center">
                            <label for="budgetYear" class="col-form-label me-2 text-nowrap">Budget Year:</label>
                            {{-- <select class="form-select" name="year" id="year">
                                <option value="" disabled> -- Select Year -- </option>
                                @foreach ($budgetYears as $budgetYear)
                                    <option value="{{ $budgetYear->id }}"
                                        data-active="{{ $budgetYear->is_active }}"
                                        {{ $budgetYear->id == $activeYear->year ? 'selected' : '' }}>
                                        {{ $budgetYear->year }} {{ $budgetYear->is_active ? '(Active)' : '' }}
                                    </option>
                                @endforeach
                            </select> --}}
                            <select class="form-select" name="year" id="year">
                                <option value="" disabled> -- Select Year -- </option>
                                @foreach ($budgetYears as $budgetYear)
                                    <option value="{{ $budgetYear->id }}"
                                        data-active="{{ $budgetYear->is_active }}"
                                        {{ isset($selectedYear) && $budgetYear->id == $selectedYear->id ? 'selected' : '' }}>
                                        {{ $budgetYear->year }} {{ $budgetYear->is_active ? '(Active)' : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                  <div class="card-body">
                    <div class="table-responsive table-card">
                      <table id="example" class="table text-nowrap table-centered mt-0" style="width: 100%">
                        <thead class="table-light">
                          <tr>
                            <th>No.</th>
                            <th>Campus</th>
                            <th>Amount</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($campuses as $campus)
                            @php
                                $totalAmount = $campus->campusBudgetCeilings->where('budget_year_id', $selectedYear->id)->sum('total_amount');
                            @endphp
                                <tr data-campus-id="{{ $campus->id }}" data-year-active="{{ $budgetYears->firstWhere('id', $campus->budget_year_id)->is_active ?? 0 }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $campus->name }}</td>
                                    <td>&#8369 {{ number_format($totalAmount, 2) }}</td>
                                    <td>
                                        <!-- Manage Button -->
                                        {{-- {{ $selectedYear->id }} --}}
                                        <a href="{{ route('show-campus', ['id' => $campus->id, 'budgetYearId' => $selectedYear->id]) }}"
                                            class="btn btn-outline-success btn-sm rounded-circle shadow-sm manage-btn d-none"
                                            data-bs-placement="top"
                                            title="Manage">
                                             <i class="bi bi-gear"></i>
                                         </a>

                                        <!-- Show Button -->
                                        <a href="#"
                                        class="btn btn-outline-primary btn-sm rounded-circle shadow-sm show-btn d-none"
                                        data-bs-toggle="modal"
                                        data-bs-placement="top"
                                        title="Show">
                                        <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
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
</div>
@endsection

@push('page-scripts')
    <script>
        $(document).ready(function() {
            var $yearSelect = $('#year');

            function updateButtons() {
                var $selectedOption = $yearSelect.find('option:selected');
                var isActive = $selectedOption.data('active') === 1;

                // Update button visibility based on the selected year's active status
                $('tbody tr').each(function() {
                    var $row = $(this);
                    var $manageBtn = $row.find('.manage-btn');
                    var $showBtn = $row.find('.show-btn');

                    if (isActive) {
                        $manageBtn.removeClass('d-none');
                        $showBtn.addClass('d-none');
                    } else {
                        $manageBtn.addClass('d-none');
                        $showBtn.removeClass('d-none');
                    }
                });
            }

            // Initialize buttons on page load
            updateButtons();

            // Update buttons when the selection changes
            // $yearSelect.on('change', updateButtons);

            // Update buttons and trigger route change when the selection changes
            $yearSelect.on('change', function() {
                var selectedYearId = $(this).val(); // Get the selected year ID
                console.log(selectedYearId);
                if (selectedYearId) {
                    // Redirect to the desired route with the selected year as a parameter
                    window.location.href = "{{ route('budget-ceiling.by-year') }}?year=" + selectedYearId;
                }
            });
        });
    </script>
@endpush
