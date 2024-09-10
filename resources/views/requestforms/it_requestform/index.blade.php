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
        <div class="row same-height">
            <div class="col-md-12">
                <div class="card">
                    @if (session()->has('success'))
                    <div class="alert alert-success col-lg-8" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="card-header">
                        @canany(['create requestforms/it_requestform','admin'])
                        <button type="button" class="btn btn-primary mb-3 btn-add">Add data</button>
                        @endcan
                    </div>
                    <div class="content-wrapper">
                        <div class="card-body">{{ $dataTable->table() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalRequestFormAction" tabindex="-1" aria-labelledby="modalActionLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl"></div>
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
    const modal = new bootstrap.Modal($('#modalRequestFormAction'));

    $('.btn-add').on('click', function() {
        $.ajax({
            method: 'get',
            url: `{{ url('requestforms/it_requestform/create') }}`,
            success: function(res) {
                $('#modalRequestFormAction').find('.modal-dialog').html(res);
                modal.show();
                store();
            }
        })
    });

    function store() {
        $('#formRequestFormAction').on('submit', function(e) {
            e.preventDefault();

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
                    window.LaravelDataTables["formrequest-table"].ajax.reload()
                    modal.hide()
                },
                error: function(res) {
                    let errors = res.responseJSON?.errors;
                    $(_form).find('.text-danger.text-small').remove();
                    if (errors) {
                        for (const [key, value] of Object.entries(errors)) {
                            $(`[dept_id='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`);
                            $(`[form_id='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`);
                            $(`[form_name='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`);
                            $(`[form_link='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`);
                        }
                    }
                    console.log(errors);
                }
            });
        });
    }

    $('#formrequest-table').on('click', '.action', function() {
        let data = $(this).data();
        let id = data.id;
        let jenis = data.jenis;

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
                        url: `{{ url('requestforms/it_requestform/') }}/${id}`,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            window.LaravelDataTables["formrequest-table"].ajax.reload();
                            Swal.fire("Deleted!", res.message, res.status);
                        }
                    });
            });
            return
        }
        if (jenis == 'show') {
            $.ajax({
                method: 'get',
                url: `{{ url('requestforms/it_requestform/') }}/${id}`,
                success: function(res) {
                    $('#modalRequestFormAction').find('.modal-dialog').html(res);
                    modal.show();
                }
            });
            return
        }
        if (jenis == 'update') {
            // console.log(jenis);
            $.ajax({
                method: 'get',
                url: `{{ url('requestforms/it_requestform/') }}/${id}/edit`,
                success: function(res) {
                    $('#modalRequestFormAction').find('.modal-dialog').html(res);
                    modal.show();
                    store();
                }
            });
            return
        }

    });
</script>
@endpush