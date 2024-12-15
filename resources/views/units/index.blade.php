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
                            <th>Campus</th>
                            <th>PAP</th>
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
                                        @foreach ($unit->paps as $pap)
                                            {{ $pap->name }}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <!-- Edit Button -->
                                        <a href="#editUnitModal-{{$unit->id}}"
                                        class="btn btn-outline-primary btn-sm rounded-circle shadow-sm"
                                        data-bs-toggle="modal"
                                        title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <!-- Assign PAP Button -->
                                        <a href="#assignPapModal-{{$unit->id}}"
                                        class="btn btn-outline-success btn-sm rounded-circle shadow-sm"
                                        data-bs-toggle="modal"
                                        title="Assign PAP">
                                            <i class="bi bi-check-circle"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        <a href="#deleteUnitModal-{{$unit->id}}"
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

<!-- Assign PAP Modal -->
@foreach ($units as $unit)
<div class="modal fade" id="assignPapModal-{{$unit->id}}" tabindex="-1"
    aria-labelledby="assignPapModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignPapModalLabel">Assign PAPs to {{ $unit->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('units.assignPap', $unit->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="mb-3">
                        <label for="pap" class="col-form-label">PAP:</label>

                        <!-- Since each modal has a unique ID (such as multiple-select-field-{{ $unit->id }}), you'll need to ensure that the select2 initialization is correctly applied to each individual field. -->
                        {{-- <select class="form-select" id="multiple-select-field-{{$unit->id}}" name="paps[]" data-placeholder="Choose PAP" multiple>
                            @foreach($paps as $pap)
                                <option value="{{ $pap->id }}"
                                    @if($unit->paps->contains($pap->id)) selected @endif>
                                    {{ $pap->abbreviation }} - {{ $pap->name }}
                                </option>
                            @endforeach
                        </select> --}}
                        <select class="form-select" id="multiple-select-field-{{ $unit->id }}" name="paps[]" data-placeholder="Choose PAP" multiple>
                            @foreach ($paps as $fundSource => $budgetTypes)
                                <optgroup label="{{ $fundSource }}">
                                    @foreach ($budgetTypes as $budgetType => $subFunds)
                                        <optgroup label="-- {{ $budgetType }}">
                                            @foreach ($subFunds as $subFund => $papTypes)
                                                <optgroup label="---- {{ $subFund }}">
                                                    @foreach ($papTypes as $papType => $projects)
                                                        <optgroup label="------ {{ $papType }}">
                                                            @foreach ($projects as $pap)
                                                                <option value="{{ $pap->id }}"
                                                                    @if ($unit->paps->contains($pap->id)) selected @endif>
                                                                    {{ $pap->abbreviation ?? '' }} - {{ $pap->name }}
                                                                </option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Assign</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach



@endsection



@push('page-scripts')
    <script>
        $(document).ready(function() {
            // Initialize select2 for each dynamically generated select field
            // The $('select[id^="multiple-select-field-"]') uses a jQuery attribute selector to target all select elements
            // whose id starts with multiple-select-field-. This ensures that the select2 plugin is initialized for all dynamically generated selects in each modal.
            $('select[id^="multiple-select-field-"]').select2({
                theme: "bootstrap-5",
                width: '100%',  // Adjust width as needed
                placeholder: 'Choose PAP',
                closeOnSelect: false
            });
        });
    </script>
@endpush


