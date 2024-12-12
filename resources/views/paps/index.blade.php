@extends('layouts.app')

{{-- @section('page-title', 'Program, Activity, Projects') --}}
@section('page-title-with-icon')
<span class="text-decoration-none" style="color: #012970;">
    Program, Activity, Projects
</span>
@endsection

@section('page-title-text')
    Program, Activity, Projects
@endsection

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
              <div class="col-6">
                <div class="card my-3 mt-4">
                  <div class="card-header d-md-flex">
                    <div class="flex-grow-1">
                        <h4 class="card-title">General Appropriations Act (GAA)</h4>
                    </div>
                    {{-- <div class="mt-3 mt-md-0">
                        <a href="#addProgramActivityProjectsModal"
                            class="btn btn-outline-primary shadow-sm btn-sm"
                            data-bs-toggle="modal"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Create New Program, Activity, Projects">
                            <i class="bi bi-plus-lg"></i>
                        </a>
                    </div> --}}
                  </div>
                  <div class="card-body p-0">
                    <div class="accordion" id="gaaAccordion">
                        @foreach ($gaa as $budgetType => $subFunds)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-{{ Str::slug($budgetType) }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ Str::slug($budgetType) }}" aria-expanded="false" aria-controls="collapse-{{ Str::slug($budgetType) }}">
                                        {{ $budgetType }}
                                    </button>
                                </h2>
                                <div id="collapse-{{ Str::slug($budgetType) }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ Str::slug($budgetType) }}" data-bs-parent="#gaaAccordion">
                                    <div class="accordion-body">
                                        @foreach ($subFunds as $subFund => $papTypes)
                                            <div class="accordion" id="subFundAccordion-{{ Str::slug($subFund) }}">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="subFund-heading-{{ Str::slug($subFund) }}">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#subFund-collapse-{{ Str::slug($subFund) }}" aria-expanded="false" aria-controls="subFund-collapse-{{ Str::slug($subFund) }}">
                                                            {{ $subFund }}
                                                        </button>
                                                    </h2>
                                                    <div id="subFund-collapse-{{ Str::slug($subFund) }}" class="accordion-collapse collapse" aria-labelledby="subFund-heading-{{ Str::slug($subFund) }}" data-bs-parent="#subFundAccordion-{{ Str::slug($subFund) }}">
                                                        <div class="accordion-body">
                                                            @foreach ($papTypes as $papType => $programs)
                                                                <div class="accordion" id="papTypeAccordion-{{ Str::slug($papType) }}">
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="papType-heading-{{ Str::slug($papType) }}">
                                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#papType-collapse-{{ Str::slug($papType) }}" aria-expanded="false" aria-controls="papType-collapse-{{ Str::slug($papType) }}">
                                                                                {{ $papType }}
                                                                            </button>
                                                                        </h2>
                                                                        <div id="papType-collapse-{{ Str::slug($papType) }}" class="accordion-collapse collapse" aria-labelledby="papType-heading-{{ Str::slug($papType) }}" data-bs-parent="#papTypeAccordion-{{ Str::slug($papType) }}">
                                                                            <div class="accordion-body">
                                                                                <ul>
                                                                                    @foreach ($programs as $program)
                                                                                        <li>{{ $program->name }}</li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="table-responsive table-card">
                        {{-- @foreach ($gaa as $budgetType => $subFunds)
                        <h5>{{ $budgetType }}</h5>
                        @foreach ($subFunds as $subFund => $papTypes)
                        <h6 class="ms-3">{{ $subFund }}</h6>
                        @foreach ($papTypes as $papType => $programs)
                            <h6 class="ms-4">{{ $papType }}</h6>
                            <ul class="ms-5">
                                @foreach ($programs as $program)
                                    <li>{{ $program->name }}</li>
                                @endforeach
                            </ul>
                        @endforeach
                        @endforeach
                        @endforeach --}}
                      {{-- <table id="paps-table" class="table text-nowrap table-centered mt-0" style="width: 100%">
                        <thead class="table-light">
                          <tr>
                            <th>No.</th>
                            <th class="text-center">Code</th>
                            <th>Name</th>
                            <th class="text-center">Fund Source</th>
                            <th class="text-center">Major Final Outputs</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table> --}}
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="card my-3 mt-4">
                  <div class="card-header d-md-flex">
                    <div class="flex-grow-1">
                        <h4 class="card-title">Special Trust Fund (STF)</h4>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="accordion" id="stfAccordion">
                        @foreach ($stf as $budgetType => $subFunds)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-{{ Str::slug($budgetType) }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#stfcollapse-{{ Str::slug($budgetType) }}" aria-expanded="false" aria-controls="stfcollapse-{{ Str::slug($budgetType) }}">
                                        {{ $budgetType }}
                                    </button>
                                </h2>
                                <div id="stfcollapse-{{ Str::slug($budgetType) }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ Str::slug($budgetType) }}" data-bs-parent="#stfAccordion">
                                    <div class="accordion-body">
                                        @foreach ($subFunds as $subFund => $papTypes)
                                            <div class="accordion" id="subFundAccordion-{{ Str::slug($subFund) }}">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="subFund-heading-{{ Str::slug($subFund) }}">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#stfsubFund-collapse-{{ Str::slug($subFund) }}" aria-expanded="false" aria-controls="stfsubFund-collapse-{{ Str::slug($subFund) }}">
                                                            {{ $subFund }}
                                                        </button>
                                                    </h2>
                                                    <div id="stfsubFund-collapse-{{ Str::slug($subFund) }}" class="accordion-collapse collapse" aria-labelledby="subFund-heading-{{ Str::slug($subFund) }}" data-bs-parent="#subFundAccordion-{{ Str::slug($subFund) }}">
                                                        <div class="accordion-body">
                                                            @foreach ($papTypes as $papType => $programs)
                                                                <div class="accordion" id="papTypeAccordion-{{ Str::slug($papType) }}">
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="papType-heading-{{ Str::slug($papType) }}">
                                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#papType-collapse-{{ Str::slug($papType) }}" aria-expanded="false" aria-controls="papType-collapse-{{ Str::slug($papType) }}">
                                                                                {{ $papType }}
                                                                            </button>
                                                                        </h2>
                                                                        <div id="papType-collapse-{{ Str::slug($papType) }}" class="accordion-collapse collapse" aria-labelledby="papType-heading-{{ Str::slug($papType) }}" data-bs-parent="#papTypeAccordion-{{ Str::slug($papType) }}">
                                                                            <div class="accordion-body">
                                                                                <ul>
                                                                                    @foreach ($programs as $program)
                                                                                        <li>{{ $program->name }}</li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="table-responsive table-card">
                        {{-- @foreach ($gaa as $budgetType => $subFunds)
                        <h5>{{ $budgetType }}</h5>
                        @foreach ($subFunds as $subFund => $papTypes)
                        <h6 class="ms-3">{{ $subFund }}</h6>
                        @foreach ($papTypes as $papType => $programs)
                            <h6 class="ms-4">{{ $papType }}</h6>
                            <ul class="ms-5">
                                @foreach ($programs as $program)
                                    <li>{{ $program->name }}</li>
                                @endforeach
                            </ul>
                        @endforeach
                        @endforeach
                        @endforeach --}}
                      {{-- <table id="paps-table" class="table text-nowrap table-centered mt-0" style="width: 100%">
                        <thead class="table-light">
                          <tr>
                            <th>No.</th>
                            <th class="text-center">Code</th>
                            <th>Name</th>
                            <th class="text-center">Fund Source</th>
                            <th class="text-center">Major Final Outputs</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table> --}}
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="card my-3 mt-4">
                  <div class="card-header d-md-flex">
                    <div class="flex-grow-1">
                        <h4 class="card-title">Income Generating Projects (IGP)</h4>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="accordion" id="igpAccordion">
                        @foreach ($gaa as $budgetType => $subFunds)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-{{ Str::slug($budgetType) }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#igpcollapse-{{ Str::slug($budgetType) }}" aria-expanded="false" aria-controls="igpcollapsecollapse-{{ Str::slug($budgetType) }}">
                                        {{ $budgetType }}
                                    </button>
                                </h2>
                                <div id="igpcollapsecollapse-{{ Str::slug($budgetType) }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ Str::slug($budgetType) }}" data-bs-parent="#igpAccordion">
                                    <div class="accordion-body">
                                        @foreach ($subFunds as $subFund => $papTypes)
                                            <div class="accordion" id="igpcollapsesubFundAccordion-{{ Str::slug($subFund) }}">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="subFund-heading-{{ Str::slug($subFund) }}">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#subFund-collapse-{{ Str::slug($subFund) }}" aria-expanded="false" aria-controls="subFund-collapse-{{ Str::slug($subFund) }}">
                                                            {{ $subFund }}
                                                        </button>
                                                    </h2>
                                                    <div id="subFund-collapse-{{ Str::slug($subFund) }}" class="accordion-collapse collapse" aria-labelledby="subFund-heading-{{ Str::slug($subFund) }}" data-bs-parent="#igpsubFundAccordion-{{ Str::slug($subFund) }}">
                                                        <div class="accordion-body">
                                                            @foreach ($papTypes as $papType => $programs)
                                                                <div class="accordion" id="papTypeAccordion-{{ Str::slug($papType) }}">
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="papType-heading-{{ Str::slug($papType) }}">
                                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#papType-collapse-{{ Str::slug($papType) }}" aria-expanded="false" aria-controls="papType-collapse-{{ Str::slug($papType) }}">
                                                                                {{ $papType }}
                                                                            </button>
                                                                        </h2>
                                                                        <div id="papType-collapse-{{ Str::slug($papType) }}" class="accordion-collapse collapse" aria-labelledby="papType-heading-{{ Str::slug($papType) }}" data-bs-parent="#papTypeAccordion-{{ Str::slug($papType) }}">
                                                                            <div class="accordion-body">
                                                                                <ul>
                                                                                    @foreach ($programs as $program)
                                                                                        <li>{{ $program->name }}</li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="table-responsive table-card">
                        {{-- @foreach ($gaa as $budgetType => $subFunds)
                        <h5>{{ $budgetType }}</h5>
                        @foreach ($subFunds as $subFund => $papTypes)
                        <h6 class="ms-3">{{ $subFund }}</h6>
                        @foreach ($papTypes as $papType => $programs)
                            <h6 class="ms-4">{{ $papType }}</h6>
                            <ul class="ms-5">
                                @foreach ($programs as $program)
                                    <li>{{ $program->name }}</li>
                                @endforeach
                            </ul>
                        @endforeach
                        @endforeach
                        @endforeach --}}
                      {{-- <table id="paps-table" class="table text-nowrap table-centered mt-0" style="width: 100%">
                        <thead class="table-light">
                          <tr>
                            <th>No.</th>
                            <th class="text-center">Code</th>
                            <th>Name</th>
                            <th class="text-center">Fund Source</th>
                            <th class="text-center">Major Final Outputs</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table> --}}
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
                        <label for="code" class="form-label text-muted">Code</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="Enter PAPs code" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label text-muted">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter PAPs name" required>
                    </div>
                    <div class="mb-3">
                        <label for="fund-source" class="form-label text-muted">Fund Source</label>
                        <select class="form-select" name="fund_source_id" id="fund_source_id">
                            <option value=""> -- Select Fund Source -- </option>
                            @foreach($fundSources as $fundSource)
                                <option value="{{ $fundSource->id }}">{{ $fundSource->abbreviation }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="major-final-output" class="form-label text-muted">Major Final Outputs</label>
                        <select class="form-select" name="mfo_id" id="mfo_id">
                            <option value=""> -- Select Major Final Outputs -- </option>
                            {{-- @foreach($mfos as $mfo)
                                <option value="{{ $mfo->id }}">{{ $mfo->abbreviation }}</option>
                            @endforeach --}}
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
                        targets: [0, 1, 3], // Index of the column (0-based) you want to center
                        // className: 'text-center', // Apply the 'text-center' class to center the content
                    },
                ],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-start' },
                    // { data: 'code', name: 'code' },
                    { data: 'name', name: 'name', className:'text-start'},
                    { data: 'fund_source_abbrev', name: 'fund_source_abbrev', className:'text-center' },
                    // { data: 'mfos_abbrev', name: 'mfos_abbrev' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                pagingType: 'full_numbers', // or 'simple' for simple pagination
                lengthMenu: [10, 25, 50, 100],
                autoWidth: false
            });
    });
</script>
@endpush
