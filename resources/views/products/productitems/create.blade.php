<div class="modal-content">
    <form action="{{ $productitem->id ? route('productitems.update', $productitem->id) : route('productitems.store') }}" method="post" id="formProductItemAction">
        @csrf
        @if($productitem->id)
        @method('put')
        @endif
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Product Item Menu</h5>
            <button class="btn-close" type="button" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Product Title</label> 
                        @if($productitem->id)
                        <input type="text" placeholder="Title of Product" value="{{ $productitem->id ? $productitem->title : old('title') }}" class="form-control @error('title') is-invalid @enderror" name="title" id="title" read disabled>
                        @else
                        <input type="text" placeholder="Title of Product" value="{{ $productitem->id ? $productitem->title : old('title') }}" class="form-control @error('title') is-invalid @enderror" name="title" id="title">
                        @endif
                        <!-- @error('title') -->
                            <div class="invalid-feedback">test</div>
                        <!-- @enderror -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="category" class="form-label">Product Category</label>
                        <select name="category_id" id="category_id" class="form-select" value="{{ $productitem->id ? $productitem->name : old('title') }}">
                            <option value="-1" selected></option>
                            @foreach($categories as $category)
                            @if(old('category') == $category->id || $productitem->category_id == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        <img class="img-preview img-fluid mb-3 col-sm-5" src="{{ $productitem->image ? asset($productitem->image) : asset(old('image')) }}">
                        <input type="file" class="form-control" name="image" id="image" onchange="previewImage()">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="body" class="form-label">Product Item Information Details</label>
                        <input type="hidden" name="body" id="body" value="{{ old('body') }}">
                        <trix-editor input="body"></trix-editor>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="submit">Save</button>
            <a href="/products/productitems" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })

    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
<!-- <style>
    trix-toolbar [data-trix-button-group="file-tools"] {
        display: none;
    }
</style> -->