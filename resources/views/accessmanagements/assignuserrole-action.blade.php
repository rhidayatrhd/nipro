<div class="modal-content">
    <form action="{{ $id ? route('assignuserrole.update', $id) : route('assignuserrole.store') }}" method="post" id="formUserRoleAction">
        @csrf
        @if($id)
        @method('put')
        @endif
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Assign User Role Permission Menu</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fil_menu" class="form-label">User Name</label>
                        <input type="text" name="oname" value="{{ $users->id }}" class="form-control" hidden>
                        <input type="text" name="name" value="{{ $users->name }}" class="form-control" disabled readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fil_menu" class="form-label">Department</label>
                        <input type="text" name="odept" value="{{ $users->departments->id }}" class="form-control" hidden>
                        <input type="text" name="dept" value="{{ $users->departments->name }}" class="form-control" disabled readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <label for="fil_submenu" class="form-label">
                                    <h5>List of Role Permission and User Access</h5>
                                </label>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <label for="fil_submenu" class="form-label text-small  text-bg-success">(Please Checked to Add Permission Or Un-checked to Remove Permission)</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-group" id="listrole" role="tablist">
                                @foreach($roles as $role)
                                @foreach($userroles as $user)
                                @if($role->id === $user->role_id)
                                <li class="list-group-item list-group-item-action">
                                    <div class="d-flex flex-row-reverse justify-content-between">
                                        <input type="checkbox" class="form-check-input me-1" value="{{ $role->id }}" name="oxuser[]" hidden checked>
                                        <input type="checkbox" class="form-check-input me-1" value="{{ $role->id }}" name="xuser[]" checked>
                                        <label for="{{ $role->id }}" class="form-check-label">
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                </li>
                                @break
                                @endif
                                @endforeach
                                @if($role->id !== $user->role_id)
                                <li class="list-group-item list-group-item-action">
                                    <div class="d-flex flex-row-reverse justify-content-between">
                                        <input type="checkbox" class="form-check-input me-1" value="{{ $role->id }}" name="oxuser[]" hidden>
                                        <input type="checkbox" class="form-check-input me-1" value="{{ $role->id }}" name="xuser[]">
                                        <label for="{{ $role->id }}" class="form-check-label">
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary sm-add" type="submit" data-bs-dismiss="modal">Save</button>
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#fil_menu').on('change', function() {
            var menuid = this.value;
            $('#fil_submenu').html('');
            $.ajax({
                url: `{{ Route('getSubmenus') }}?menu_id=` + menuid,
                type: 'get',
                success: function(res) {
                    $('#fil_submenu').html('<option value=""></option>');
                    $.each(res, function(key, value) {
                        $('#fil_submenu').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        });

    });
</script>