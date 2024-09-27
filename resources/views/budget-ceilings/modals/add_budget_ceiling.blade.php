<!-- Add Budget Ceiling Modal -->
<div class="modal fade add-budget-ceiling-modal" id="addBudgetCeilingModal" tabindex="-1" aria-labelledby="addBudgetCeilingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBudgetCeilingModalLabel">Add New Budget Ceiling ({{ $campus->name }} Campus)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('budget-ceilings.store',['campus_id' => $campus->id, 'year_id' => $activeYear->id]) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="fundSource" class="form-label">Fund Source:</label>
                            <select class="form-select" name="fundSource" id="fund_source">
                                <option value="" disabled selected> -- Select Fund Source -- </option>
                                @foreach ($fundSources as $fundSource )
                                    <option value="{{ $fundSource->id }}">{{ $fundSource->abbreviation }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="mfo" class="form-label">MFO:</label>
                            <select class="form-select" name="mfo" id="mfo">
                                <option value="" disabled selected> -- Select Major Final Outputs -- </option>
                                @foreach ($mfos as $mfo )
                                    <option value="{{ $mfo->id }}">{{ $mfo->abbreviation }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="pap" class="form-label">PAP:</label>
                            <select class="js-example-basic-single js-states form-control" name="pap" id="pap">
                                <option value="" disabled selected> -- Select Program, Activity, Projects -- </option>
                                @foreach ($paps as $pap )
                                    <option value="{{ $pap->id }}">{{ $pap->code }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="ps" class="form-label">PS:</label>
                            <input type="text" class="form-control ps" id="ps" name="ps" required>
                        </div>

                        <div class="col-md-6">
                            <label for="mooe" class="form-label">MOOE:</label>
                            <input type="text" class="form-control mooe" id="mooe" name="mooe" required>
                        </div>

                        <div class="col-md-6">
                            <label for="co" class="form-label">CO:</label>
                            <input type="text" class="form-control co" id="co" name="co" required>
                        </div>
                    </div>

                    <!-- Horizontal line to separate inputs from total -->
                    <hr class="my-4">

                    <!-- Total display -->
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <label for="total" class="form-label fs-5 fw-bold">Total: &#8369</label>
                            <span id="total" class="fs-5 fw-bold total">0.00</span> <!-- Default total value as 0 -->
                        </div>
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
