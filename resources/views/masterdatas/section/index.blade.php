@extends('layouts.dashmain')

@push('css')
<link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}">
@endpush

@section('content')
<title>Nipro &mdash; {{ $title }}</title>
<div class="main-content">
    <div class="title">{{ $menu }} - {{ $title }}</div>

    <div class="content-wrapper">
        <div class="row same-heiht">
            <div class="col-md-12">
                <div class="card">
                    @if (session()->has('success'))
                    <div class="alert alert-success col-lg-8" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2 mt-1">
                                <label for="dept">Select Department</label>
                            </div>
                            <div class="col-md-3">
                                <select name="dept" id="dept" class="form-select">
                                    <option value="-1" selected></option>
                                    @foreach($dept as $dep)
                                    @if(old('dept') == $dep->id)
                                    <option value="{{ $dep->id }}" selected>{{ $dep->name }}</option>
                                    @else
                                    <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            @if(request()->user()->can('create masterdatas/section'))
                            <div class="col-md-1">
                                <button type="button" name="add_data" id="add_data" class="btn btn-primary btn-add" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add Master Section"><i class="ti-plus"></i></button>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive role_ass">
                            <table id="section_assignment" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <!-- <th style="width: 10px">ID</th> -->
                                        <th>ID</th>
                                        <th>Department</th>
                                        <th>Code</th>
                                        <th>Section</th>
                                        <th class="taction" style="width: 80px;">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalSectionAction" tabindex="-1" aria-labelledby="modalActionLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"></div>
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
    const modal = new bootstrap.Modal($('#modalSectionAction'));
    fill_datatable();

    function fill_datatable(dept = '') {
        var dataTable = $('#section_assignment').dataTable({
            processing: true,
            serviceSide: true,
            ajax: {
                url: "{{ route('section.index') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    dept: dept,
                }
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                    width: '2%',
                },
                {
                    data: 'department',
                    name: 'department',
                },
                {
                    data: 'code',
                    name: 'code',
                },
                {
                    data: 'section',
                    name: 'section',
                },
                {
                    data: 'action',
                    name: 'action',
                    class: 'taction',
                    width: '10%',
                }
            ]
        }).fnSort([[1,'asc']]);
    }

    $('.btn-add').on('click', function() {
        $.ajax({
            method: 'get',
            url: `{{ url('masterdatas/section/create') }}`,
            success: function(res) {
                $('#modalSectionAction').find('.modal-dialog').html(res);
                modal.show();
                store();
            }
        });
    });

    function store() {
        $('#formSectionAction').on('submit', function(e) {
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
                    window.LaravelDataTables["section-table"].ajax.reload()
                    modal.hide()
                    $('.alert.alert-success').html(res.respon.status);
                },
                error: function(res) {
                    let errors = res.responseJSON?.errors
                    $(_form).find('.text-danger.text-small').remove()
                    if (errors) {
                        for (const [key, value] of Object.entries(errors)) {
                            $(`[dept_id='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
                            $(`[code='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
                            $(`[name='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
                        }
                    }
                    console.log(errors);
                }
            })
        })
    }

    $('#section_assignment').on('click', '.action', function() {
        let data = $(this).data()
        let id = data.id
        let jenis = data.jenis

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
                        url: `{{ url('masterdatas/section/') }}/${id}`,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            window.LaravelDataTables["section-table"].ajax.reload()
                            Swal.fire("Deleted!", res.message, res.status)
                        }
                    })
            })
            return
        }

        // console.log(data);
        
        $.ajax({
            method: 'get',
            url: `{{ url('masterdatas/section/') }}/${id}/edit`,
            success: function(res) {
                $('#modalSectionAction').find('.modal-dialog').html(res)
                modal.show()
                store()
            }
        })

    });

    $('#dept').change(function() {
        var filterval = $('#dept').val();

        if (filterval == '-1') {
            $('#dept').val();
            $('#section_assignment').DataTable().destroy();
            fill_datatable();
        } else {
            $('#section_assignment').DataTable().destroy();
            fill_datatable(filterval);
        }
    });
</script>
@endpush