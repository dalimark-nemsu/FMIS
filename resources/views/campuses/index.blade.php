@extends('layouts.app')

@section('page-title', 'Campuses')

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
                            <a href="#addCampusModal"
                                class="btn btn-outline-primary shadow-sm btn-sm"
                                data-bs-toggle="modal"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Create New Campus">
                                <i class="bi bi-plus-lg"></i>
                            </a>
                        </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive table-card">
                      <table id="example" class="table text-nowrap table-centered mt-0" style="width: 100%">
                        <thead class="table-light">
                          <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($campuses as $campus)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $campus->name }}</td>
                            <td>
                                <!-- Edit Button -->
                                <a href="#editCampusModal-{{$campus->id}}"
                                   class="btn btn-outline-primary btn-sm rounded-circle shadow-sm"
                                   data-bs-toggle="modal"
                                   data-bs-toggle="tooltip"
                                   data-bs-placement="top"
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <!-- Delete Button -->
                                <a href="#deleteCampusModal-{{$campus->id}}"
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





<!-- Add Campus Modal -->
<div class="modal fade" id="addCampusModal" tabindex="-1" aria-labelledby="addCampusModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCampusModalLabel">Add New Campus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('campuses.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter campus name" required>
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


<!-- Edit Campus Modal -->
@foreach ($campuses as $campus)
<div class="modal fade" id="editCampusModal-{{$campus->id}}" tabindex="-1"
    aria-labelledby="editCampusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCampusModalLabel">Edit Campus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('campuses.update', $campus->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-campus-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit-campus-name" name="name" value="{{ $campus->name }}" required>
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


<!-- Delete campus Modal -->
@foreach ($campuses as $campus)
<div class="modal fade" id="deleteCampusModal-{{$campus->id}}" tabindex="-1"
    aria-labelledby="deleteCampusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCampusModalLabel">Delete Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('campuses.delete', $campus->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    Are you sure to delete Campus: <strong>{{ $campus->name }}</strong> ?
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
