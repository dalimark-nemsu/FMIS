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
                            <label for="fundSource" class="form-label text-muted">Fund Source</label>
                            <select class="form-select add-fund-source" name="fundSource" id="fund_source">
                                <option value="" disabled selected > -- Fund Source -- </option>
                                @foreach ($fundSources as $fundSource )
                                    <option value="{{ $fundSource->id }}" data-abbreviation="{{ $fundSource->abbreviation }}">{{ $fundSource->abbreviation }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="mfo" class="form-label text-muted">MFO</label>
                            <select class="form-select add-mfo" name="mfo" id="mfo">
                                <option value="" disabled selected> -- Select Major Final Outputs -- </option>
                                @foreach ($mfos as $mfo )
                                    <option value="{{ $mfo->id }}">{{ $mfo->abbreviation }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="pap" class="form-label text-muted">PAP</label>
                            <select class="js-example-basic-single js-states form-control add-pap" name="pap" id="pap">
                                <option value="" disabled selected> -- Select Program, Activity, Projects -- </option>
                                @foreach ($paps as $pap )
                                    <option value="{{ $pap->id }}">{{ $pap->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="ps" class="form-label text-muted">PS</label>
                            <div class="input-group">
                                <span class="input-group-text">&#8369</span>
                                <input type="text" class="form-control ps" id="ps" name="ps" disabled placeholder="0.00">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="mooe" class="form-label text-muted">MOOE</label>
                            <div class="input-group">
                                <span class="input-group-text">&#8369</span>
                                <input type="text" class="form-control mooe" id="mooe" name="mooe" disabled placeholder="0.00">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="co" class="form-label text-muted">CO</label>
                            <div class="input-group">
                                <span class="input-group-text">&#8369</span>
                                <input type="text" class="form-control co" id="co" name="co" disabled placeholder="0.00">
                            </div>
                        </div>
                    </div>

                    {{-- <!-- Horizontal line to separate inputs from total -->
                    <hr class="my-4"> --}}

                    <!-- Total display -->
                    <div class="row mt-4">
                        <div class="col-md-12 text-end d-flex justify-content-end align-items-center">
                            <label for="total" class="form-label fs-5 fw-bold me-2 mb-0" style="line-height: 1;">Total</label>
                            <div class="input-group" style="max-width: 245px;">
                                <span class="input-group-text fs-5 fw-bold">&#8369</span>
                                <input type="text" id="total" name="total" class="form-control fs-5 fw-bold total" disabled placeholder="0.00">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
