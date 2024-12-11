@extends('layouts.app')

@section('page-title', 'Budget Types')

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
                            <a href="#addBudgetTypeModal"
                                class="btn btn-outline-primary shadow-sm btn-sm"
                                data-bs-toggle="modal"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Create New Budget Type">
                                <i class="bi bi-plus-lg"></i>
                            </a>
                        </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive table-card">
                      <table id="example" class="table text-nowrap table-centered mt-0" style="width: 100%">
                        <thead class="table-light">
                          <tr>
                            <th>No.</th>
                            <th>Fund Source</th>
                            <th>Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($budgetTypes as $budgetType)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $budgetType->fundSource->abbreviation }}</td>
                            <td>{{ $budgetType->name }}</td>
                            <td>
                                <!-- Edit Button -->
                                <a href="#editBudgetTypeModal-{{$budgetType->id}}"
                                   class="btn btn-outline-primary btn-sm rounded-circle shadow-sm"
                                   data-bs-toggle="modal"
                                   data-bs-toggle="tooltip"
                                   data-bs-placement="top"
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <!-- Delete Button -->
                                <a href="#deleteBudgetTypeModal-{{$budgetType->id}}"
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

<!-- Add Budget Type Modal -->
<div class="modal fade" id="addBudgetTypeModal" tabindex="-1" aria-labelledby="addBudgetTypeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBudgetTypeModalLabel">Add New Budget Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('budget-types.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="fund_source_id" class="form-label">Fund Source:</label>
                        <select class="form-control" id="fund_source_id" name="fund_source_id" required>
                            <option value="" selected disabled>Select Fund Source</option>
                            @foreach ($fundSources as $fundSource)
                                <option value="{{ $fundSource->id }}">{{ $fundSource->abbreviation }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Budget Type Name" required>
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

<!-- Edit Budget Type Modal -->
@foreach ($budgetTypes as $budgetType)
<div class="modal fade" id="editBudgetTypeModal-{{$budgetType->id}}" tabindex="-1"
    aria-labelledby="editBudgetTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBudgetTypeModalLabel">Edit Budget Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('budget-types.update', $budgetType->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="fund_source_id" class="form-label">Fund Source:</label>
                        <select class="form-control" id="fund_source_id" name="fund_source_id" required>
                            @foreach ($fundSources as $fundSource)
                                <option value="{{ $fundSource->id }}" {{ $fundSource->id == $budgetType->fund_source_id ? 'selected' : '' }}>
                                    {{ $fundSource->abbreviation }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $budgetType->name }}" required>
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

<!-- Delete Budget Type Modal -->
@foreach ($budgetTypes as $budgetType)
<div class="modal fade" id="deleteBudgetTypeModal-{{$budgetType->id}}" tabindex="-1"
    aria-labelledby="deleteBudgetTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteBudgetTypeModalLabel">Delete Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('budget-types.delete', $budgetType->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    Are you sure you want to delete Budget Type: <strong>{{ $budgetType->name }}</strong>?
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
