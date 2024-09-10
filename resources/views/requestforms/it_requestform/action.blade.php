<div class="modal-content">
    <form action="{{ $it_requestform->id ? route('it_requestform.update', $it_requestform->id) : route('it_requestform.store') }}" method="post" id="formRequestFormAction">
        @csrf
        @if($it_requestform->id)
        @method('put')
        @endif
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Form Request Menu</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="deptname" class="form-label">Department</label>
                        @if($it_requestform->id)
                        <select name="dept_id" id="dept_id" class="form-select" disabled>
                            <option value="{{ $it_requestform->dept_id }}" selected>{{ $it_requestform->departments->name }}</option>
                        </select>
                        @else
                        <select name="dept_id" id="dept_id" class="form-select form-control">
                            <option value="-1" selected>Select Department</option>
                            @foreach($department as $dept)
                            @if(old('dept') == $dept->id)
                            <option value="{{ $dept->id }}" selected>{{ $dept->name }}</option>
                            @else
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endif
                            @endforeach
                        </select>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="form_d" class="form-label">Form Request Number</label>
                        @if($it_requestform->id)
                        <input type="text" value="{{ $it_requestform->form_id }}" disabled readonly class="form-control">
                        @else
                        <input type="text" placeholder="Fill form request number" class="form-control" name="form_id" id="form_id">
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="mb-3">
                            <label for="formname" class="form-label">Form Request Name</label>
                            <input type="text" placeholder="Fill form request name" value="{{ $it_requestform->form_name }}" class="form-control" name="form_name" id="form_name">
                        </div>
                        <div class="mb-3">
                            <label for="formdesc" class="form-label">Form Request Description</label>
                            <textarea type="text" placeholder="Fill the form request description" value="{{ $it_requestform->formdesc }}" class="form-control requestform" name="form_desc" id="form_desc"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <label for="pdf" class="form-label">Get File Link</label>
                        @if($it_requestform->id)
                        <input type="hidden" name="oldform_link" value="{{ $it_requestform->form_link }}">
                        @endif
                        @if($it_requestform->form_link)
                        <embed src="{{ asset('storage/' . $it_requestform->form_link) }}" class="img-preview img-fluid mb-2 col-sm-5 form-control d-block"></embed>
                        @else
                        <!-- <embed src="{{ asset('assets/images/test.pdf') }}" type="application/pdf" frameborder="0" width="100%" height="300px"> -->
                        <!-- <embed class="img-preview" type="application/pdf" frameborder="0"></embed> -->
                        <embed class="img-preview img-fluid mb-2 col-sm-5 form-control d-block" type="application/pdf">
                        @endif
                        <input type="file" class="form-control" name="form_link" id="form_link" onchange="previewPDF()">
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
    })

    function previewPDF() {
        const image = document.querySelector('#form_link');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>