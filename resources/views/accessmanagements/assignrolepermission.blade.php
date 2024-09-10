@extends('layouts.dashmain')

@push('css')
<link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/font/bootstrap-icons.css') }}">
@endpush

@section('content')
<title>Nipro &mdash; {{ $title }}</title>
<div class="main-content">
    <div class="title">
        {{ $menu }} - {{ $title }}
    </div>

    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header role-permission">
                        <div class="row">
                            <div class="col-md-2 mt-3 text-md-left">
                                <label for="filter_role">Select Role Permission</label>
                            </div>
                            <div class="col-md-2">
                                <select name="filter_role" id="filter_role" class="form-select @error('filter_role') is-invalid @enderror ">
                                    <option value="-1" selected></option>
                                    @foreach($roles as $role)
                                    @if(old('role') == $role->id)
                                    <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                    @else
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('filter_role')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-1">
                                <button type="button" name="add_data" id="add_data" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add Role Permission Data"><i class="ti-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="content-wrapper">
                        <div class="table-responsive role_ass">
                            <table id="role_assignment" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Transaction Menu</th>
                                        <th>Role Assigned</th>
                                        <th class="taction">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalRolPermisAction" tabindex="-1" aria-labelledby="modalActionLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
        </div>
    </div>

</div>
@endsection

@push('js')
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    const modal = new bootstrap.Modal($('#modalRolPermisAction'))

    fill_datatable();

    function fill_datatable(filter_role = '') {
        var dataTable = $('#role_assignment').dataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('assignrolepermission.index') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    filter_role: filter_role,
                }
            },
            columns: [{
                    data: 'nname',
                    name: 'nname',
                },
                {
                    data: 'rname',
                    name: 'rname',
                },
                {
                    data: 'action',
                    name: 'action',
                    class: 'taction',
                }
            ]
        });
    }

    function store() {
        $('#formRolePermisAction').on('submit', function(e) {
            e.preventDefault()

            const _form = this
            const formData = new FormData(_form)
            const url = this.getAttribute('action')

            $.ajax({
                method: 'POST',
                url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    modal.hide()
                    window($("#role_assignment").dataTable).ajax.reload()
                },
                error: function(res) {
                    let errors = res.responseJSON?.errors
                    $(_form).find('.text-danger.text-small').remove()
                    if (errors) {
                        for (const [key, value] of Object.entries(errors)) {
                            // $(`[fil_role='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
                            // $(`[fil_menu='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
                            // $(`[fil_submenu='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
                        }
                    }
                    console.log(errors);
                }
            })
        })
    }

    

    $('#add_data').click(function() {
        $.ajax({
            method: 'get',
            url: "{{ route('assignrolepermission.create') }}",
            success: function(res) {
                $('#modalRolPermisAction').find('.modal-dialog').html(res);
                modal.show();
                store();
            }

        })
    });

    $('#role_assignment').on('click', '.action', function() {
        let data = $(this).data()
        let id = data.id
        let jenis = data.jenis

        if (jenis = 'update') {
            // console.log(id);
            $.ajax({
                method: 'get',
                url: `{{ url('accessmanagements/assignrolepermission/') }}/${id}/edit`,
                success: function(res) {
                    // console.log(res)
                    $('#modalRolPermisAction').find('.modal-dialog').html(res)
                    modal.show()
                    store()
                }
            })
        }

    });

    $('#filter_role').on('change', function() {
        var filterval = $('#filter_role').val();
        console.log($('#filter_role').val());
        if (filterval == '-1') {
            $('#filter_role').val('');
            $('#role_assignment').DataTable().destroy();
            fill_datatable();
        } else {
            $('#role_assignment').DataTable().destroy();
            fill_datatable(filterval);
        }
    });
</script>
@endpush