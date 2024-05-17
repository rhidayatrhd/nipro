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
                        <a href="/products/productcategories" class="btn btn-secondary"><i><span class="ti-back-left"></span></i></a>
                        <!-- <a href="/products/productitems/{{ $product->id }}/edit" class="btn btn-warning"><span data-feather="edit"></span>Edit</a> -->
                        <button type="button" name="edit" id="edit" class="btn btn-warning" value="{{ $product->id }}"><i><span class="ti-pencil-alt"></span></i></button>
                        <button type="button" class="btn btn-danger" name="delete" id="delete" value="{{ $product->id }}"><i class="ti-trash"></i></button>
                        <!-- <form action="/products/productitems/{{ $product->slug }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn bg-danger" onclick="return confirm('Are you sure')"><span data-feather="x-cicle"></span>Delete</button>
                        </form> -->
                    </div>
                    <div class="content-wrapper">
                        <div class="card-body">
                            @if($product->image)
                            <div style="max-block-size: 350px; overflow:hidden">
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

    <div class="modal fade" id="modalShowProductItemAction" tabindex="-1" aria-labelledby="modalActionLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl"></div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

<script>
    const modal = new bootstrap.Modal($('#modalShowProductItemAction'))

    $('#delete').on('click', function() {
        let id = $(this).val()
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
                    url: `{{ url('products/productcategories/') }}/${id}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        Swal.fire("Deleted!", res.message, res.status)
                    }
                })
        })
    })

    $('#edit').on('click', function() {
        let id = $(this).val()
        $.ajax({
            method: 'get',
            url: `{{ url('products/productcategories/') }}/${id}/edit`,
            success: function(res) {
                $('#modalShowProductItemAction').find('.modal-dialog').html(res)
                modal.show()
                store()
            }
        })
    })
</script>
@endpush