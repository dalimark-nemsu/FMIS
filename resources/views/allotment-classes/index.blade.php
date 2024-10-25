@extends('layouts.app')

@section('page-title', 'Allotment Classes')

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
                            <a href="#addAllotmentClassModal"
                                class="btn btn-outline-primary shadow-sm btn-sm"
                                data-bs-toggle="modal"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Create New Allotment Class">
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
                            @foreach ($allotmentClasses as $allotmentClass)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $allotmentClass->abbreviation }}</td>
                            <td>{{ $allotmentClass->name }}</td>
                            <td>
                                <!-- Edit Button -->
                                <a href="#editAllotmentClassModal-{{$allotmentClass->id}}"
                                   class="btn btn-outline-primary btn-sm rounded-circle shadow-sm"
                                   data-bs-toggle="modal"
                                   data-bs-toggle="tooltip"
                                   data-bs-placement="top"
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <!-- Delete Button -->
                                <a href="#deleteAllotmentClassModal-{{$allotmentClass->id}}"
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





<!-- Add Allotment Class Modal -->
<div class="modal fade" id="addAllotmentClassModal" tabindex="-1" aria-labelledby="addAllotmentClassModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAllotmentClassModalLabel">Add New Allotment Class</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('allotment-classes.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="abbrev" class="form-label">Abbreviation:</label>
                        <input type="text" class="form-control" id="abbrev" name="abbrev" placeholder="Enter allotment class abbreviation" required>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter allotment class name" required>
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


<!-- Edit Allotment Class Modal -->
@foreach ($allotmentClasses as $allotmentClass)
<div class="modal fade" id="editAllotmentClassModal-{{$allotmentClass->id}}" tabindex="-1"
    aria-labelledby="editAllotmentClassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAllotmentClassModalLabel">Edit Allotment Class</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('allotment-classes.update', $allotmentClass->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="abbrev" class="form-label">Abbreviation:</label>
                        <input type="text" class="form-control" id="abbrev" name="abbrev" value="{{ $allotmentClass->abbreviation }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" value="{{ $allotmentClass->name }}" required>
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


<!-- Delete Allotment Class Modal -->
@foreach ($allotmentClasses as $allotmentClass)
<div class="modal fade" id="deleteAllotmentClassModal-{{$allotmentClass->id}}" tabindex="-1"
    aria-labelledby="deleteAllotmentClassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAllotmentClassModalLabel">Delete Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('allotment-classes.delete', $allotmentClass->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    Are you sure to delete Allotment Class: <strong>{{ $allotmentClass->name }}</strong> ?
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
