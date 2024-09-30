<!-- Edit Budget Ceiling Modal -->
<div class="modal fade edit-budget-ceiling-modal" id="editBudgetCeilingModal-{{$budgetCeiling->id}}" tabindex="-1" aria-labelledby="editBudgetCeilingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBudgetCeilingModalLabel">Edit Budget Ceiling ({{ $campus->name }} Campus)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('budget-ceilings.update', ['budget_ceiling' => 'placeholder_budget_ceiling_id']) }}" method="POST" id="editBudgetCeilingForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="editFundSource" class="form-label">Fund Source</label>
                            <select class="form-select edit-fund-source" name="fundSource" id="edit_fund_source">
                                @foreach ($fundSources as $fundSource)
                                    <option value="{{ $fundSource->id }}"
                                        @if ($fundSource->id == $budgetCeiling->programActivityProject->fundSource->id) selected @endif>
                                        {{ $fundSource->abbreviation }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="editMFO" class="form-label">Major Final Output (MFO)</label>
                            <select class="form-select edit-mfo" name="mfo" id="edit_mfo">
                                @foreach ($mfos as $mfo)
                                    <option value="{{ $mfo->id }}"
                                        @if ($mfo->id == $budgetCeiling->programActivityProject->majorFinalOutput->id) selected @endif>
                                        {{ $mfo->abbreviation }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="editPap" class="form-label">PAP</label>
                            <select class="js-example-basic-single js-states form-control edit-pap" name="pap" id="edit_pap">
                                @foreach ($paps as $pap)
                                    <option value="{{ $pap->id }}"
                                        @if ($pap->id == $budgetCeiling->programActivityProject->id) selected @endif>
                                        {{ $pap->code }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="editPs" class="form-label">PS</label>
                            <input type="text" class="form-control edit-ps" id="edit_ps" name="ps" value="{{ number_format($budgetCeiling->ps, 2) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="editMooe" class="form-label">MOOE</label>
                            <input type="text" class="form-control edit-mooe" id="edit_mooe" name="mooe" value="{{ number_format($budgetCeiling->mooe, 2) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="editCo" class="form-label">CO</label>
                            <input type="text" class="form-control edit-co" id="edit_co" name="co" value="{{ number_format($budgetCeiling->co, 2) }}" required>
                        </div>
                    </div>

                    <!-- Total display -->
                    <div class="row mt-4">
                        <div class="col-md-12 text-end">
                            <label for="editTotal" class="form-label fs-5 fw-bold">Total: &#8369</label>
                            <span id="edit_total" class="fs-5 fw-bold edit-total">{{ number_format($budgetCeiling->ps + $budgetCeiling->mooe + $budgetCeiling->co, 2) }}</span>
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
