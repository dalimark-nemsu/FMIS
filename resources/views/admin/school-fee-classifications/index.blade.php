@extends('layouts.app')

@section('page-title', 'School Fee Classifications')

@section('content')
<div id="app-content">
    <div class="app-content-area">
        <div class="container-fluid">
            @include('message.success')
            @include('message.error')

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-md-flex border-bottom-0">
                            <h5>School Fee Classifications</h5>
                            <div class="ms-auto">
                                <a href="#addSchoolFeeClassificationModal" 
                                   class="btn btn-outline-primary shadow-sm btn-sm" 
                                   data-bs-toggle="modal" 
                                   title="Create New Classification">
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
                                        @foreach ($schoolFeeClassifications as $classification)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $classification->fundSource->abbreviation }}</td>
                                            <td>{{ $classification->name }}</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <a href="#editSchoolFeeClassificationModal-{{ $classification->id }}" 
                                                   class="btn btn-outline-primary btn-sm rounded-circle shadow-sm" 
                                                   data-bs-toggle="modal" 
                                                   title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <!-- Delete Button -->
                                                <a href="#deleteSchoolFeeClassificationModal-{{ $classification->id }}" 
                                                   class="btn btn-outline-danger btn-sm rounded-circle shadow-sm" 
                                                   data-bs-toggle="modal" 
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

<!-- Add Modal -->
<div class="modal fade" id="addSchoolFeeClassificationModal" tabindex="-1" aria-labelledby="addSchoolFeeClassificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('school-fee-classifications.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Classification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="fund_source_id" class="form-label">Fund Source:</label>
                        <select class="form-control" id="fund_source_id" name="fund_source_id" required>
                            <option value="" disabled selected>Select Fund Source</option>
                            @foreach ($fundSources as $fundSource)
                                <option value="{{ $fundSource->id }}">{{ $fundSource->abbreviation }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Classification Name" required>
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

<!-- Edit Modal -->
@foreach ($schoolFeeClassifications as $classification)
<div class="modal fade" id="editSchoolFeeClassificationModal-{{ $classification->id }}" tabindex="-1" aria-labelledby="editSchoolFeeClassificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('school-fee-classifications.update', $classification->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Classification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="fund_source_id" class="form-label">Fund Source:</label>
                        <select class="form-control" id="fund_source_id" name="fund_source_id" required>
                            @foreach ($fundSources as $fundSource)
                                <option value="{{ $fundSource->id }}" {{ $fundSource->id == $classification->fund_source_id ? 'selected' : '' }}>
                                    {{ $fundSource->abbreviation }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $classification->name }}" required>
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

<!-- Delete Modal -->
@foreach ($schoolFeeClassifications as $classification)
<div class="modal fade" id="deleteSchoolFeeClassificationModal-{{ $classification->id }}" tabindex="-1" aria-labelledby="deleteSchoolFeeClassificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('school-fee-classifications.delete', $classification->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete Classification: <strong>{{ $classification->name }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
