@extends('layouts.app')

@section('page-title', 'Program, Activity, Projects')

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
                            <a href="#addProgramActivityProjectsModal"
                                class="btn btn-outline-primary shadow-sm btn-sm"
                                data-bs-toggle="modal"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Create New Program, Activity, Projects">
                                <i class="bi bi-plus-lg"></i>
                            </a>
                        </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive table-card">
                      <table id="paps-table" class="table text-nowrap table-centered mt-0" style="width: 100%">
                        <thead class="table-light">
                          <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Code</th>
                            <th class="text-center">Fund Source</th>
                            <th class="text-center">Major Final Outputs</th>
                            <th>Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
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





<!-- Add Program, Activity, Projects Modal -->
<div class="modal fade" id="addProgramActivityProjectsModal" tabindex="-1" aria-labelledby="addProgramActivityProjectsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProgramActivityProjectsModalLabel">Add New Program, Activity, Projects</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('paps.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="code" class="form-label">Code:</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="Enter PAPs code" required>
                    </div>

                    <div class="mb-3">
                        <label for="fund-source" class="form-label">Fund Source:</label>
                        <select class="form-select" name="fund_source_id" id="fund_source_id">
                            <option value=""> -- Select Fund Source -- </option>
                            @foreach($fundSources as $fundSource)
                                <option value="{{ $fundSource->id }}">{{ $fundSource->abbreviation }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="major-final-output" class="form-label">Major Final Outputs:</label>
                        <select class="form-select" name="mfo_id" id="mfo_id">
                            <option value=""> -- Select Major Final Outputs -- </option>
                            @foreach($mfos as $mfo)
                                <option value="{{ $mfo->id }}">{{ $mfo->abbreviation }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter PAPs name" required>
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

@endsection

@push('page-scripts')
<script>
    $(document).ready(function() {
        // Yajra dataTables
        let dataTable = $('#paps-table').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('paps.index') }}", // Default URL
                    type: 'GET'
                },
                columnDefs: [
                    {
                        targets: [0, 1, 2, 3], // Index of the column (0-based) you want to center
                        className: 'text-center', // Apply the 'text-center' class to center the content
                    },
                ],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'code', name: 'code' },
                    { data: 'fund_source_abbrev', name: 'fund_source_abbrev' },
                    { data: 'mfos_abbrev', name: 'mfos_abbrev' },
                    { data: 'name', name: 'name' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                pagingType: 'full_numbers', // or 'simple' for simple pagination
                lengthMenu: [10, 25, 50, 100],
                autoWidth: false
            });
    });
</script>
@endpush
