<!-- Edit Program, Activity, Projects Modal -->
<div class="modal fade" id="editProgramActivityProjectsModal-{{$paps->id}}" tabindex="-1"
    aria-labelledby="editProgramActivityProjectsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProgramActivityProjectsModalLabel">Edit Program, Activity, Projects</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- <form action="{{ route('paps.update') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-code" class="form-label">Code:</label>
                        <input type="text" class="form-control" id="edit-code" name="code" placeholder="Enter PAPs code" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-fund-source" class="form-label">Fund Source:</label>
                        <select class="form-select" name="fund_source_id" id="edit-fund-source-id">
                            <option value=""> -- Select Fund Source -- </option>
                            @foreach($fundSources as $fundSource)
                                <option value="{{ $fundSource->id }}">{{ $fundSource->abbreviation }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit-major-final-output" class="form-label">Major Final Outputs:</label>
                        <select class="form-select" name="mfo_id" id="edit-mfo-id">
                            <option value=""> -- Select Major Final Outputs -- </option>
                            @foreach($mfos as $mfo)
                                <option value="{{ $mfo->id }}">{{ $mfo->abbreviation }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="edit-name" name="name" placeholder="Enter PAPs name" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form> --}}
        </div>
    </div>
</div>

