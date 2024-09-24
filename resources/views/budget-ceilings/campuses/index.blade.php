@extends('layouts.app')

@section('page-title', 'Budget Ceiling')

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
                        <div class="flex-grow-1"></div>
                        <div class="mb-3 d-flex align-items-center">
                            <label for="budgetYear" class="col-form-label me-2 text-nowrap">Budget Year:</label>
                            <select class="form-select" name="year" id="year">
                                <option value="" disabled> -- Select Year -- </option>
                                @foreach ($budgetYears as $budgetYear)
                                    <option value="{{ $budgetYear->id }}"
                                        data-active="{{ $budgetYear->is_active }}"
                                        {{ $budgetYear->id == $activeYear->year ? 'selected' : '' }}>
                                        {{ $budgetYear->year }} {{ $budgetYear->is_active ? '(Active)' : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                  <div class="card-body">
                    <div class="table-responsive table-card">
                      <table id="example" class="table text-nowrap table-centered mt-0" style="width: 100%">
                        <thead class="table-light">
                          <tr>
                            <th>No.</th>
                            <th>Campus</th>
                            <th>Amount</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($campuses as $campus)
                                <tr data-campus-id="{{ $campus->id }}" data-year-active="{{ $budgetYears->firstWhere('id', $campus->budget_year_id)->is_active ?? 0 }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $campus->name }}</td>
                                    <td></td>
                                    <td>
                                        <!-- Manage Button -->
                                        <a href="{{ route('show-campus', ['id' => $campus->id]) }}"
                                        class="btn btn-outline-success btn-sm rounded-circle shadow-sm manage-btn d-none"
                                        data-bs-placement="top"
                                        title="Manage">
                                        <i class="bi bi-gear"></i>
                                        </a>

                                        <!-- Show Button -->
                                        <a href="#"
                                        class="btn btn-outline-primary btn-sm rounded-circle shadow-sm show-btn d-none"
                                        data-bs-toggle="modal"
                                        data-bs-placement="top"
                                        title="Show">
                                        <i class="bi bi-eye"></i>
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

<!-- Edit Fund Source Modal -->
{{-- @foreach ($fundSources as $fundSource)
<div class="modal fade" id="editFundSourceModal-{{$fundSource->id}}" tabindex="-1"
    aria-labelledby="editFundSourceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFundSourceModalLabel">Edit Fund Source</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('fund-sources.update', $fundSource->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="abbrev" class="form-label">Abbreviation:</label>
                        <input type="text" class="form-control" id="abbrev" name="abbrev" value="{{ $fundSource->abbreviation }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" value="{{ $fundSource->name }}" required>
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
@endforeach --}}


<!-- Delete Fund Source Modal -->
{{-- @foreach ($fundSources as $fundSource)
<div class="modal fade" id="deleteFundSourceModal-{{$fundSource->id}}" tabindex="-1"
    aria-labelledby="deleteFundSourceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteFundSourceModalLabel">Delete Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('fund-sources.delete', $fundSource->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    Are you sure to delete Fund Source: <strong>{{ $fundSource->abbreviation }}</strong> ?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach --}}

@endsection

@push('page-scripts')
    <script>
        $(document).ready(function() {
            var $yearSelect = $('#year');

            function updateButtons() {
                var $selectedOption = $yearSelect.find('option:selected');
                var isActive = $selectedOption.data('active') === 1;

                // Update button visibility based on the selected year's active status
                $('tbody tr').each(function() {
                    var $row = $(this);
                    var $manageBtn = $row.find('.manage-btn');
                    var $showBtn = $row.find('.show-btn');

                    if (isActive) {
                        $manageBtn.removeClass('d-none');
                        $showBtn.addClass('d-none');
                    } else {
                        $manageBtn.addClass('d-none');
                        $showBtn.removeClass('d-none');
                    }
                });
            }

            // Initialize buttons on page load
            updateButtons();

            // Update buttons when the selection changes
            $yearSelect.on('change', updateButtons);
        });
    </script>
@endpush
