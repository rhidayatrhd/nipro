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
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2 mt-3 text-md-left">
                                <label for="role">Select Role</label>
                            </div>
                            <div class="col-md-2">
                                <select name="filter_role" id="filter_role" class="form-select">
                                    <option value="-1" selected></option>
                                    @foreach($roles as $role)
                                    @if(old('role') == $role->id)
                                    <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                    @else
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <!-- <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <label for="stat">Menu Name</label>
                            </div>
                            <div class="col-md-3">
                                <select name="filter_menu" id="filter_menu" class="form-select">
                                    <option value="-1" selected></option>
                                    @foreach($navigation as $menu)
                                    @if(old('menu') == $menu->id)
                                    <option value="{{ $menu->id }}" selected>{{ $menu->name }}</option>
                                    @else
                                    <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div> -->
                            <div class="col-md-2">
                                <!-- <button type="button" name="get_role" id="get_role" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Get Role Permission Data"><i class="ti-angle-double-down"></i></button> -->
                                <button type="button" name="get_refresh" id="get_refresh" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Refresh Data"><i class="ti-reload"></i></button>
                                <button type="button" name="add_data" id="add_data" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add Role Permission Data"><i class="ti-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="content-wrapper">
                        <div class="table-responsive role_ass">
                            <table id="role_assignment" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Permission Menu</th>
                                        <th>Role</th>
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
                    data: 'pname',
                    name: 'pname',
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
            var filter_role = $('#filter_role').val();
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
                    window($("#role_assignment")).ajax.reload()
                    $('#filter_role').val('')
                    modal.hide()
                },
                error: function(res) {
                    let errors = res.responseJSON?.errors
                    $(_form).find('.text-danger.text-small').remove()
                    if (errors) {
                        for (const [key, value] of Object.entries(errors)) {
                            $(`[fil_menu='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
                            $(`[fil_submenu='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
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
        var filter_role = $('#filter_role').val();

        // console.log(data);
        if (jenis == 'delete') {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(t => {
                t.isConfirmed &&
                    $.ajax({
                        method: 'DELETE',
                        url: `{{ url('accessmanagements/assignrolepermission/') }}/${id}`,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            $('#role_assignment').DataTable().destroy();
                            if (filter_role != '') {
                                fill_datatable(filter_role);
                            } else {
                                $('#filter_role').val('');
                                fill_datatable();
                            }
                            Swal.fire("Role Permission already deleted!", res.message, res.status)
                        }
                    })
            })
            return
        }

    });

    // $('#get_role').click(function() {
    //     var filter_role = $('#filter_role').val();

    //     //  console.log(filter_role);
    //     if (filter_role != '-1') {
    //         $('#role_assignment').DataTable().destroy();
    //         fill_datatable(filter_role);
    //     } else {
    //         alert('Select Role filter option');
    //     }
    // });

    $('#get_refresh').click(function() {
        $('#filter_role').val('');
        $('#role_assignment').DataTable().destroy();
        fill_datatable();
    });

    $('#filter_role').on('change', function() {
        var filterval = $('#filter_role').val();
        // console.log(filterval);
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