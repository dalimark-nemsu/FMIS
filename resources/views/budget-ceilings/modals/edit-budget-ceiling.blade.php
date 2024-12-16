<!-- Edit Budget Ceiling Modal -->
<div class="modal fade edit-budget-ceiling-modal" id="editBudgetCeilingModal-{{$budgetCeiling->id}}" tabindex="-1" aria-labelledby="editBudgetCeilingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBudgetCeilingModalLabel">Edit Budget Ceiling ({{ $campus->name }} Campus)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('budget-ceilings.update',  $budgetCeiling->id) }}" method="POST" id="editBudgetCeilingForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="editFundSource" class="form-label text-muted">Fund Source</label>
                            <select class="form-select edit-fund-source" name="fundSource" id="edit_fund_source">
                                @foreach ($fundSources as $fundSource)
                                    <option value="{{ $fundSource->id }}" data-abbreviation="{{ $fundSource->abbreviation }}"
                                        @if ($fundSource->id == $budgetCeiling->programActivityProject->fundSource->id) selected @endif>
                                        {{ $fundSource->abbreviation }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="editMFO" class="form-label text-muted">Major Final Output (MFO)</label>
                            <select class="form-select edit-mfo" name="mfo" id="edit_mfo">
                                {{-- @foreach ($mfos as $mfo)
                                    <option value="{{ $mfo->id }}"
                                        @if ($mfo->id == $budgetCeiling->programActivityProject->majorFinalOutput->id) selected @endif>
                                        {{ $mfo->abbreviation }}
                                    </option>
                                @endforeach --}}
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="editPap" class="form-label text-muted">PAP</label>
                            <select class="js-example-basic-single js-states form-control edit-pap" name="pap" id="edit_pap">
                                @foreach ($paps as $pap)
                                    <option value="{{ $pap->id }}"
                                        @if ($pap->id == $budgetCeiling->programActivityProject->id) selected @endif>
                                        {{ $pap->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="editPs" class="form-label text-muted">PS</label>
                            <div class="input-group">
                                <span class="input-group-text">&#8369</span>
                                <input type="text" class="form-control edit-ps" id="edit_ps" name="ps" value="{{ number_format($budgetCeiling->ps, 2) }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="editMooe" class="form-label text-muted">MOOE</label>
                            <div class="input-group">
                                <span class="input-group-text">&#8369</span>
                                <input type="text" class="form-control edit-mooe" id="edit_mooe" name="mooe" value="{{ number_format($budgetCeiling->mooe, 2) }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="editCo" class="form-label text-muted">CO</label>
                            <div class="input-group">
                                <span class="input-group-text">&#8369</span>
                                <input type="text" class="form-control edit-co" id="edit_co" name="co" value="{{ number_format($budgetCeiling->co, 2) }}">
                            </div>
                        </div>
                    </div>

                    <!-- Total display -->
                    {{-- <div class="row mt-4">
                        <div class="col-md-12 text-end">
                            <label for="editTotal" class="form-label fs-5 fw-bold">Total: &#8369</label>
                            <span id="edit_total" class="fs-5 fw-bold edit-total" name="total">{{ number_format($budgetCeiling->ps + $budgetCeiling->mooe + $budgetCeiling->co, 2) }}</span>
                    </div> --}}

                    <div class="row mt-4">
                        <div class="col-md-12 text-end d-flex justify-content-end align-items-center">
                            <label for="editTotal" class="form-label fs-5 fw-bold me-2 mb-0" style="line-height: 1;">Total</label>
                            <div class="input-group" style="max-width: 245px;">
                                <span class="input-group-text fs-5 fw-bold">&#8369</span>
                                <input type="text" id="edit_total" name="total" class="form-control fs-5 fw-bold edit-total" disabled placeholder="0.00" value="{{ number_format($budgetCeiling->total_amount, 2) }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
