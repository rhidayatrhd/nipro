<div class="modal-content">
    @foreach($datapc as $d)
    {{ $d }}
    <div class="modal fade">
        <div class="modal-dialog modal-lg">
            <form action="/" method="post" id="formUpdatePCAction">

                <div class="modal-header">
                    <h5 class="modal-title" id="largeModalLabel">Import PC Data</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    <input type="text" value="{{ $d->pchost }}" hidden>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="datapcfile" class="form-label">Select file</label>
                                <div class="form-group">
                                    <input type="file" placeholder="Select file.." name="datafile" required="required">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Import</button>
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>

    @endforeach




</div>