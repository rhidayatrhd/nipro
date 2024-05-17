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
        {{ $menu }} -
        {{ $title }} 
    </div>
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Computer Data</h4>
                        @if(request()->user()->can('create exportimport/datapc'))
                        <form action="{{ route('import_pc') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="upload col-10">
                                <div class="form-group">
                                    <input type="file" name="pcfile" required="required">
                                </div>
                                <p class="updbtn">
                                    <button class="btn btn-primary bi bi-upload" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Import Computer Data"></button>
                                    <a href="/dashboard" class="btn btn-info btn-cancel bi bi-arrow-clockwise" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Back to Dashboard"></a>
                                    <button type="button" class="btn btn-success ti-plus btn-add" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add Computer Data by Manually"></button>
                                </p>
                            </div>
                        </form>
                        @endif
                    </div>
                    <div class="content-wrapper">

                        <div class="card-body">
                            @if(request()->user()->can('create imports/datapc'))
                            <!-- <button type="button" class="btn btn-primary mb-3 btn-add">Import New Data</button> -->
                            @endif
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalPCAction" tabindex="-1" aria-labelledby="modalActionLabel" aria-hidden="true">
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
    
    const modal = new bootstrap.Modal($('#modalPCAction'))

    $('.btn-add').on('click', function() {
        $.ajax({
            method: 'get',
            url: `{{ url('exportimport/datapc/create') }}`,
            success: function(res) {
                $('#modalPCAction').find('.modal-dialog').html(res)
                modal.show()
                store()
            }
        })
    })

    function store() {
        $('#formPCAction').on('submit', function(e) {
            e.preventDefault()

            // console.log(this);
            const _form = this
            const formData = new FormData(_form)
            const url = this.getAttribute('action')
            console.log(url);

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
                    window.LaravelDataTables["datapc-table"].ajax.reload()
                    modal.hide()
                },
                error: function(res) {
                    let errors = res.responseJSON?.errors
                    $(_form).find('.text-danger.text-small').remove()
                    if (errors) {
                        for (const [key, value] of Object.entries(errors)) {
                            $(`[hostname='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
                            $(`[pctype='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
                        }
                    }
                    console.log(errors);
                }
            })
        })
    }

    $('#datapc-table').on('click', '.action', function() {
        let data = $(this).data()
        let id = data.id
        let jenis = data.jenis

        // console.log(id)
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
                        url: `{{ url('exportimport/datapc/') }}/${id}`,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            window.LaravelDataTables["datapc-table"].ajax.reload()
                            Swal.fire("Deleted!", res.message, res.status)
                        }
                    })
            })
            return
        }

        $.ajax({
            method: 'get',
            url: `{{ url('exportimport/datapc/') }}/${id}/edit`,
            success: function(res) {
                // console.log(res)
                $('#modalPCAction').find('.modal-dialog').html(res)
                modal.show()
                store()
            }
        })
    })
</script>

@endpush