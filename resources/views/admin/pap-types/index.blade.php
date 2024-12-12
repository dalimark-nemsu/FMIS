@extends('layouts.app')

@section('page-title', 'PAP Types')

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
                            <h5>PAP Types</h5>
                            <div class="ms-auto">
                                <a href="#addPapTypeModal"
                                   class="btn btn-outline-primary shadow-sm btn-sm"
                                   data-bs-toggle="modal"
                                   title="Create New PAP Type">
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
                                            <th>Abbreviation</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($papTypes as $papType)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $papType->abbreviation }}</td>
                                            <td>{{ $papType->name }}</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <a href="#editPapTypeModal-{{ $papType->id }}"
                                                   class="btn btn-outline-primary btn-sm rounded-circle shadow-sm"
                                                   data-bs-toggle="modal"
                                                   title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                <!-- Delete Button -->
                                                <a href="#deletePapTypeModal-{{ $papType->id }}"
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

<!-- Add PAP Type Modal -->
<div class="modal fade" id="addPapTypeModal" tabindex="-1" aria-labelledby="addPapTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('pap-types.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addPapTypeModalLabel">Add New PAP Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="abbreviation" class="form-label">Abbreviation:</label>
                        <input type="text" class="form-control" id="abbreviation" name="abbreviation" placeholder="Enter abbreviation" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
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

<!-- Edit PAP Type Modal -->
@foreach ($papTypes as $papType)
<div class="modal fade" id="editPapTypeModal-{{ $papType->id }}" tabindex="-1" aria-labelledby="editPapTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('pap-types.update', $papType->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editPapTypeModalLabel">Edit PAP Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="abbreviation" class="form-label">Abbreviation:</label>
                        <input type="text" class="form-control" id="abbreviation" name="abbreviation" value="{{ $papType->abbreviation }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $papType->name }}" required>
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

<!-- Delete PAP Type Modal -->
@foreach ($papTypes as $papType)
<div class="modal fade" id="deletePapTypeModal-{{ $papType->id }}" tabindex="-1" aria-labelledby="deletePapTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('pap-types.delete', $papType->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePapTypeModalLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete PAP Type: <strong>{{ $papType->name }}</strong>?
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
