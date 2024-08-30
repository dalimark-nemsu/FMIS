@extends('layouts.app')

@section('page-title', 'Units')

@section('content')
<div id="app-content">

    <!-- Container fluid -->
    <div class="app-content-area">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
              <!-- Page header -->
              {{-- <div class="mb-5">
                <h3 class="mb-0">Fund Sources</h3>
              </div> --}}
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
                            <a href="#addUnitModal"
                                class="btn btn-outline-primary shadow-sm btn-sm"
                                data-bs-toggle="modal"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Create New Fund Source">
                                <i class="bi bi-plus-circle"></i>
                            </a>
                        </div>

                  </div>
                  <div class="card-body">
                    <div class="table-responsive table-card">
                      <table id="example" class="table text-nowrap table-centered mt-0" style="width: 100%">
                        <thead class="table-light">
                          <tr>
                            <th>No</th>
                            <th>Abbrev.</th>
                            <th>Name</th>
                            <th>Campus</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($units as $unit)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $unit->abbreviation }}</td>
                                    <td>{{ $unit->name }}</td>
                                    <td>{{ $unit->campus?->name }}</td>
                                    <td>
                                        <!-- Edit Button -->
                                        <a href="#editUnitModal-{{$unit->id}}"
                                        class="btn btn-outline-primary btn-sm rounded-circle shadow-sm"
                                        data-bs-toggle="modal"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        <a href="#deleteUnitModal-{{$unit->id}}"
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





<!-- Add Units Modal -->
<div class="modal fade" id="addUnitModal" tabindex="-1" aria-labelledby="addUnitModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUnitModalLabel">Add New Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('units.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="abbrev" class="form-label">Abbreviation:</label>
                        <input type="text" class="form-control" id="abbrev" name="abbrev" placeholder="Enter unit abbreviation" required>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter unit name" required>
                    </div>

                    <div class="mb-3">
                          <label for="campus" class="col-form-label">Campus:</label>
                          <select class="form-select" name="campus_id" id="campus_id">
                              <option value=""> -- Select Campus -- </option>
                              @foreach ($campuses as $campus )
                                  <option value="{{ $campus->id }}">{{ $campus?->name }}</option>
                              @endforeach
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


<!-- Edit Units Modal -->
@foreach ($units as $unit)
<div class="modal fade" id="editUnitModal-{{$unit->id}}" tabindex="-1"
    aria-labelledby="editUnitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUnitModalLabel">Edit Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('units.update', $unit->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="abbrev" class="form-label">Abbreviation:</label>
                        <input type="text" class="form-control" id="abbrev" name="abbrev" value="{{ $unit->abbreviation }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" value="{{ $unit->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="editCampus" class="col-form-label">Campus:</label>
                        <select class="form-select" name="campus_id" id="edit-campus-id" value="{{ $unit->campus?->name }}">
                            @foreach ($campuses as $campus)
                                <option value="{{ $campus->id }}" @if ($unit->campus->id == $campus->id) selected @endif>{{ $campus?->name }}</option>
                            @endforeach
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


<!-- Delete Units Modal -->
@foreach ($units as $unit)
<div class="modal fade" id="deleteUnitModal-{{$unit->id}}" tabindex="-1"
    aria-labelledby="deleteUnitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUnitModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('units.delete', $unit->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    Are you sure to delete Unit: <strong>{{ $unit->name }}</strong> ?
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
