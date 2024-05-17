@extends('layouts.dashmain')

@push('css')
<link rel="stylesheet" href="{{ asset('vendor/chart.js/Chart.min.css') }}">
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
                    <div class="card-header"></div>
                    <div class="content-wrapper">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCompAction" tabindex="-1" aria-labelledby="modalActionLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">

        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="{{ asset('assets/js/pages/index.min.js') }}"></script>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>

    var result = '';
    $('#xComp').val('', function() {
        let data = $(this).data()
        let id = data.id
        result = $(this).val();
        console.log(id);

        if (result == '') {
            $.ajax({
                method: 'get',
                url: `{{ url('imports/datapc-action/') }}/${id}/edit`,
                success: function(res) {
                    console.log(res);
                    $('#modalCompAction').find('.modal-dialog').html(res)
                    modal.show()
                    store()
                }
            })
        }
    });
</script>
@endpush