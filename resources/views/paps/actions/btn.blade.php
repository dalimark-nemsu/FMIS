<!-- Edit Button -->
<a class="btn btn-outline-primary btn-sm rounded-circle shadow-sm"
    data-bs-toggle="modal"
    data-bs-target="#editProgramActivityProjectsModal{{ $paps->id }}"
    data-bs-toggle="tooltip"
    data-bs-placement="top"
    title="Edit">
        <i class="bi bi-pencil"></i>
</a>

<!-- Delete Button -->
<a class="btn btn-outline-danger btn-sm rounded-circle shadow-sm"
    data-bs-toggle="modal"
    data-bs-target="#deleteProgramActivityProjectsModal{{ $paps->id }}"
    data-bs-toggle="tooltip"
    data-bs-placement="top"
    title="Delete">
     <i class="bi bi-trash"></i>
 </a>



@include('paps.modals.edit-paps', ['fundSources' => $fundSources, 'mfos' => $mfos])
@include('paps.modals.delete-paps')
