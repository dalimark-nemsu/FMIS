@extends('layouts.app')

{{-- @push('page-style')
<style>
    .budget-year-tag {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        font-size: 16px;
        font-weight: 500;
        color: #333;
    }

    .budget-year-tag i {
        margin-right: 5px; /* Space between icon and text */
    }

    .year-value {
        display: inline-block;
        padding: 4px 15px; /* Padding inside the tag */
        background-color: #28a745; /* Green background for the tag */
        color: #fff; /* White text color */
        font-weight: 700; /* Emphasize the year */
        font-size: 16px; /* Font size for the year */
        margin-left: 5px; /* Space between "Budget Year" and the year */
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: white;
        transition: background-color 0.3s ease;
    }
</style>
@endpush --}}

@section('page-title', 'Budget Ceiling - ' . $campus->name . ' Campus (Budget Year: '. $activeYear->year .')')

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
                    {{-- <!-- Budget Year Display -->
                    <div class="d-flex mb-2">
                        <span class="budget-year-tag ms-4">
                        <i class="bi bi-calendar-event"></i> <!-- Icon for the tag -->
                        Budget Year: <span class="year-value">{{ $activeYear->year }}</span>
                        </span>
                    </div> --}}

                    <!-- Horizontal Lines and Centered Button -->
                    <div class="d-flex align-items-center">
                        <!-- Left Horizontal Line -->
                        <div class="flex-grow-1 border-bottom"></div>

                        <!-- Centered Button -->
                        <div class="mx-3">
                        <a href="#addBudgetCeilingModal"
                            class="btn btn-outline-primary shadow-sm btn-sm"
                            data-bs-toggle="modal"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Create New Budget Ceiling">
                            <i class="bi bi-plus-lg"></i>
                        </a>
                        </div>

                        <!-- Right Horizontal Line -->
                        <div class="flex-grow-1 border-bottom"></div>
                    </div>

                    @if($groupedBudgetCeilings->isNotEmpty())
                        @foreach ($groupedBudgetCeilings as $fundSource => $budgetCeilings)
                            <!-- Card for each Fund Source -->
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h4 class="mb-0">{{ $fundSource }}</h4> <!-- Display the fund source as the card title -->
                                </div>
                                <div class="table-responsive table-card p-4">
                                    <table id="example" class="table text-nowrap table-centered mt-0" style="width: 100%">
                                        <thead class="table-light">
                                            <tr>
                                                <th>PAP</th>
                                                <th>MFO</th>
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
                                                    <td>{{ $budgetCeiling->programActivityProject->majorFinalOutput?->abbreviation }}</td>
                                                    <td>{{ number_format($budgetCeiling->ps, 2) }}</td>
                                                    <td>{{ number_format($budgetCeiling->mooe, 2) }}</td>
                                                    <td>{{ number_format($budgetCeiling->co, 2) }}</td>
                                                    <td>{{ number_format($budgetCeiling->ps + $budgetCeiling->mooe + $budgetCeiling->co, 2) }}</td>
                                                    <td>
                                                        <!-- Edit Button -->
                                                        <a href="#editBudgetModal-{{$budgetCeiling->id}}"
                                                        class="btn btn-outline-primary btn-sm rounded-circle shadow-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Edit">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>

                                                        <!-- Delete Button -->
                                                        <a href="#deleteBudgetModal-{{$budgetCeiling->id}}"
                                                        class="btn btn-outline-danger btn-sm rounded-circle shadow-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Delete">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
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

<!-- Add Budget Ceiling Modal -->
<div class="modal fade" id="addBudgetCeilingModal" tabindex="-1" aria-labelledby="addBudgetCeilingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBudgetCeilingModalLabel">Add New Budget Ceiling ({{ $campus->name }} Campus)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('budget-ceilings.store',['campus_id' => $campus->id, 'year_id' => $activeYear->id]) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Column 1 -->
                        <div class="col-md-6">
                            <label for="fundSource" class="form-label">Fund Source:</label>
                            <select class="form-select" name="fundSource" id="fund_source">
                                <option value=""> -- Select Fund Source -- </option>
                                @foreach ($fundSources as $fundSource )
                                    <option value="{{ $fundSource->id }}">{{ $fundSource->abbreviation }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Column 2 -->
                        <div class="col-md-6">
                            <label for="mfo" class="form-label">MFO:</label>
                            <select class="form-select" name="mfo" id="mfo">
                                <option value=""> -- Select Major Final Outputs -- </option>
                                @foreach ($mfos as $mfo )
                                    <option value="{{ $mfo->id }}">{{ $mfo->abbreviation }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="pap" class="form-label">PAP:</label>
                            <select class="form-select" name="pap" id="pap">
                                <option value=""> -- Select Program, Activity, Projects -- </option>
                                @foreach ($paps as $pap )
                                    <option value="{{ $pap->id }}">{{ $pap->code }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="ps" class="form-label">PS:</label>
                            <input type="text" class="form-control" id="ps" name="ps" required>
                        </div>

                        <div class="col-md-6">
                            <label for="mooe" class="form-label">MOOE:</label>
                            <input type="text" class="form-control" id="mooe" name="mooe" required>
                        </div>

                        <div class="col-md-6">
                            <label for="co" class="form-label">CO:</label>
                            <input type="text" class="form-control" id="co" name="co" required>
                        </div>
                    </div>

                    <!-- Horizontal line to separate inputs from total -->
                    <hr class="my-4">

                    <!-- Total display -->
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <label for="total" class="form-label fs-5 fw-bold">Total: &#8369</label>
                            <span id="total" class="fs-5 fw-bold">0.00</span> <!-- Default total value as 0 -->
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Edit Fund Source Modal -->
{{-- @foreach ($fundSources as $fundSource)
<div class="modal fade" id="editFundSourceModal-{{$fundSource->id}}" tabindex="-1"
    aria-labelledby="editFundSourceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFundSourceModalLabel">Edit Fund Source</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('fund-sources.update', $fundSource->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="abbrev" class="form-label">Abbreviation:</label>
                        <input type="text" class="form-control" id="abbrev" name="abbrev" value="{{ $fundSource->abbreviation }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" value="{{ $fundSource->name }}" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach --}}


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
        // Attach input event listeners to PS, MOOE, and CO fields
        $('#ps, #mooe, #co').on('input', function() {
            formatInput($(this)); // Format input fields with commas
            updateTotal(); // Update total with formatted values
        });

        // Function to format input with commas as user types
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
                // Add commas only to the integer part
                value = parseFloat(parts[0]).toLocaleString() + '.' + parts[1];
            } else if (parts[0] !== '') {
                value = parseFloat(parts[0]).toLocaleString();
            }

            // Update the input field value
            input.val(value);
        }

        // Function to calculate and update the total
        function updateTotal() {
            // Remove commas before parsing the values for calculation
            const ps = parseFloat($('#ps').val().replace(/,/g, '')) || 0;
            const mooe = parseFloat($('#mooe').val().replace(/,/g, '')) || 0;
            const co = parseFloat($('#co').val().replace(/,/g, '')) || 0;
            const total = ps + mooe + co;

            // Check if the inputs are valid numbers and display the total, otherwise display 0
            $('#total').text(total.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        }
    });
</script>
@endpush
