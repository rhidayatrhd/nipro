<div class="modal-content">
    <form action="{{ $section->id ? route('section.update', $section->id) : route('section.store') }}" method="post" id="formSectionAction">
        @csrf
        @if($section->id)
        @method('put')
        @endif
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Section of Department Menu</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <label for="dept" class="form-label">Select Department</label>
                    @if($section->id)
                    <select name="dept_id" id="dept_id" class="form-select bg-light">
                        <option value="{{ $section->dept_id }}" selected>{{ $section->departments->name }}</option>
                    </select>
                    @else
                    <select name="dept_id" id="dept_id" class="form-select" required>
                        <option value="-1" selected></option>
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
            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="codename" class="form-label">Section Code</label>
                        <input type="text" placeholder="Section Code" value="{{ $section->code }}" class="form-control" name="code" id="codename">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="deptname" class="form-label">Section Name</label>
                        <input type="text" placeholder="Section name" value="{{ $section->name }}" class="form-control" name="name" id="deptname">
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