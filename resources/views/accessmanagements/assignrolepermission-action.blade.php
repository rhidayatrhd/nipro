<div class="modal-content">
    <form action="{{ route('assignrolepermission.store') }}" method="post" id="formRolePermisAction">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Assign Role Permission Menu</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="fil_menu" class="form-label">Menu Name</label>
                        <select name="fil_menu" id="fil_menu" class="form-select form-control">
                            <option value="-1" selected>Select Menu</option>
                            @foreach(getmenus() as $menu)
                            @if(old('menu') == $menu->id)
                            <option value="{{ $menu->id }}" selected>{{ $menu->name }}</option>
                            @else
                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="fil_submenu" class="form-label">Sub Menu</label>
                        <select name="fil_submenu" id="fil_submenu" class="form-select">
                            <option value="-1" selected>Select Submenu</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="opt_access" class="form-label">Assignment Access</label>
                    <div class="row" style="font-size: 12px; margin-top:10px">
                        <div class="col-md-3"><input type="checkbox" value="read" name="oread"> Can Read</div>
                        <div class="col-md-3"><input type="checkbox" value="create" name="ocreate"> Can Create</div>
                        <div class="col-md-3"><input type="checkbox" value="update" name="oupdate"> Can Update</div>
                        <div class="col-md-3"><input type="checkbox" value="delete" name="odelete"> Can Delete</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-primary sm-add" type="submit">Save</button>
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