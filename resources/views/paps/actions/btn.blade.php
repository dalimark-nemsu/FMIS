<!-- Edit Button -->
<a class="btn btn-outline-primary btn-sm rounded-circle shadow-sm"
    data-bs-toggle="modal"
    data-bs-target="#editProgramActivityProjectsModal{{ $paps->id }}"
    data-bs-placement="top"
    title="Edit">
        <i class="bi bi-pencil"></i>
</a>

{{-- <a class="btn btn-secondary rounded-circle btn-ghost btn-sm texttooltip"
    data-template="trashOne{{ $cashAdvance->id }}"
    data-bs-toggle="modal"
    data-bs-target="#deleteCashAdvanceModal{{ $cashAdvance->id }}"
    data-id="{{ $cashAdvance->id }}"
    title="Delete">
    <i class="fa fa-trash" aria-hidden="true"></i>
    <div id="trashOne{{ $cashAdvance->id }}" class="tooltip-content d-none">
        <span>Delete</span>
    </div>
</a> --}}

@include('paps.modals.edit-paps')
{{-- @include('modals.delete-cash-advances-modal') --}}
