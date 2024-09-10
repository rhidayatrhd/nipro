<div class="modal-content">
    <form action="{{ $id ? route('assignrolepermission.update', $id) : route('assignrolepermission.store') }}" method="post" id="formRolePermisAction">
        @csrf
        @if($id)
        @method('put')
        @endif
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Assign Role Navigation Permission Menu</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="fil_role" class="form_label">Role Name</label>
                        @if($id)
                        <select name="fil_role" id="fil_role" class="form-select bg-light">
                            @foreach($roles as $rol)
                            <option value="{{ $rol->id }}" selected>{{ $rol->name }}</option>
                            @endforeach
                        </select>
                        @else
                        <select id="fil_role" name="fil_role" class="form-select" required>
                            <option value="" selected>Select Role</option>
                            @foreach($roles as $role)
                            @if(old('fil_role') == $role->id)
                            <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                            @else
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endif
                            @endforeach
                        </select>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="fil_menu" class="form-label">Menu Name</label>
                        @if($id)
                        <select name="fil_menu" id="fil_menu" class="form-select bg-light">
                            @foreach($navigate as $nav)
                            @foreach(getmenus() as $menu)
                            @if($menu->id == $nav->main_menu)
                            <option value="{{ $menu->id }}" selected>{{ $menu->name }}</option>
                            @endif
                            @endforeach
                            @endforeach
                        </select>
                        @else
                        <select name="fil_menu" id="fil_menu" class="form-select" required>
                            <option value="" selected>Select Menu</option>
                            @foreach(getmenus() as $menu)
                            @if(old('menu') == $menu->id)
                            <option value="{{ $menu->id }}" selected>{{ $menu->name }}</option>
                            @else
                            @if($menu->sort != 1)
                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                            @endif
                            @endif
                            @endforeach
                        </select>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="fil_submenu" class="form-label">Sub Menu</label>
                        @if($id)
                        <select name="fil_submenu" id="fil_submenu" class="form-select bg-light">
                            @foreach($navigate as $nav)
                            <option value="{{ $nav->id }}" selected>{{ $nav->name }}</option>
                            @endforeach
                        </select>
                        @else
                        <select name="fil_submenu" id="fil_submenu" class="form-select" required>
                            <option value="" selected>Select Submenu</option>
                        </select>
                        @error('fil_submenu')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @endif
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="opt_access" class="form-label">Assignment Access</label>
                    <div class="row opt_access" style="font-size: 12px; margin-top:10px">
                        @if($id)
                        @foreach($navigate as $nav)
                        @foreach($permiss as $permis)
                        @if($permis->name == 'read ' . $nav->url)
                        @if(!empty($read[0]))
                        <div class="col-md-3" hidden><input type="checkbox" value="{{ $permis->id }}" name="oread[]" checked> Can Read</div>
                        <div class="col-md-3"><input type="checkbox" value="{{ $permis->id }}" name="read[]" checked> Can Read</div>
                        @else
                        <div class="col-md-3" hidden><input type="checkbox" value="{{ $permis->id }}" name="oread[]"> Can Read</div>
                        <div class="col-md-3"><input type="checkbox" value="{{ $permis->id }}" name="read[]"> Can Read</div>
                        @endif
                        @endif
                        @if($permis->name == 'create ' . $nav->url)
                        @if(!empty($creat[0]))
                        <div class="col-md-3" hidden><input type="checkbox" value="{{ $permis->id }}" name="ocreate[]" checked> Can Create</div>
                        <div class="col-md-3"><input type="checkbox" value="{{ $permis->id }}" name="create[]" checked> Can Create</div>
                        @else
                        <div class="col-md-3" hidden><input type="checkbox" value="{{ $permis->id }}" name="ocreate[]"> Can Create</div>
                        <div class="col-md-3"><input type="checkbox" value="{{ $permis->id }}" name="create[]"> Can Create</div>
                        @endif
                        @endif
                        @if($permis->name == 'update ' . $nav->url)
                        @if(!empty($updat[0]))
                        <div class="col-md-3" hidden><input type="checkbox" value="{{ $permis->id }}" name="oupdate[]" checked> Can Update</div>
                        <div class="col-md-3"><input type="checkbox" value="{{ $permis->id }}" name="update[]" checked> Can Update</div>
                        @else
                        <div class="col-md-3" hidden><input type="checkbox" value="{{ $permis->id }}" name="oupdate[]"> Can Update</div>
                        <div class="col-md-3"><input type="checkbox" value="{{ $permis->id }}" name="update[]"> Can Update</div>
                        @endif
                        @endif
                        @if($permis->name == 'delete ' . $nav->url)
                        @if(!empty($dele[0]))
                        <div class="col-md-3" hidden><input type="checkbox" value="{{ $permis->id }}" name="odelete[]" checked> Can Delete</div>
                        <div class="col-md-3"><input type="checkbox" value="{{ $permis->id }}" name="odelete[]" checked> Can Delete</div>
                        @else
                        <div class="col-md-3" hidden><input type="checkbox" value="{{ $permis->id }}" name="odelete[]"> Can Delete</div>
                        <div class="col-md-3"><input type="checkbox" value="{{ $permis->id }}" name="delete[]"> Can Delete</div>
                        @endif
                        @endif
                        @endforeach
                        @endforeach
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary sm-add" type="submit">Save</button>
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $xrole = '';
        $('#fil_role').on('change', function() {
            $xrole = this.value;
        });
        $('#fil_menu').on('change', function() {
            var menuid = this.value;
            // console.log(menuid);
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

        $('#fil_submenu').on('change', function() {
            $xsub = this.value;
            var menuid = this.value;
            var id = $xrole + ';' + $xsub;
            const _Row = $('.opt_access').html;
            // console.log(id);
            // if (!empty($xrole || !empty($xsub))) {
            // console.log(id);
            //         modal.hide;
            $.ajax({
                url: `{{ Route('getPermisItems') }}?sub_menu=` + menuid,
                type: 'get',
                success: function(res) {
                    var xcheck = $('.opt_access').html('');
                    $.each(res, function(key, value) {
                        var xx = value.name.split(' ');
                        if (xx[0] == 'read') {
                            $(xcheck).append('<div class="col-md-3"><input type="checkbox" value="' + value.id + '" name="read[]"> Can Read' + '</div>');
                        }
                        if (xx[0] == 'create') {
                            $(xcheck).append('<div class="col-md-3"><input type="checkbox" value="' + value.id + '" name="create[]"> Can Create' + '</div>');
                        }
                        if (xx[0] == 'update') {
                            $(xcheck).append('<div class="col-md-3"><input type="checkbox" value="' + value.id + '" name="update[]"> Can Update' + '</div>');
                        }
                        if (xx[0] == 'delete') {
                            $(xcheck).append('<div class="col-md-3"><input type="checkbox" value="' + value.id + '" name="delete[]"> Can Delete' + '</div>');
                        }
                    });
                }
            })
            // }

        });

    });
</script>