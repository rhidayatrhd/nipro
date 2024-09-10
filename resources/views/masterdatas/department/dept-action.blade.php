<div class="modal-content">
    <form action="{{ $department->id ? route('department.update', $department->id) : route('department.store') }}" method="post" id="formDepartmentAction">
        @csrf
        @if($department->id)
        @method('put')
        @endif
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Department Menu</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="codename" class="form-label">Department Code</label>
                        @if($department->id)
                        <input type="text" name="code" id="codename" value="{{ $department->code }}" class="form-control" disabled readonly>
                        @else
                        <input type="text" name="code" id="codename" placeholder="Department Code" value="{{ $department->code }}" class="form-control">
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="deptname" class="form-label">Department Name</label>
                        <input type="text" name="name" id="deptname" placeholder="Department name" value="{{ $department->name }}" class="form-control">
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