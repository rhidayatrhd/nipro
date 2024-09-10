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
                    <div class="card-header">
                        @canany(['create userguides/sap_userguide','admin'])
                        <div class="row">
                            <div class="col-md-2 mt-1">
                                <label for="dept">Covering Area</label>
                            </div>
                            <div class="col-md-3">
                                <select name="cover_area" id="cover_area" class="form-select form-control">
                                    <option value="-1" selected>Select covering User Guide</option>
                                    <option value="1">Accounting Only</option>
                                    <option value="2">Sales Only</option>
                                    <option value="3">Production Only</option>
                                    <option value="4">Purchasing Only</option>
                                    <option value="5">QA & QC Only</option>
                                    <option value="6">Sales</option>
                                    <option value="7">Production</option>
                                    <option value="8">Purchasing</option>
                                </select>
                            </div>

                            <div class="col-md-1">
                                <button type="button" name="add_data" id="add_data" class="btn btn-primary btn-add" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add New SAP User Guide"><i class="ti-plus"></i></button>
                            </div>
                        </div>
                        @endcan
                    </div>
                    <div class="content-wrapper">
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUserGuidesAction" tabindex="-1" aria-labelledby="modalActionLabel" aria-hidden="true">
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
    const modal = new bootstrap.Modal($('#modalUserGuidesAction'));

    $('.btn-add').on('click', function() {
        $.ajax({
            method: 'get',
            url: `{{ url('userguides/sap_userguide/create') }}`,
            success: function(res) {
                $('#modalUserGuidesAction').find('.modal-dialog').html(res);
                modal.show();
                store();
            }
        })
    });

    function store() {
        $('#formUserGuidesAction').on('submit', function(e) {
            e.preventDefault();

            const _form = this;
            const formData = new FormData(_form);
            const url = this.getAttribute('action');

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
                    window.LaravelDataTables["sapuserguide-table"].ajax.reload();
                    modal.hide();
                    $('.alert.alert-success').html(res.respon.status);
                },
                error: function(res) {
                    let errors = res.responseJSON?.errors
                    $(_form).find('.text-danger.text-small').remove();
                    if (errors) {
                        for (const [key, value] of Object.entries(errors)) {
                            $(`[module='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
                            $(`[guideno='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
                            $(`[submodule='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
                            $(`[modulename='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
                            $(`[moduledesc='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
                        }
                    }
                    console.log(errors);
                }

            });
        });
    }
    
</script>
@endpush