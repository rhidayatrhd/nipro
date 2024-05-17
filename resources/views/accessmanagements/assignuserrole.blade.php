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
                        <div class="row">
                            <div class="col-md-2 mt-2"><label for="dept">Select Department</label></div>
                            <div class="col-md-3">
                                <select name="dept" id="dept" class="form-select">
                                    <option value="" selected></option>
                                    <option value="Accounting">Accounting</option>
                                    <option value="Human Resource General Affairs">Human Resource General Affairs</option>
                                    <option value="Production 1">Production 1</option>
                                    <option value="Production 2">Production 2</option>
                                    <option value="Production 3">Production 3</option>
                                    <option value="Production 4">Production 4</option>
                                    <option value="Material">Material</option>
                                    <option value="Quality Assurance Quality Control">Quality Assurance Quality Control</option>
                                    <option value="Utility">Utility</option>
                                    <option value="Sales">Sales</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="button" name="get_userrole" id="get_userrole" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Get User Role Assignment Data"><i class="ti-angle-double-down"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">{{ $dataTable->table() }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUserRoleAction" tabindex="-1" aria-labelledby="modalActionLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">

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

{{ $dataTable->scripts() }}

<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    const modal = new bootstrap.Modal($('#modalUserRoleAction'))

    $('#get_userrole').on('click', function() {
        var filter_dept = $('#dept').val();

        console.log(filter_dept);
        if (filter_dept != '') {
            window.LaravelDataTables["userrole-table"].ajax.reload(filter_dept = filter_dept)
        }
    })

    $('#dept').change(function() {
        var dept_sel = $('#dept').val()

        if (dept_sel != '') {
            console.log('Data ada neeh');
        }

    })

    // function store() {
    //     $('#formPCAction').on('submit', function(e) {
    //         e.preventDefault()

    //         // console.log(this);
    //         const _form = this
    //         const formData = new FormData(_form)
    //         const url = this.getAttribute('action')
    //         console.log(url);

    //         $.ajax({
    //             method: 'POST',
    //             url,
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             data: formData,
    //             processData: false,
    //             contentType: false,
    //             success: function(res) {
    //                 window.LaravelDataTables["datapc-table"].ajax.reload()
    //                 modal.hide()
    //             },
    //             error: function(res) {
    //                 let errors = res.responseJSON?.errors
    //                 $(_form).find('.text-danger.text-small').remove()
    //                 if (errors) {
    //                     for (const [key, value] of Object.entries(errors)) {
    //                         $(`[hostname='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
    //                         $(`[pctype='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
    //                     }
    //                 }
    //                 console.log(errors);
    //             }
    //         })
    //     })
    // }

    // $('#datapc-table').on('click', '.action', function() {
    //     let data = $(this).data()
    //     let id = data.id
    //     let jenis = data.jenis

    //     // console.log(id)
    //     if (jenis == 'delete') {
    //         Swal.fire({
    //             title: "Are you sure?",
    //             text: "You won't be able to revert this!",
    //             icon: "warning",
    //             showCancelButton: !0,
    //             confirmButtonColor: "#3085d6",
    //             cancelButtonColor: "#d33",
    //             confirmButtonText: "Yes, delete it!"
    //         }).then(t => {
    //             t.isConfirmed &&
    //                 $.ajax({
    //                     method: 'DELETE',
    //                     url: `{{ url('imports/datapc/') }}/${id}`,
    //                     headers: {
    //                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                     },
    //                     success: function(res) {
    //                         window.LaravelDataTables["datapc-table"].ajax.reload()
    //                         Swal.fire("Deleted!", res.message, res.status)
    //                     }
    //                 })
    //         })
    //         return
    //     }

    //     $.ajax({
    //         method: 'get',
    //         url: `{{ url('imports/datapc/') }}/${id}/edit`,
    //         success: function(res) {
    //             // console.log(res)
    //             $('#modalPCAction').find('.modal-dialog').html(res)
    //             modal.show()
    //             store()
    //         }
    //     })
    // })
</script>

@endpush