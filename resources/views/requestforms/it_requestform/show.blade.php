    <div class="modal-content pdf-display">
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">{{ $it_requestform->form_name }}</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @if($it_requestform->form_link)
            <embed src="{{ asset('storage/' . $it_requestform->form_link) }}" class="img-preview img-fluid mb-2 form-control d-block" type="application/pdf">
            @endif
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
        </div>
    </div>