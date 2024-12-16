@extends('layouts.app')

@section('page-title', 'Identified Expenses')

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
                            <h5>Identified Expenses</h5>
                            <div class="ms-auto">
                                <a href="#addIdentifiedExpenseModal"
                                   class="btn btn-outline-primary shadow-sm btn-sm"
                                   data-bs-toggle="modal"
                                   title="Create New Identified Expense">
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
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($identifiedExpenses as $expense)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $expense->name }}</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <a href="#editIdentifiedExpenseModal-{{ $expense->id }}"
                                                   class="btn btn-outline-primary btn-sm rounded-circle shadow-sm"
                                                   data-bs-toggle="modal"
                                                   title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                <!-- Delete Button -->
                                                <a href="#deleteIdentifiedExpenseModal-{{ $expense->id }}"
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

<!-- Add Identified Expense Modal -->
<div class="modal fade" id="addIdentifiedExpenseModal" tabindex="-1" aria-labelledby="addIdentifiedExpenseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('identified-expenses.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addIdentifiedExpenseModalLabel">Add New Identified Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Identified Expense Name" required>
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

<!-- Edit Identified Expense Modal -->
@foreach ($identifiedExpenses as $expense)
<div class="modal fade" id="editIdentifiedExpenseModal-{{ $expense->id }}" tabindex="-1" aria-labelledby="editIdentifiedExpenseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('identified-expenses.update', $expense->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editIdentifiedExpenseModalLabel">Edit Identified Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $expense->name }}" required>
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

<!-- Delete Identified Expense Modal -->
@foreach ($identifiedExpenses as $expense)
<div class="modal fade" id="deleteIdentifiedExpenseModal-{{ $expense->id }}" tabindex="-1" aria-labelledby="deleteIdentifiedExpenseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('identified-expenses.delete', $expense->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteIdentifiedExpenseModalLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete Identified Expense: <strong>{{ $expense->name }}</strong>?
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
