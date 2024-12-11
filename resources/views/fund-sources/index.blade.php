@extends('layouts.app')

@section('page-title', 'Fund Sources')

@section('content')
<div id="app-content">
    <!-- Container fluid -->
    <div class="app-content-area">
        <div class="container-fluid">
            @include('message.success')
            @include('message.error')

            <!-- Row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-md-flex border-bottom-0">
                            <h5>Fund Sources</h5>
                            <div class="ms-auto">
                                <a href="#addFundSourceModal"
                                   class="btn btn-outline-primary shadow-sm btn-sm"
                                   data-bs-toggle="modal"
                                   title="Create New Fund Source">
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
                                            <th>Abbrev.</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fundSources as $fundSource)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $fundSource->abbreviation }}</td>
                                            <td>{{ $fundSource->name }}</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <a href="#editFundSourceModal-{{ $fundSource->id }}"
                                                   class="btn btn-outline-primary btn-sm rounded-circle shadow-sm"
                                                   data-bs-toggle="modal"
                                                   title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                <!-- Delete Button -->
                                                <a href="#deleteFundSourceModal-{{ $fundSource->id }}"
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

<!-- Add Fund Source Modal -->
<div class="modal fade" id="addFundSourceModal" tabindex="-1" aria-labelledby="addFundSourceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('fund-sources.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addFundSourceModalLabel">Add New Fund Source</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="abbreviation" class="form-label">Abbreviation:</label>
                        <input type="text" class="form-control" id="abbreviation" name="abbreviation" placeholder="Enter fund source abbreviation" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter fund source name" required>
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
@foreach ($fundSources as $fundSource)
<div class="modal fade" id="editFundSourceModal-{{ $fundSource->id }}" tabindex="-1" aria-labelledby="editFundSourceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('fund-sources.update', $fundSource->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editFundSourceModalLabel">Edit Fund Source</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="abbreviation" class="form-label">Abbreviation:</label>
                        <input type="text" class="form-control" id="abbreviation" name="abbreviation" value="{{ $fundSource->abbreviation }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $fundSource->name }}" required>
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

<!-- Delete Fund Source Modal -->
@foreach ($fundSources as $fundSource)
<div class="modal fade" id="deleteFundSourceModal-{{ $fundSource->id }}" tabindex="-1" aria-labelledby="deleteFundSourceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('fund-sources.delete', $fundSource->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteFundSourceModalLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete Fund Source: <strong>{{ $fundSource->abbreviation }}</strong>?
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
