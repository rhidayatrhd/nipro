div @extends('layouts.dashmain')

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
                        <h3 class="mb-3">{{ $product->name }}</h3>
                        <a href="/masterdatas/productcategories" class="btn btn-secondary"><i><span class="ti-back-left"></span></i></a>
                        <button type="submit" name="edit" id="edit" class="btn btn-warning" data-id="{{ $product->id }}" data-jenis="edit"><i><span class="ti-pencil-alt"></span></i></button>
                        <a href="/masterdatas/productcategories" class="btn btn-danger" name="delete" id="delete" data-id="{{ $product->id }}" data-jenis="delete"><i><span class="ti-trash"></span></i></a>
                    </div>
                    <div class="content-wrapper">
                        <div class="card-body">
                            @if($product->image)
                            <div style="max-block-size: 350px; overflow:hidden;display:inline-table">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" srcset="img-fluid mt-3" class="img-preview img-fluid mb-3 col-sm-9">
                            </div>
                            @else
                            <img src="https://source.unsplash.com/1200x400? {{ $product->name }}" alt="{{ $product->name }}" srcset="img-fluid mt-3" class="img-preview img-fluid mb-3 col-sm-9">
                            @endif

                            <article class="my-3 text-small">{!! $product->excerpt !!}</article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalProductCategoryAction" tabindex="-1" aria-labelledby="modalActionLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl"></div>
    </div>
</div> 
@endsection

@push('js')
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

<script>
    const modal = new bootstrap.Modal($('#modalProductCategoryAction'))

    $('#delete').on('click', function() {
        let data = $(this).data();
        let id = data.id;
        let jenis = data.jenis;
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
                    url: `{{ url('masterdatas/productcategories/') }}/${id}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        window.LaravelDataTables["category-table"].ajax.reload();
                        Swal.fire("Deleted!", res.message, res.status);
                    }
                });
        });
    });

    $('#edit').on('click', function() {
        let data = $(this).data();
        let id = data.id;
        let jenis = data.jenis; 
        $.ajax({
            method: 'get',
            url: `{{ url('masterdatas/productcategories/') }}/${id}/edit`,
            success: function(res) {
                $('#modalProductCategoryAction').find('.modal-dialog').html(res)
                modal.show()
                store()
            }
        });
    });

    function store() {
        $('#formProductCategoryAction').on('submit', function(e) {
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
                    location.reload(true);
                    modal.hide();
                },
                error: function(res) {
                    let errors = res.responseJSON?.errors;
                    $(_form).find('.text-danger.text-small').remove();
                    if (errors) {
                        for (const [key, value] of Object.entries(errors)) {
                            $(`[image='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`);
                            $(`[excerpt='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`);
                        }
                    }
                    console.log(errors);
                }
            });
        })
    }
</script>
@endpush