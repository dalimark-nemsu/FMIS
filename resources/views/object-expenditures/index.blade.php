@extends('layouts.app')

@section('page-title', 'Object of Expenditures')

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
                      <table id="objectExpenditure-table" class="table text-nowrap table-centered mt-0" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">UACS Code</th>
                            <th class="text-center">Allotment Class</th>
                            <th class="text-left">Short Description</th> 
                            <th class="text-center">Status</th> 
                            <th class="text-center">Action</th>
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





<!-- Add Object Expenditure Modal -->
<div class="modal fade" id="addProgramActivityProjectsModal" tabindex="-1" aria-labelledby="addProgramActivityProjectsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProgramActivityProjectsModalLabel">Add New Program, Activity, Projects</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('object-expenditures.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="uacs_code" class="form-label">UACS Code:</label>
                        <input type="text" class="form-control" id="uacs_code" name="uacs_code" placeholder="Enter uacs code" required>
                    </div>

                    <div class="mb-3">
                        <label for="allotment_class_id" class="form-label">Allotment Class:</label>
                        <select class="form-select" name="allotment_class_id" id="allotment_class_id" required>
                            <option value=""> -- Select Allotment Class -- </option>
                            @foreach($allotmentClasses as $allotmentClass)
                                <option value="{{ $allotmentClass->id }}">{{ $allotmentClass->abbreviation }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="short_description" class="form-label">Short Description:</label>
                        <input type="text" class="form-control" id="short_description" name="short_description" placeholder="Enter short description" required>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" checked>
                        <label class="form-check-label" for="is_active">Active</label>
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
        let dataTable = $('#objectExpenditure-table').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: "{{ route('object-expenditures.index') }}",
                type: 'GET'
            },
            columnDefs: [
                {
                    targets: [0, 1, 2], // Keep No., Code, and Allotment Class centered
                    className: 'text-center',
                },
                {
                    targets: [3], // Description column is not centered
                    className: 'text-left',
                },
            ],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'code', name: 'code' },
                { data: 'allotment_class_abbrev', name: 'allotment_class_abbrev' },
                { data: 'name', name: 'name' },  // This will display the description without centering
                { data: 'status', name: 'status', render: function(data, type, row) {
                    // Use conditional classes based on the status text
                    return `<span class="badge ${data == 'Active' ? 'bg-success' : 'bg-danger'}">${data}</span>`;
                }},
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            pagingType: 'full_numbers',
            lengthMenu: [10, 25, 50, 100],
            autoWidth: false
        });
    });


</script>
@endpush
