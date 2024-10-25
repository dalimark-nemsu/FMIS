@extends('layouts.app')

@section('page-title', 'Campus Budget Ceiling')

@push('page-style')
    <style>
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
                    <div class="my-3 mt-4">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <!-- Cards on the Left in a single line -->
                            <div class="d-flex flex-wrap">
                                <!-- Campus Card -->
                                <div class="card shadow-lg border-0 rounded-4 me-4" style="min-width: 220px; max-width: 100%; transition: transform 0.3s ease-in-out;">
                                    <div class="card-body d-flex justify-content-start align-items-center p-4 bg-white rounded-4 position-relative" style="background: linear-gradient(135deg, #f0f4f7 0%, #ffffff 100%);">
                                        <!-- Icon Container with a subtle gradient and shadow -->
                                        <div class="icon-container me-3" style="width: 60px; height: 60px; background-color: #36454F; border-radius: 50%; display: flex; justify-content: center; align-items: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                            <i class="bi bi-building fs-3" style="color: white; transition: color 0.3s ease-in-out;"></i>
                                        </div>
                                        <div class="text-start">
                                            <!-- Campus Label -->
                                            <h5 class="text-muted mb-1" style="letter-spacing: 1px; font-weight: 500;">Campus</h5>
                                            <!-- Campus Name with larger font and bold style -->
                                            <p class="fs-5 fw-bold text-dark mb-0" style="font-size: 1.25rem;">{{ $campus->name }}</p>
                                        </div>
                                        <!-- Add a subtle hover effect that lifts the card -->
                                        <div class="hover-overlay" style="position: absolute; inset: 0; background-color: rgba(255, 255, 255, 0); border-radius: 4px; transition: background-color 0.3s ease-in-out;"></div>
                                    </div>
                                </div>
                                <!-- Budget Year Card -->
                                <div class="card shadow-lg border-0 rounded-4 me-4 budget-year-card" style="min-width: 220px; max-width: 100%; transition: transform 0.3s ease-in-out;">
                                    <div class="card-body d-flex justify-content-start align-items-center p-4 bg-white rounded-4 position-relative" style="background: linear-gradient(135deg, #f7fafc 0%, #ffffff 100%);">
                                        <!-- Icon Container -->
                                        <div class="icon-container me-3" style="width: 60px; height: 60px; background-color: #36454F; border-radius: 50%; display: flex; justify-content: center; align-items: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease-in-out;">
                                            <i class="bi bi-calendar-event fs-3" style="color: white; transition: color 0.3s ease-in-out;"></i>
                                        </div>
                                        <div class="text-start">
                                            <!-- Budget Year Label -->
                                            <h5 class="text-muted mb-1" style="letter-spacing: 1px; font-weight: 500;">Budget Year</h5>
                                            <!-- Active Year with bold font -->
                                            <p class="fs-5 fw-bold text-dark mb-0" style="font-size: 1.25rem;">{{ $activeYear->year }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Grand Total Card -->
                                <div class="card shadow-lg border-0 rounded-4 me-4 grand-total-card" style="min-width: 220px; max-width: 100%; transition: transform 0.3s ease-in-out;">
                                    <div class="card-body d-flex justify-content-start align-items-center p-4 bg-white rounded-4 position-relative" style="background: linear-gradient(135deg, #f7fafc 0%, #ffffff 100%);">
                                        <!-- Icon Container -->
                                        <div class="icon-container me-3" style="width: 60px; height: 60px; background-color: #36454F; border-radius: 50%; display: flex; justify-content: center; align-items: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease-in-out;">
                                            <i class="bi bi-cash-stack fs-3" style="color: white; transition: color 0.3s ease-in-out;"></i>
                                        </div>
                                        <div class="text-start">
                                            <!-- Grand Total Label -->
                                            <h5 class="text-muted mb-1" style="letter-spacing: 1px; font-weight: 500;">Grand Total</h5>
                                            <!-- Grand Total Amount -->
                                            <p class="fs-5 fw-bold text-dark mb-0" style="font-size: 1.25rem;">&#8369 {{ number_format($grandTotal, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Units Card (Clickable) -->
                                <a href="{{ route('admin.unit-budget-ceiling.index', ['campus_id' => $campus->id, 'active_year_id' => $activeYear->id]) }}" class="text-decoration-none">
                                    <div class="card shadow-lg border-0 rounded-4 me-4 units-card" style="min-width: 220px; max-width: 100%; transition: transform 0.3s ease-in-out;">
                                        <div class="card-body d-flex justify-content-start align-items-center p-4 bg-white rounded-4 position-relative" style="background: linear-gradient(135deg, #f7fafc 0%, #ffffff 100%);">
                                            <!-- Icon Container -->
                                            <div class="icon-container me-3" style="width: 60px; height: 60px; background-color: #36454F; border-radius: 50%; display: flex; justify-content: center; align-items: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease-in-out;">
                                                <i class="bi bi-diagram-3 fs-3" style="color: white; transition: color 0.3s ease-in-out;"></i>
                                            </div>
                                            <div class="text-start">
                                                <!-- Units Label -->
                                                <h5 class="text-muted mb-1" style="letter-spacing: 1px; font-weight: 500;">Units</h5>
                                                <!-- Unit Count -->
                                                <p class="fs-5 fw-bold text-dark mb-0" style="font-size: 1.25rem;"></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <!-- Add Button -->
                                @if($activeYear && $activeYear->id == $budgetYearId)
                                <div>
                                    <!-- Budget Ceiling Card -->
                                    <a href="#addBudgetCeilingModal" class="card shadow-lg border-0 rounded-4 bg-light p-3 text-center create-budget-card"
                                       data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-placement="top"
                                       title="Create New Budget Ceiling"
                                       style="min-width: 140px; max-width: 100%; height: 100px; transition: transform 0.3s ease-in-out;">
                                        <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
                                            <!-- Plus Icon -->
                                            <i class="bi bi-plus-lg fs-1 text-primary" style="transition: color 0.3s ease-in-out;"></i>
                                        </div>
                                    </a>
                                </div>
                                @endif
                                @include('budget-ceilings.modals.add-budget-ceiling', ['campus' => $campus, 'activeYear' => $activeYear, 'fundSources' => $fundSources, 'mfos' => $mfos, 'paps' => $paps])
                            </div>
                        </div>

                        @if($groupedBudgetCeilings->isNotEmpty())
                        @foreach ($groupedBudgetCeilings as $fundSource => $budgetCeilings)
                            <!-- Card for each Fund Source -->
                            <div class="card shadow-lg mt-4 border-0 rounded-4">
                                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 px-4">
                                    <h4 class="mb-0" style="font-weight: 600; color: #36454F;">{{ $fundSource }}</h4> <!-- Display the fund source as the card title -->

                                    <!-- Subtotal Display -->
                                    <div class="text-end">
                                        <strong class="text-muted">Subtotal: </strong>
                                        <span class="fs-4 fw-bold text-dark">
                                            &#8369 {{ number_format($budgetCeilings->sum('total_amount'), 2) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="table-responsive p-4">
                                    <table id="example" class="table table-hover table-bordered align-middle text-center" style="width: 100%;">
                                        <thead style="background-color: #36454F; color: white;">
                                            <tr>
                                                <th>PAPs</th>
                                                <th>Fund Source</th>
                                                <th>MFOs</th>
                                                <th>PS</th>
                                                <th>MOOE</th>
                                                <th>CO</th>
                                                <th>Total</th>
                                                @if($activeYear && $activeYear->id == $budgetYearId)
                                                <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($budgetCeilings as $budgetCeiling)
                                                <tr class="hoverable-row">
                                                    <td>{{ $budgetCeiling->programActivityProject?->code }}</td>
                                                    <td>{{ $budgetCeiling->programActivityProject->fundSource?->abbreviation }}</td>
                                                    <td>{{ $budgetCeiling->programActivityProject->majorFinalOutput?->abbreviation }}</td>
                                                    <td>&#8369 {{ number_format($budgetCeiling->ps, 2) }}</td>
                                                    <td>&#8369 {{ number_format($budgetCeiling->mooe, 2) }}</td>
                                                    <td>&#8369 {{ number_format($budgetCeiling->co, 2) }}</td>
                                                    <td>&#8369 {{ number_format($budgetCeiling->total_amount, 2) }}</td>
                                                    @if($activeYear && $activeYear->id == $budgetYearId)
                                                    <td>
                                                        <!-- Edit Button -->
                                                        <a href="#editBudgetCeilingModal-{{$budgetCeiling->id}}"
                                                        class="btn btn-outline-primary btn-sm rounded-circle shadow-sm me-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Edit">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>

                                                        <!-- Delete Button -->
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-outline-danger btn-sm rounded-circle shadow-sm"
                                                            data-url="{{ route('budget-ceilings.delete', $budgetCeiling->id) }}"
                                                            onclick="confirmDelete(this, '{{ $budgetCeiling->programActivityProject?->code }}')"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
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
            $('.add-fund-source').on('change', function() {
                // Get the selected option's data-abbreviation value
                var abbreviation = $(this).find(':selected').data('abbreviation');
                // console.log(abbreviation);
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
    </script>
@endpush
