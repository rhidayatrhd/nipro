<div class="modal-content">
    <form action="{{ $role->id ? route('role.update', $role->id) : route('role.store') }}" method="post" id="formRoleAction">
        @csrf
        @if($role->id)
            @method('put') 
        @endif 
        <div class="modal-header"> 
            <h5 class="modal-title" id="largeModalLabel">Role Menu</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="rolename" class="form-label">Role Name</label>
                        <input type="text" placeholder="Role name" value="{{ $role->name }}" class="form-control" name="name" id="rolename">
                    </div>
                </div>
                <div class="col-md-6"> 
                    <div class="mb-3">
                        <label for="guardname" class="form-label">Guard</label>
                        <input type="text" placeholder="Guard name" value="{{ $role->guard_name }}" class="form-control" name="guard_name" id="guardname">
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