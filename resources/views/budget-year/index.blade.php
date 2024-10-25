@extends('layouts.app')

@section('page-title', 'Budget Year')

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
                    <div class="flex-grow-1">
                    </div>
                        <div class="mt-3 mt-md-0">
                            <a href="#addBudgetYearModal"
                                class="btn btn-outline-primary shadow-sm btn-sm"
                                data-bs-toggle="modal"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Create New Budget Year">
                                <i class="bi bi-plus-lg"></i>
                            </a>
                        </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive table-card">
                      <table id="example" class="table text-nowrap table-centered mt-0" style="width: 100%">
                        <thead class="table-light">
                          <tr>
                            <th>Year</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($budgetYears as $budgetYear)
                          <tr>
                            <td>{{ $budgetYear->year }}</td>
                            <td>
                                @if ($budgetYear->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <!-- Edit Button -->
                                <a href="#editBudgetYearModal-{{$budgetYear->id}}"
                                    class="btn btn-outline-primary btn-sm rounded-circle shadow-sm"
                                    data-bs-toggle="modal"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Edit">
                                     <i class="bi bi-pencil"></i>
                                 </a>

                                 <!-- Delete Button -->
                                 <a href="#deleteBudgetYearModal-{{$budgetYear->id}}"
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
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

</div>





<!-- Add Budget Year Modal -->
<div class="modal fade" id="addBudgetYearModal" tabindex="-1" aria-labelledby="addBudgetYearModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBudgetYearModalLabel">Add Budget Year</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('budget-year.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="budget-year" class="form-label">Year:</label>
                        <input type="text" class="form-control" id="budget-year" name="year" placeholder="Enter budget year" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status:</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="" disabled selected>Select status</option>
                            <option value="active" selected>Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
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


<!-- Edit Budget Year Modal -->
@foreach ($budgetYears as $budgetYear)
<div class="modal fade" id="editBudgetYearModal-{{$budgetYear->id}}" tabindex="-1"
    aria-labelledby="editBudgetYearModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBudgetYearModalLabel">Edit Budget Year</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('budget-year.update', $budgetYear->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-budget-year" class="form-label">Year</label>
                        <input type="text" class="form-control" id="edit-budget-year" name="year" value="{{ $budgetYear->year }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status:</label>
                        <select class="form-select" id="status" name="status">
                            <option value="" disabled>Select status</option>
                            <option value="active" {{ $budgetYear->is_active ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ !$budgetYear->is_active ? 'selected' : '' }}>Inactive</option>
                        </select>
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
@endforeach


<!-- Delete Budget Year Modal -->
@foreach ($budgetYears as $budgetYear)
<div class="modal fade" id="deleteBudgetYearModal-{{$budgetYear->id}}" tabindex="-1"
    aria-labelledby="deleteBudgetYearModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteBudgetYearLabel">Delete Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('budget-year.delete', $budgetYear->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    Are you sure to delete Budget year: <strong>{{ $budgetYear->year }}</strong> ?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('page-scripts')
<script>
    $(document).ready(function() {
        $('#budget-year, #edit-budget-year').datepicker({
            format: "yyyy", // Format to display the year only
            viewMode: "years",
            minViewMode: "years", // Only display years in the picker
            autoclose: true // Close the picker after selecting the year
        });
    });
</script>
@endpush
