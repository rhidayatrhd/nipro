<div class="modal-content">
    <form action="{{ $permission->id ? route('permission.update', $permission->id) : route('permission.store') }}" method="post" id="formPermissionAction">
        @csrf
        @if($permission->id) 
            @method('put')
        @endif
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Permission Menu</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="permissionname" class="form-label">Permission Name</label>
                        <input type="text" placeholder="Permission name" value="{{ $permission->name }}" class="form-control" name="name" id="permissionname">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="guardname" class="form-label">Guard</label>
                        <input type="text" placeholder="Guard Name" value="{{ $permission->guard_name }}" class="form-control" name="guard_name" id="guardname">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
    </form>
</div>