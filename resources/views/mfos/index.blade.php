@extends('layouts.app')

@section('page-title', 'Major Final Outputs')

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
                            <a href="#addMajorFinalOutputModal"
                                class="btn btn-outline-primary shadow-sm btn-sm"
                                data-bs-toggle="modal"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Create New Major Final Outputs">
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
                            @foreach ($mfos as $mfo)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mfo->abbreviation }}</td>
                            <td>{{ $mfo->name }}</td>
                            <td>
                                <!-- Edit Button -->
                                <a href="#editMajorFinalOutputModal-{{$mfo->id}}"
                                   class="btn btn-outline-primary btn-sm rounded-circle shadow-sm"
                                   data-bs-toggle="modal"
                                   data-bs-toggle="tooltip"
                                   data-bs-placement="top"
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <!-- Delete Button -->
                                <a href="#deleteMajorFinalOutputModal-{{$mfo->id}}"
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





<!-- Add Major Final Outputs Modal -->
<div class="modal fade" id="addMajorFinalOutputModal" tabindex="-1" aria-labelledby="addMajorFinalOutputModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMajorFinalOutputModalLabel">Add New Major Final Output</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('mfos.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="abbrev" class="form-label">Abbreviation:</label>
                        <input type="text" class="form-control" id="abbrev" name="abbrev" placeholder="Enter major final output abbreviation" required>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter major final output name" required>
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


<!-- Edit Major Final Output Modal -->
@foreach ($mfos as $mfo)
<div class="modal fade" id="editMajorFinalOutputModal-{{$mfo->id}}" tabindex="-1"
    aria-labelledby="editMajorFinalOutputModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMajorFinalOutputModalLabel">Edit Major Final Output</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('mfos.update', $mfo->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-abbrev" class="form-label">Abbreviation:</label>
                        <input type="text" class="form-control" id="edit-abbrev" name="abbrev" value="{{ $mfo->abbreviation }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="edit-name" name="name" value="{{ $mfo->name }}" required>
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


<!-- Delete Major Final Output Modal -->
@foreach ($mfos as $mfo)
<div class="modal fade" id="deleteMajorFinalOutputModal-{{$mfo->id}}" tabindex="-1"
    aria-labelledby="deleteMajorFinalOutputModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMajorFinalOutputModalLabel">Delete Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('mfos.delete', $mfo->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    Are you sure to delete Major Final Output: <strong>{{ $mfo->name }}</strong> ?
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
