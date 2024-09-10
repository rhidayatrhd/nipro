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
    <div class="content-wrapper empty">
        <div class="row same-height">
            <div class="col-md-12">
                <div class="card user-role">
                    <div class="card-header">
                        @if (session()->has('success'))
                        <div class="alert alert-success col-lg-8" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-2 mt-2"><label for="dept">Select Department</label></div>
                            <div class="col-md-3">
                                <select name="dept" id="dept" class="form-select">
                                    <option value="-1" selected></option>
                                    @foreach($dept as $dept)
                                    @if(old('dept') == $dept->id)
                                    <option value="{{ $dept->id }}" selected>{{ $dept->name }}</option>
                                    @else
                                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="content-wrapper">
                        <div class="table-responsive role_ass">
                            <table id="userrole_assignment" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:10px" data-orderable="false">ID</th>
                                        <th>Name</th>
                                        <th>Department</th>
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

    <div class="modal fade" id="modalUserRoleAction" tabindex="-1" aria-labelledby="modalActionLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">

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

    const modal = new bootstrap.Modal($('#modalUserRoleAction'))

    fill_datatable();

    function fill_datatable(dept = '') {
        var dataTable = $('#userrole_assignment').dataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('assignuserrole.index') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    dept: dept,
                }
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                    width: '4%',
                },
                {
                    data: 'name',
                    name: 'name',
                    title: 'User Name',
                },
                {
                    data: 'dept',
                    name: 'dept',
                },
                {
                    data: 'role',
                    name: 'role',
                },
                {
                    data: 'action',
                    name: 'action',
                    class: 'taction',
                }
            ]
        }).fnSort([
            [0, 'asc']
        ]);
    }

    $('#dept').change(function() {
        var filterval = $('#dept').val()

        if (filterval == '-1') {
            $('#dept').val();
            $('#userrole_assignment').DataTable().destroy();
            fill_datatable();
        } else {
            $('#userrole_assignment').DataTable().destroy();
            fill_datatable(filterval);
        }
    });

    $('#userrole_assignment').on('click', '.action', function() {
        let data = $(this).data()
        let id = data.id
        let jenis = data.jenis

        // console.log(id)
        $.ajax({
            method: 'get',
            url: `{{ url('accessmanagements/assignuserrole/') }}/${id}/edit`,
            success: function(res) {
                // console.log(res)
                $('#modalUserRoleAction').find('.modal-dialog').html(res)
                modal.show()
                // store()
            }
        })
    })
</script>

@endpush