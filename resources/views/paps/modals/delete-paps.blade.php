<!-- Delete Program, Activity, Projects Modal -->
<div class="modal fade" id="deleteProgramActivityProjectsModal{{ $paps->id }}" tabindex="-1"
    aria-labelledby="deleteProgramActivityProjectsModalLabel{{ $paps->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProgramActivityProjectsModalLabel{{ $paps->id }}">Delete Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('paps.delete', $paps->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    Are you sure to delete Fund Source: <strong>{{ $paps->name }}</strong> ?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
