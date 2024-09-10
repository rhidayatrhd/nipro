<div class="modal-content">
    <form action="{{ $sap_userguide->id ? route('sap_userguide.update', $sap_userguide->id) : route('sap_userguide.store') }}" method="post" id="formUserGuidesAction">
        @csrf
        @if($sap_userguide->id)
        @method('put')
        @endif
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">SAP User Guide Menu</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="module">SAP Module</label>
                            @if($sap_userguide->id)
                            <select name="module" id="module" class="form-select bg-light">
                                <option value="{{ $sap_userguide->module }}" selected>{{ $sap_userguide->module }}</option>
                            </select>
                            @else
                            <select name="module" id="module" class="form-select form-control" required>
                                <option value="" selected>Select SAP Module</option>
                                <option value="1">Sales Distribution (SD)</option>
                                <option value="2">Material Management (MM)</option>
                                <option value="3">Production Planning (PP)</option>
                                <option value="4">Quality Management (QM)</option>
                                <option value="5">Finance (FI)</option>
                                <option value="6">Costing (CO)</option>
                            </select>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="guideno">User Guide Number</label>
                            <input type="text" name="guideno" id="guideno" placeholder="Input name" value="{{ $sap_userguide->guideno }}" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="submodule">SAP Module Area</label>
                            <input type="text" name="submodule" id="submodule" placeholder="Input name" value="{{ $sap_userguide->submodule }}" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 mb-3">
                            <label for="modulename">User Guide Name</label>
                            <input type="text" name="modulename" id="modulename" placeholder="Input number" value="{{ $sap_userguide->modulename }}" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="moduledesc">User Guide Description</label>
                            <textarea name="moduledesc" id="moduledesc" type="text" placeholder="Fill the user guide description" value="{{ $sap_userguide->moduledesc }}" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row p-2">
                        <label for="formlink" class="form-label">Get Link File</label>
                        @if($sap_userguide->id)
                        <input type="hidden" name="oldformlink" value="{{ $sap_userguide->formlink }}">
                        @endif
                        @if($sap_userguide->formlink)
                        <embed src="{{ asset('storage/' . $sap_userguide->formlink) }}" class="img-preview img-fluid mb-2 form-control d-block"></embed>
                        @else
                        <embed class="img-preview img-fluid mb-2 form-control d-block" type="application/pdf">
                        @endif
                        <input type="file" class="form-control" name="formlink" id="formlink" onchange="previewPDF()">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="submit">Save</button>
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    });

    function previewPDF() { 
        const image = document.querySelector('#formlink');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
     }
</script>