@extends('layouts.app')

@section('page-title', 'SubFunds')

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
                            <h5>SubFunds</h5>
                            <div class="ms-auto">
                                <a href="#addSubFundModal" 
                                   class="btn btn-outline-primary shadow-sm btn-sm" 
                                   data-bs-toggle="modal" 
                                   title="Create New SubFund">
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
                                        @foreach ($subFunds as $subFund)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $subFund->fundSource->abbreviation }}</td>
                                            <td>{{ $subFund->name }}</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <a href="#editSubFundModal-{{ $subFund->id }}" 
                                                   class="btn btn-outline-primary btn-sm rounded-circle shadow-sm" 
                                                   data-bs-toggle="modal" 
                                                   title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <!-- Delete Button -->
                                                <a href="#deleteSubFundModal-{{ $subFund->id }}" 
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

<!-- Add SubFund Modal -->
<div class="modal fade" id="addSubFundModal" tabindex="-1" aria-labelledby="addSubFundModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('sub-funds.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New SubFund</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
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
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter SubFund Name" required>
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

<!-- Edit SubFund Modal -->
@foreach ($subFunds as $subFund)
<div class="modal fade" id="editSubFundModal-{{ $subFund->id }}" tabindex="-1" aria-labelledby="editSubFundModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('sub-funds.update', $subFund->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit SubFund</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="fund_source_id" class="form-label">Fund Source:</label>
                        <select class="form-control" id="fund_source_id" name="fund_source_id" required>
                            @foreach ($fundSources as $fundSource)
                                <option value="{{ $fundSource->id }}" {{ $fundSource->id == $subFund->fund_source_id ? 'selected' : '' }}>
                                    {{ $fundSource->abbreviation }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $subFund->name }}" required>
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

<!-- Delete SubFund Modal -->
@foreach ($subFunds as $subFund)
<div class="modal fade" id="deleteSubFundModal-{{ $subFund->id }}" tabindex="-1" aria-labelledby="deleteSubFundModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('sub-funds.delete', $subFund->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete SubFund: <strong>{{ $subFund->name }}</strong>?
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
