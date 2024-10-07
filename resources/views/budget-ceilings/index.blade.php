@extends('layouts.app')

@section('page-title', 'Campus Budget Ceiling')

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
                                <div class="card shadow border-0 rounded-3 me-4" style="min-width: 200px; max-width: 100%;">
                                    <div class="card-body d-flex justify-content-start align-items-center p-3 bg-light rounded-3">
                                        <div class="icon-container me-3" style="width: 50px; height: 50px; background-color: #eaefe9; border-radius: 50%; display: flex; justify-content: center; align-items: center;">
                                            <i class="bi bi-building fs-4 text-info"></i>
                                        </div>
                                        <div class="text-start">
                                            <h5 class="text-muted mb-0">Campus</h5>
                                            <p class="fs-5 fw-bold text-dark mb-0 mt-1">{{ $campus->name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Budget Year Card -->
                                <div class="card shadow border-0 rounded-3 me-4" style="min-width: 200px; max-width: 100%;">
                                    <div class="card-body d-flex justify-content-start align-items-center p-3 bg-light rounded-3">
                                        <div class="icon-container me-3" style="width: 50px; height: 50px; background-color: #e9ecef; border-radius: 50%; display: flex; justify-content: center; align-items: center;">
                                            <i class="bi bi-calendar-event fs-4 text-success"></i>
                                        </div>
                                        <div class="text-start">
                                            <h5 class="text-muted mb-0">Budget Year</h5>
                                            <p class="fs-5 fw-bold text-dark mb-0 mt-1">{{ $activeYear->year }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Grand Total Card -->
                                <div class="card shadow border-0 rounded-3 me-4" style="min-width: 200px; max-width: 100%;">
                                    <div class="card-body d-flex justify-content-start align-items-center p-3 bg-light rounded-3">
                                        <div class="icon-container me-3" style="width: 50px; height: 50px; background-color: #e9ecef; border-radius: 50%; display: flex; justify-content: center; align-items: center;">
                                            <i class="bi bi-cash-stack fs-4 text-primary"></i>
                                        </div>
                                        <div class="text-start">
                                            <h5 class="text-muted mb-0">Grand Total</h5>
                                            <p class="fs-5 fw-bold text-dark mb-0 mt-1">&#8369 {{ number_format($grandTotal, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Google-Style Add Button -->
                                <div>
                                    <a href="#addBudgetCeilingModal" class="card shadow border-0 rounded-3 bg-light p-3 text-center" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-placement="top" title="Create New Budget Ceiling" style="min-width: 120px; max-width: 120%; height: 120px;">
                                        <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
                                            <i class="bi bi-plus-lg fs-1 text-primary" style="flex-shrink: 0;"></i>
                                        </div>
                                    </a>
                                </div>
                                @include('budget-ceilings.modals.add-budget-ceiling', ['campus' => $campus, 'activeYear' => $activeYear, 'fundSources' => $fundSources, 'mfos' => $mfos, 'paps' => $paps])
                            </div>
                        </div>

                    @if($groupedBudgetCeilings->isNotEmpty())
                        @foreach ($groupedBudgetCeilings as $fundSource => $budgetCeilings)
                            <!-- Card for each Fund Source -->
                            <div class="card mt-3">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="mb-0">{{ $fundSource }}</h4> <!-- Display the fund source as the card title -->

                                    <!-- Subtotal Display -->
                                    <div>
                                        <strong>Subtotal: </strong>
                                        <span class="fs-5 text-dark">
                                            &#8369 {{ number_format($budgetCeilings->sum(function($budgetCeiling) {
                                                return $budgetCeiling->ps + $budgetCeiling->mooe + $budgetCeiling->co;
                                            }), 2) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="table-responsive table-card p-4">
                                    <table id="example" class="table text-nowrap table-centered mt-0" style="width: 100%">
                                        <thead class="table-light">
                                            <tr>
                                                <th>PAPs</th>
                                                <th>Fund Source</th>
                                                <th>MFOs</th>
                                                <th>PS</th>
                                                <th>MOOE</th>
                                                <th>CO</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($budgetCeilings as $budgetCeiling)
                                                <tr>
                                                    <td>{{ $budgetCeiling->programActivityProject?->code }}</td>
                                                    <td>{{ $budgetCeiling->programActivityProject->fundSource?->abbreviation }}</td>
                                                    <td>{{ $budgetCeiling->programActivityProject->majorFinalOutput?->abbreviation }}</td>
                                                    <td>&#8369 {{ number_format($budgetCeiling->ps, 2) }}</td>
                                                    <td>&#8369 {{ number_format($budgetCeiling->mooe, 2) }}</td>
                                                    <td>&#8369 {{ number_format($budgetCeiling->co, 2) }}</td>
                                                    <td>&#8369 {{ number_format($budgetCeiling->ps + $budgetCeiling->mooe + $budgetCeiling->co, 2) }}</td>
                                                    <td>
                                                        <!-- Edit Button -->
                                                        <a href="#editBudgetCeilingModal-{{$budgetCeiling->id}}"
                                                        class="btn btn-outline-primary btn-sm rounded-circle shadow-sm"
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
            // =================== Add Budget Ceiling Modal Code ===================

            // Initialize Select2 on the PAP select element for the Add modal
            initializeSelect2('#pap', '#addBudgetCeilingModal');

            // Attach input event listeners to PS, MOOE, and CO fields for the Add modal
            $('#ps, #mooe, #co').on('input', function() {
                formatInput($(this)); // Format input fields with commas
                // updateTotal(['#ps', '#mooe', '#co'], '#total'); // Update total for Add modal
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
            const editPapInput = editBudgetCeilingModal.find('.edit-pap');
            const editFundSourceInput = editBudgetCeilingModal.find('.edit-fund-source');
            const editMofInput = editBudgetCeilingModal.find('.edit-mfo');

            initializeSelect2(editPapInput, editBudgetCeilingModal);

            // Reattach input event listeners for the Edit modal
            editBudgetCeilingModal.find('.edit-ps, .edit-mooe, .edit-co').on('input', function() {
                formatInput($(this)); // Format input fields with commas
                updateTotal($(this).closest('.edit-budget-ceiling-modal'), ['.edit-ps', '.edit-mooe', '.edit-co'], '.edit-total'); // Update total for Edit modal
            });

            // Rebind change listeners for the Fund Source, MFO, and PAP in the Edit modal
            handleFilterChange(editFundSourceInput, editMofInput, editPapInput);
            // Make sure the PAP change handler runs once
            handlePapChange('.edit-pap', '.edit-fund-source', '.edit-mfo');
            // editBudgetCeilingModal.find('.edit-pap').off('change').on('change', function() {
            //
            // });
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
            // Update total display
            modal.find(totalSelector).text(total.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
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
                const mfoId = $mfo.val();

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
                                    // console.log(pap.id, pap.code);
                                    $pap.append(`<option value="${pap.id}">${pap.code}</option>`);
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
