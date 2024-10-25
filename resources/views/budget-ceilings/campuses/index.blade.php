@extends('layouts.app')

@section('page-title', 'Budget Ceiling')

@push('page-style')
    <style>
        /* Apply hover effect on entire rows */
        table tbody tr:hover {
            font-size: 1.1em;   /* Slightly increase font size for the whole row */
            font-weight: bold;  /* Make all text in the row bold */
            transition: all 0.2s ease-in-out; /* Smooth transition effect */
        }
        /* Resize buttons when the row is hovered */
        table tbody tr:hover .btn {
            transform: scale(1.1);  /* Increase the button size by 10% */
            transition: transform 0.2s ease-in-out; /* Smooth transition effect for the button */
        }
    </style>
@endpush

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
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table id="example" class="table table-striped table-hover table-centered align-middle mb-0" style="width: 100%">
                                    <thead style="background-color: #36454F; color: white;">
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th>Campus</th>
                                            <th class="text-end">Amount</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($campuses as $campus)
                                        @php
                                            $totalAmount = $campus->campusBudgetCeilings->where('budget_year_id', $selectedYear->id)->sum('total_amount');
                                        @endphp
                                        <tr data-campus-id="{{ $campus->id }}" data-year-active="{{ $budgetYears->firstWhere('id', $campus->budget_year_id)->is_active ?? 0 }}">
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $campus->name }}</td>
                                            <td class="text-end">&#8369 {{ number_format($totalAmount, 2) }}</td>
                                            <td class="text-center">
                                                <!-- Manage Button -->
                                                <a href="{{ route('show-campus', ['id' => $campus->id, 'budgetYearId' => $selectedYear->id]) }}"
                                                   class="btn btn-outline-success btn-sm rounded-circle shadow-sm manage-btn d-none"
                                                   data-bs-toggle="tooltip" data-bs-placement="top" title="Manage">
                                                    <i class="bi bi-gear"></i>
                                                </a>

                                                <!-- Show Button -->
                                                <a href="{{ route('show-campus', ['id' => $campus->id, 'budgetYearId' => $selectedYear->id]) }}"
                                                   class="btn btn-outline-primary btn-sm rounded-circle shadow-sm show-btn d-none"
                                                   data-bs-toggle="tooltip" data-bs-placement="top" title="Show">
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
