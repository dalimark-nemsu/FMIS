@extends('layouts.app')

{{-- @section('page-title', 'Campus Budget Ceiling') --}}
@section('page-title-with-icon')
<a href="{{ route('budget-ceilings.index') }}" class="text-decoration-none" style="color: #012970;">
  <i class="bi bi-arrow-left"></i>
  Campus Budget Ceiling
</a>
@endsection

@section('page-title-text')
    Campus Budget Ceiling
@endsection

@push('page-style')
    <style>
        /* Toggle switch alignment */
        .form-check-input {
            cursor: pointer;
        }

        /* Card enhancements */
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }

        /* Table styles */
        table {
            font-size: 0.9rem;
            color: #333;
        }

        table thead th {
            font-weight: bold;
            background-color: #f8f9fa;
        }

        /* Hover effect on table rows */
        .hoverable-row:hover {
            background-color: #f1f5f9;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        /* Button styles */
        .btn {
            transition: transform 0.2s ease-in-out;
        }

        .btn:hover {
            transform: scale(1.1); /* Slightly enlarge buttons on hover */
        }

        /* Tooltip styling */
        [data-bs-toggle="tooltip"] {
            cursor: pointer;
        }

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

            <!-- Display Success and Error Messages -->
            @include('message.success')
            @include('message.error')

            <!-- Header Row with Cards and Post Toggle -->
            <div class="row">
                <div class="col-12">
                    <div class="my-3 mt-4">
                        <div class="d-flex justify-content-between align-items-start flex-wrap">
                            <!-- Main Cards Section -->
                            <div class="d-flex flex-wrap">
                                <!-- Campus Card -->
                                <div class="card shadow-lg border-0 rounded-4 me-4 mb-3" style="min-width: 220px; transition: transform 0.3s;">
                                    <div class="card-body d-flex align-items-center p-4 rounded-4 position-relative"
                                         style="background: linear-gradient(135deg, #e0f7fa 0%, #ffffff 100%);">
                                        <div class="icon-container me-3 d-flex justify-content-center align-items-center rounded-circle"
                                             style="width: 60px; height: 60px; background-color: #009688; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                                            <i class="bi bi-building fs-3" style="color: white;"></i>
                                        </div>
                                        <div class="text-start">
                                            <h5 class="text-muted mb-1" style="letter-spacing: 1px; font-weight: 500;">Campus</h5>
                                            <p class="fs-5 fw-bold text-dark mb-0" style="font-size: 1.25rem;">{{ $campus->name }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Budget Year Card -->
                                <div class="card shadow-lg border-0 rounded-4 me-4 mb-3" style="min-width: 220px; transition: transform 0.3s;">
                                    <div class="card-body d-flex align-items-center p-4 rounded-4 position-relative"
                                         style="background: linear-gradient(135deg, #fce4ec 0%, #ffffff 100%);">
                                        <div class="icon-container me-3 d-flex justify-content-center align-items-center rounded-circle"
                                             style="width: 60px; height: 60px; background-color: #e91e63; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                                            <i class="bi bi-calendar-event fs-3" style="color: white;"></i>
                                        </div>
                                        <div class="text-start">
                                            <h5 class="text-muted mb-1" style="letter-spacing: 1px; font-weight: 500;">Budget Year</h5>
                                            <p class="fs-5 fw-bold text-dark mb-0" style="font-size: 1.25rem;">{{ $activeYear->year }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Grand Total Card -->
                                <div class="card shadow-lg border-0 rounded-4 me-4 mb-3" style="min-width: 220px; transition: transform 0.3s;">
                                    <div class="card-body d-flex align-items-center p-4 rounded-4 position-relative"
                                         style="background: linear-gradient(135deg, #e8f5e9 0%, #ffffff 100%);">
                                        <div class="icon-container me-3 d-flex justify-content-center align-items-center rounded-circle"
                                             style="width: 60px; height: 60px; background-color: #4caf50; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                                            <i class="bi bi-cash-stack fs-3" style="color: white;"></i>
                                        </div>
                                        <div class="text-start">
                                            <h5 class="text-muted mb-1" style="letter-spacing: 1px; font-weight: 500;">Grand Total</h5>
                                            <p class="fs-5 fw-bold text-dark mb-0" style="font-size: 1.25rem;">&#8369 {{ number_format($grandTotal, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bottom Section with Toggle, Units, and Add Button Cards -->
                            <div class="d-flex justify-content-start align-items-start w-100 mt-3">
                                <!-- Add Button Card -->
                                @if($activeYear && $activeYear->id == $budgetYearId)
                                    <!-- Toggle Card -->
                                    <div class="card border-0 rounded-4 me-3"
                                        style="min-width: 170px; height: 80px; background: linear-gradient(135deg, #f0f4f7 0%, #ffffff 100%);
                                            border: 1px solid #e0e0e0; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1), 0px 8px 20px rgba(0, 0, 0, 0.15); transition: box-shadow 0.3s, transform 0.3s;">
                                        <div class="d-flex align-items-center justify-content-between p-3" style="height: 100%;">
                                            <div class="d-flex align-items-center">
                                                <i class="{{ $allBudgetsPosted ? 'bi bi-check2-square' : 'bi bi-pencil-square' }} me-2"
                                                    style="font-size: 1.3rem; color: {{ $allBudgetsPosted ? '#018d3b' : '#d9534f' }};"></i>
                                                <span id="postStatusLabel" class="fw-bold"
                                                        style="font-size: 1rem; color: {{ $allBudgetsPosted ? '#018d3b' : '#d9534f' }};">
                                                    {{ $allBudgetsPosted ? 'POSTED' : 'DRAFT' }}
                                                </span>
                                            </div>
                                            <!-- Toggle Switch -->
                                            <div class="form-check form-switch ms-auto">
                                                <input class="form-check-input" type="checkbox" id="postSwitch" {{ $allBudgetsPosted ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Units Card -->
                                    <a href="{{ route('admin.unit-budget-ceiling.index', ['campus_id' => $campus->id, 'active_year_id' => $activeYear->id]) }}"
                                        class="text-decoration-none me-3">
                                        <div class="card border-0 rounded-4 d-flex align-items-center justify-content-center"
                                            style="min-width: 140px; height: 80px; background: linear-gradient(135deg, #fff3e0 0%, #ffffff 100%);
                                                    border: 1px solid #e0e0e0; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1), 0px 8px 20px rgba(0, 0, 0, 0.15); transition: box-shadow 0.3s, transform 0.3s;">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-diagram-3 me-2" style="font-size: 1.3rem; color: #ff9800;"></i>
                                                <span class="fw-bold" style="font-size: 1rem; color: #9e6002;">UNITS</span>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="#addBudgetCeilingModal" class="text-decoration-none" data-bs-toggle="modal" title="Create New Budget Ceiling">
                                        <div class="card border-0 rounded-4 d-flex flex-column align-items-center justify-content-center"
                                            style="min-width: 120px; height: 80px; background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
                                                    border: 1px solid #e0e0e0; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1), 0px 8px 20px rgba(0, 0, 0, 0.15);
                                                    transition: box-shadow 0.3s, transform 0.3s;">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-plus-lg me-2" style="font-size: 1.3rem; color: #007bff;"></i>
                                                <span class="fw-bold" style="font-size: 1rem; color: #333;">New</span>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                                @include('budget-ceilings.modals.add-budget-ceiling', ['campus' => $campus, 'activeYear' => $activeYear, 'fundSources' => $fundSources, 'mfos' => $mfos, 'paps' => $paps])
                            </div>
                        </div>

                        <!-- Budget Ceilings Table for Each Fund Source -->
                        @if($groupedBudgetCeilings->isNotEmpty())
                            @foreach ($groupedBudgetCeilings as $fundSource => $budgetCeilings)
                                <div class="card shadow-lg mt-4 border-0 rounded-4">
                                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 px-4">
                                        <h4 class="mb-0" style="font-weight: 600; color: #36454F;">{{ $fundSource }}</h4>
                                        <div class="text-end">
                                            <strong class="text-muted">Subtotal: </strong>
                                            <span class="fs-4 fw-bold text-dark">&#8369 {{ number_format($budgetCeilings->sum('total_amount'), 2) }}</span>
                                        </div>
                                    </div>

                                    <div class="table-responsive p-4">
                                        <table id="example" class="table text-nowrap table-centered mt-0" style="width: 100%;">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>PAPs</th>
                                                    <th>Fund Source</th>
                                                    <th>MFOs</th>
                                                    <th style="background-color: #cfe2ff; color: #1565c0;">PS</th>
                                                    <th style="background-color: #cfe2ff; color: #1565c0;">MOOE</th>
                                                    <th style="background-color: #cfe2ff; color: #1565c0;">CO</th>
                                                    <th style="background-color: #e0f8e9; color: #018d3b; font-weight: bold;">Total</th>
                                                    @if($activeYear && $activeYear->id == $budgetYearId)
                                                        <th>Action</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($budgetCeilings as $budgetCeiling)
                                                    <tr class="hoverable-row">
                                                        <td>{{ $budgetCeiling->programActivityProject?->name }}</td>
                                                        <td>{{ $budgetCeiling->programActivityProject->fundSource?->abbreviation }}</td>
                                                        <td>{{ $budgetCeiling->programActivityProject->majorFinalOutput?->abbreviation }}</td>
                                                        <td style="background-color: #cfe2ff; color: #1565c0;">
                                                            &#8369 {{ number_format($budgetCeiling->ps, 2) }}
                                                        </td>
                                                        <td style="background-color: #cfe2ff; color: #1565c0;">
                                                            &#8369 {{ number_format($budgetCeiling->mooe, 2) }}
                                                        </td>
                                                        <td style="background-color: #cfe2ff; color: #1565c0;">
                                                            &#8369 {{ number_format($budgetCeiling->co, 2) }}
                                                        </td>
                                                        <td style="background-color: #e0f8e9; color: #018d3b; font-weight: bold;">
                                                            &#8369 {{ number_format($budgetCeiling->total_amount, 2) }}
                                                        </td>
                                                        @if($activeYear && $activeYear->id == $budgetYearId)
                                                            <td>
                                                                <a href="#editBudgetCeilingModal-{{$budgetCeiling->id}}"
                                                                   class="btn btn-outline-primary btn-sm rounded-circle shadow-sm me-2"
                                                                   data-bs-toggle="modal" title="Edit">
                                                                    <i class="bi bi-pencil"></i>
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-outline-danger btn-sm rounded-circle shadow-sm"
                                                                   data-url="{{ route('budget-ceilings.delete', $budgetCeiling->id) }}"
                                                                   onclick="confirmDelete(this, '{{ $budgetCeiling->programActivityProject?->name }}')"
                                                                   title="Delete">
                                                                    <i class="bi bi-trash"></i>
                                                                </a>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                    @include('budget-ceilings.modals.edit-budget-ceiling', ['budgetCeiling' => $budgetCeiling])
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Fund Source Modal -->
{{-- @foreach ($fundSources as $fundSource)
<div class="modal fade" id="deleteFundSourceModal-{{$fundSource->id}}" tabindex="-1"
    aria-labelledby="deleteFundSourceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteFundSourceModalLabel">Delete Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('fund-sources.delete', $fundSource->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    Are you sure to delete Fund Source: <strong>{{ $fundSource->abbreviation }}</strong> ?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach --}}

@endsection

@push('page-scripts')
    <script>
        $(document).ready(function() {
            // Attach click event to the switch button
            $('#postSwitch').on('click', function(event) {
                var budgetYear = @json($activeYear->year); // Assuming $activeYear is passed to the view
                var campusId = @json($campus->id); // Assuming $campus is also passed to the view
                var budgetYearId = @json($budgetYearId);
                event.preventDefault(); // Prevent immediate toggle action

                // Determine if the switch is checked or unchecked
                var isPosted = $(this).is(':checked') ? 1 : 0;

                // Show SweetAlert confirmation dialog with dynamic message
                Swal.fire({
                    html: `<div style="font-size: 18px;">Are you sure you want to ${isPosted ? 'post' : 'unpost'} this budget ceiling for budget year ${budgetYear}?</div>`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        confirmButton: 'btn btn-primary btn-sm mx-2',
                        cancelButton: 'btn btn-secondary btn-sm mx-2'
                    },
                    buttonsStyling: false,
                    background: '#f5f5f5',
                    padding: '20px',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Make an AJAX request to update the is_posted status in the controller
                        $.ajax({
                            url: '{{ route('post-budget-ceiling') }}', // Route to your controller
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}', // Laravel CSRF token for security
                                campus_id: campusId,
                                budget_year_id: budgetYearId,
                                is_posted: isPosted // Set is_posted to 1 or 0 based on toggle state
                            },
                            success: function(response) {
                                Swal.fire(
                                    isPosted ? 'Posted!' : 'Unposted!',
                                    `Your budget ceiling has been ${isPosted ? 'posted' : 'unposted'}.`,
                                    'success'
                                ).then(() => {
                                    // Reload the page after the SweetAlert confirmation
                                    location.reload();
                                });
                            },
                            error: function() {
                                Swal.fire(
                                    'Error!',
                                    `There was an issue ${isPosted ? 'posting' : 'unposting'} the budget ceiling. Please try again later.`,
                                    'error'
                                );
                                $('#postSwitch').prop('checked', !isPosted); // Revert switch if there's an error
                            }
                        });
                    } else {
                        // If canceled, revert the switch to its original state
                        $('#postSwitch').prop('checked', !isPosted);
                    }
                });
            });

            initializeSelect2('#pap', '#addBudgetCeilingModal');

            // Bind change events for Add Modal fields
            $('.add-fund-source, .add-mfo').on('change', function() {
                refreshPAPDropdown();
            });

            $('.add-fund-source').on('change', function() {
                const abbreviation = getSelectedAbbreviation($(this));
                toggleBudgetFields(abbreviation);
            });

            $('#pap').on('change', handlePAPSelection);

            // Bind listeners after modal opens to ensure they are attached properly
            $(document).on('shown.bs.modal', '#addBudgetCeilingModal', function() {
                setupInputListeners($(this));
            });

            $(document).on('shown.bs.modal', '.edit-budget-ceiling-modal', function() {
                const editModal = $(this);
                initializeSelect2('.edit-pap', editModal);
                setupInputListeners(editModal);
                editModal.find('.edit-fund-source').on('change', function() {
                    toggleBudgetFields(getSelectedAbbreviation($(this)), editModal);
                }).trigger('change');
            });
        });

        // =================== Helper Functions ===================

        function refreshPAPDropdown() {
            const fundSourceId = $('.add-fund-source').val();
            const mfoId = $('.add-mfo').val();
            if (!fundSourceId && !mfoId) return;

            const url = `/admin/get-paps?${fundSourceId ? 'fundSourceId=' + fundSourceId : ''}${mfoId ? '&mfoId=' + mfoId : ''}`;
            updatePAPDropdown(url, '#pap', '#addBudgetCeilingModal');
        }

        function updatePAPDropdown(url, selector, modalSelector) {
            const $papDropdown = $(selector).empty().append('<option value=""> -- Select Program, Activity, Projects -- </option>');
            $.get(url, function(data) {
                if (data.length) {
                    data.forEach(pap => $papDropdown.append(`<option value="${pap.id}">${pap.name}</option>`));
                    initializeSelect2($papDropdown, modalSelector);
                } else {
                    $papDropdown.append('<option value="">No PAPs found</option>');
                }
            });
        }

        function handlePAPSelection() {
            const papId = $(this).val();
            if (!papId) return;

            $.get(`/admin/get-fundsource-and-mfo-by-paps/${papId}`, function(data) {
                if (data.status === 'success') {
                    $('#fund_source').val(data.fund_source_id);
                    $('#mfo').val(data.mfo_id);
                    toggleBudgetFields(getSelectedAbbreviation($('#fund_source')));
                } else {
                    alert(data.message);
                }
            });
        }

        function toggleBudgetFields(abbreviation, modalContext = $(document)) {
            const isGAAorTES = abbreviation === 'GAA' || abbreviation === 'TES';
            modalContext.find('.ps, .mooe, .co').prop('disabled', !isGAAorTES).val(isGAAorTES ? undefined : '');
            modalContext.find('.total').prop('disabled', isGAAorTES);
        }

        function initializeSelect2(selector, parentModal) {
            $(selector).select2({
                dropdownParent: $(parentModal),
                theme: "bootstrap-5",
                width: '100%',
            });
        }

        function getSelectedAbbreviation(element) {
            return element.find(':selected').data('abbreviation');
        }

        // Setup input listeners for PS, MOOE, CO, and Total fields
        function setupInputListeners(modal) {
            modal.find('.ps, .mooe, .co').on('input', function() {
                formatInput($(this));
                updateTotal(modal, ['.ps', '.mooe', '.co'], '.total');
            });

            // Use blur event for total to ensure formatting after focus is lost
            modal.find('.total').on('blur', function() {
                formatInput($(this));
            });
        }

        // Format input with commas as user types
        function formatInput(input) {
            let value = input.val().replace(/,/g, '');  // Remove existing commas
            // console.log("Formatting value: ", value);  // Debug: Check value before formatting
            if (!isNaN(value) && value !== '') {
                // Convert to a number and format with commas and two decimal places
                value = parseFloat(value).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            } else {
                value = '';
            }
            // console.log("Formatted value: ", value);  // Debug: Check value after formatting
            input.val(value);  // Update the input field value
        }

        function updateTotal(modal, fieldSelectors, totalSelector) {
            let total = 0;
            fieldSelectors.forEach(selector => {
                const value = modal.find(selector).val().replace(/,/g, '');
                total += parseFloat(value) || 0;
            });
            modal.find(totalSelector).val(total.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        }

        function confirmDelete(element, papName) {
            const deleteUrl = $(element).data('url');
            Swal.fire({
                html: `<div style="font-size: 18px;">Are you sure you want to delete budget ceiling for ${papName}?</div>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
                customClass: { confirmButton: 'btn btn-danger btn-sm mx-2', cancelButton: 'btn btn-secondary btn-sm mx-2' },
                buttonsStyling: false,
                background: '#f5f5f5',
                padding: '20px',
                iconColor: '#d9534f',
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: deleteUrl,
                        method: 'DELETE',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function() {
                            Swal.fire('Deleted!', `The budget ceiling for "${papName}" has been deleted successfully.`, 'success');
                            location.reload();
                        },
                        error: function() {
                            Swal.fire('Error!', 'There was an issue deleting the record. Please try again later.', 'error');
                        }
                    });
                }
            });
        }
    </script>

    {{-- <script>
        $(document).ready(function() {
            $('.add-fund-source').on('change', function() {
                // Get the selected option's data-abbreviation value
                var abbreviation = $(this).find(':selected').data('abbreviation');
                console.log(abbreviation);
                // Check if the abbreviation is 'GAA'
                if (abbreviation === 'GAA' || abbreviation === 'TES') {
                    // Enable the PS, MOOE, and CO input fields
                    $('.ps, .mooe, .co').prop('disabled', false);
                    $('.total').prop('disabled', true);
                } else {
                    // Disable the PS, MOOE, and CO input fields if not 'GAA'
                    $('.ps, .mooe, .co').prop('disabled', true).val('');
                    $('.total').prop('disabled', false);
                }
            });

            // =================== Add Budget Ceiling Modal Code ===================
            // Initialize Select2 on the PAP select element for the Add modal
            initializeSelect2('#pap', '#addBudgetCeilingModal');

            $('.total').on('input', function() {
                formatInput($(this));
            });

            // Attach input event listeners to PS, MOOE, and CO fields for the Add modal
            $('.ps, .mooe, .co').on('input', function() {
                formatInput($(this));
                updateTotal($(this).closest('.add-budget-ceiling-modal'), ['.ps', '.mooe', '.co'], '.total');
            });

            // Common change handler for PAP selection for Add modal
            handlePapChange('#pap', '#fund_source', '#mfo');
            // Common change handler for Fund Source and MFO selection for Add modal
            handleFilterChange('.add-fund-source', '.add-mfo', '.add-pap');
        });

        // =================== Edit Budget Ceiling Modal Code ===================
        $(document).on('shown.bs.modal', '.edit-budget-ceiling-modal', function(e) {
            const editBudgetCeilingModal = $(this);
            const editPsInput = editBudgetCeilingModal.find('.edit-ps');
            const editMooeInput = editBudgetCeilingModal.find('.edit-mooe');
            const editCoInput = editBudgetCeilingModal.find('.edit-co');
            const editTotalInput = editBudgetCeilingModal.find('.edit-total');
            const editFundSourceInput = editBudgetCeilingModal.find('.edit-fund-source');
            const editPapInput = editBudgetCeilingModal.find('.edit-pap');
            const editMofInput = editBudgetCeilingModal.find('.edit-mfo');

            // Fund source change event
            editFundSourceInput.on('change', function() {
                var abbreviation = $(this).find(':selected').data('abbreviation');
                // console.log(abbreviation);
                if (abbreviation === 'GAA' || abbreviation === 'TES') {
                    // Enable PS, MOOE, and CO fields
                    editPsInput.prop('disabled', false);
                    editMooeInput.prop('disabled', false);
                    editCoInput.prop('disabled', false);
                    editTotalInput.prop('disabled', true).val('0.00');  // Disable total
                } else {
                    // Disable PS, MOOE, and CO fields
                    editPsInput.prop('disabled', true).val('0.00');
                    editMooeInput.prop('disabled', true).val('0.00');
                    editCoInput.prop('disabled', true).val('0.00');
                    editTotalInput.prop('disabled', false);  // Enable total
                }
            });

            // Automatically trigger the change event when the modal is shown
            editFundSourceInput.trigger('change');

            // Initialize Select2 and other input listeners
            initializeSelect2(editPapInput, editBudgetCeilingModal);

            // Reattach input event listeners for the Edit modal
            editBudgetCeilingModal.find('.edit-ps, .edit-mooe, .edit-co').on('input', function() {
                formatInput($(this)); // Format input fields with commas
                updateTotal($(this).closest('.edit-budget-ceiling-modal'), ['.edit-ps', '.edit-mooe', '.edit-co'], '.edit-total'); // Update total for Edit modal
            });

            // Rebind change listeners for the Fund Source, MFO, and PAP in the Edit modal
            handleFilterChange(editFundSourceInput, editMofInput, editPapInput);
            handlePapChange('.edit-pap', '.edit-fund-source', '.edit-mfo');

            // Add input event listener for Total input
            editBudgetCeilingModal.find('.edit-total').on('input', function() {
                formatInput($(this)); // Format total input with commas
            });
        });

        // =================== Shared Functions ===================
        // Function to initialize Select2 on a specific select element
        function initializeSelect2(selector, parentModal) {
            $(selector).select2({
                dropdownParent: $(parentModal),
                theme: "bootstrap-5",
                width: '100%',
            });
        }

        // Function to format input with commas as the user types
        function formatInput(input) {
            let value = input.val();
            // Remove all non-numeric characters except for decimal points
            value = value.replace(/[^0-9.]/g, '');
            // Ensure there's only one decimal point
            const parts = value.split('.');
            if (parts.length > 2) {
                value = parts[0] + '.' + parts[1]; // Keep only the first decimal point
            }
            // Add commas to the integer part of the number and leave decimals intact
            if (parts.length === 2) {
                value = parseFloat(parts[0]).toLocaleString() + '.' + parts[1];
            } else if (parts[0] !== '') {
                value = parseFloat(parts[0]).toLocaleString();
            }
            // Update the input field value
            input.val(value);
        }

        // Function to calculate and update the total for modal inputs
        function updateTotal(modal, totalFields, totalSelector) {
            let total = 0;
            totalFields.forEach(function(field) {
                total += parseFloat(modal.find(field).val().replace(/,/g, '')) || 0; // Use modal context to find fields
            });
            // Update the total input field
            modal.find(totalSelector).val(total.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        }

        // Function to handle PAP selection changes
        function handlePapChange(papSelector, fundSourceSelector, mfoSelector) {
            $(papSelector).change(function() {
                const papId = $(this).val();
                if (papId) {
                    $.ajax({
                        url: `/admin/get-fundsource-and-mfo-by-paps/${papId}`,
                        method: 'GET',
                        success: function(data) {
                            if (data.status === 'success') {
                                $(fundSourceSelector).val(data.fund_source_id);
                                $(mfoSelector).val(data.mfo_id);
                            } else {
                                alert(data.message);
                            }
                        }
                    });
                }
            });
        }

        // =================== Handle Filter Change Function ===================
        function handleFilterChange(fundSourceSelector, mfoSelector, papSelector) {
            // Convert selectors to jQuery objects
            const $fundSource = $(fundSourceSelector);
            const $mfo = $(mfoSelector);
            const $pap = $(papSelector);

            // Bind the change event on both fundSource and MFO selectors
            $fundSource.add($mfo).on('change', function() {
                const fundSourceId = $fundSource.val();
                // const fundSourceAbbreviation = $fundSource.find('option:selected').data('abbreviation');
                const mfoId = $mfo.val();

                // Output the fundSourceAbbreviation to the console for testing
                // console.log("Fund Source Abbreviation: ", fundSourceAbbreviation);

                // Reset the PAP dropdown
                $pap.empty().append('<option value=""> -- Select Program, Activity, Projects -- </option>');

                // Construct the URL for the AJAX request
                let url = '/admin/get-paps';
                const params = [];

                // Add fundSourceId to the params if it exists
                if (fundSourceId) {
                    params.push(`fundSourceId=${fundSourceId}`);
                }

                // Add mfoId to the params if it exists
                if (mfoId) {
                    params.push(`mfoId=${mfoId}`);
                }

                // If there are parameters, execute the AJAX call
                if (params.length > 0) {
                    url += '?' + params.join('&');
                    $.ajax({
                        url: url,
                        method: 'GET',
                        success: function(data) {
                            // console.log(data);
                            if (data.length > 0) {
                                // Populate the PAP dropdown with the returned data
                                data.forEach(function(pap) {
                                    // console.log(pap);
                                    $pap.append(`<option value="${pap.id}">${pap.name}</option>`);
                                });
                                // Reinitialize Select2 on the PAP field after appending new options
                                $pap.select2({
                                    dropdownParent: $pap.closest('.modal'),
                                    theme: "bootstrap-5",
                                    width: '100%'
                                }).prop('disabled', false);
                            } else {
                                // If no data is returned, show a disabled option
                                $pap.append('<option value="">No PAPs found</option>');
                            }
                        }
                    });
                }
            });
        }

        function confirmDelete(element, programActivityProjectCode) {
            const deleteUrl = $(element).data('url');  // Get the delete URL from the data-url attribute
            // Display the SweetAlert with the PAP code inline in the title
            Swal.fire({
                html: `<div style="font-size: 18px;">Are you sure you want to delete budget ceiling for ${programActivityProjectCode}?</div>`,  // PAP code in the title
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
                reverseButtons: false,  // Keep the buttons in default order (Delete on the left)
                width: '350px',  // Reduced size for a more compact alert
                customClass: {
                    confirmButton: 'btn btn-danger btn-sm mx-2',  // Smaller delete button
                    cancelButton: 'btn btn-secondary btn-sm mx-2',  // Smaller cancel button with margin for space
                },
                buttonsStyling: false,  // Disable default button styling to apply Bootstrap styles
                background: '#f5f5f5',  // Light grey background
                padding: '20px',
                iconColor: '#d9534f',  // Custom icon color
            }).then((result) => {
                // console.log('Delete URL:', deleteUrl);
                if (result.isConfirmed) {
                    // Perform the delete action (make an AJAX request)
                    $.ajax({
                        url: deleteUrl,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'  // Include CSRF token for security
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                `The budget ceiling for "${programActivityProjectCode}" has been deleted successfully.`,
                                'success'
                            );
                            // Optionally reload or remove the row from the DOM
                            location.reload();  // Refresh the page or remove the row
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'There was an issue deleting the record. Please try again later.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script> --}}
@endpush
