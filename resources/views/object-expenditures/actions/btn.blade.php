

<!-- Edit Button -->
<a class="btn btn-outline-primary btn-sm rounded-circle shadow-sm"
    data-bs-toggle="modal"
    data-bs-target="#editObjectExpenditureModal{{ $objectExpenditure->id }}"
    data-bs-toggle="tooltip"
    data-bs-placement="top"
    title="Edit">
        <i class="bi bi-pencil"></i>
</a>

<!-- Delete Button -->
<a class="btn btn-outline-danger btn-sm rounded-circle shadow-sm"
    data-bs-toggle="modal"
    data-bs-target="#deleteObjectExpenditureModal{{ $objectExpenditure->id }}"
    data-bs-toggle="tooltip"
    data-bs-placement="top"
    title="Delete">
     <i class="bi bi-trash"></i>
 </a>






<!-- Edit Object Expenditure Modal -->
<div class="modal fade" id="editObjectExpenditureModal{{ $objectExpenditure->id }}" tabindex="-1" aria-labelledby="editObjectExpenditureModalLabel{{ $objectExpenditure->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editObjectExpenditureModalLabel{{ $objectExpenditure->id }}">Edit Object of Expenditure</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('object-expenditures.update', $objectExpenditure->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="uacs_code" class="form-label">UACS Code:</label>
                        <input type="text" class="form-control" id="uacs_code" name="uacs_code" placeholder="Enter UACS code" value="{{ $objectExpenditure->uacs_code }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="allotment_class_id" class="form-label">Allotment Class:</label>
                        <select class="form-select" name="allotment_class_id" id="allotment_class_id" required>
                            <option value=""> -- Select Allotment Class -- </option>
                            @foreach($allotmentClasses as $allotmentClass)
                                <option value="{{ $allotmentClass->id }}" @if ($objectExpenditure->allotment_class_id == $allotmentClass->id) selected @endif>
                                    {{ $allotmentClass->abbreviation }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="short_description" class="form-label">Short Description:</label>
                        <input type="text" class="form-control" id="short_description" name="short_description" placeholder="Enter short description" value="{{ $objectExpenditure->short_description }}" required>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" @if($objectExpenditure->is_active) checked @endif>
                        <label class="form-check-label" for="is_active">Active</label>
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


<!-- Delete Object Expenditure Modal -->
<div class="modal fade" id="deleteObjectExpenditureModal{{$objectExpenditure->id}}" tabindex="-1"
    aria-labelledby="deleteObjectExpenditureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteObjectExpenditureModalLabel">Delete Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('object-expenditures.delete', $objectExpenditure->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    Are you sure to delete Object Expenditure: <strong>{{ $objectExpenditure->short_description }}</strong> ?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
