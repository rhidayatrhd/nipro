<div class="modal-content">
    <form action="{{ $productcategory->id ? route('productcategories.update', $productcategory->id) : route('productcategories.store') }}" method="post" id="formCategoryAction" enctype="multipart/form-data">
        @csrf
        @if($productcategory->id)
        @method('put')
        @endif
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Product Category Menu</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Category</label>
                        <input type="text" placeholder="Category name" value="{{ old('name', $productcategory->name) }}" class="form-control @error('name') is-invalid @enderror fw-small" name="name" id="name">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug Excerption</label>
                        <input type="text" class="form-control slug" name="slug" id="slug" value="{{ old('slug') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="excerptcategory" class="form-label">Excerpt of Category</label>
                        <input type="textarea" placeholder="Please fill the excerpt of category" value="{{ old('excerpt', $productcategory->excerpt) }}" class="form-control @error('excerpt') is-invalid @enderror fw-small" name="excerpt" id="excerptcategory">
                        @error('excerpt')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="image" class="form-label">Image Category</label>
                        @if($productcategory->image)
                        <img src="{{ asset('storage/' . $productcategory->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                        @else
                        <img class="img-preview img-fluid mb-3 col-sm-5">
                        @endif
                        <input type="file" class="form-control @error('image') is-invalid @enderror fw-small" name="image" id="image" onchange="previewImage()">
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
    </form>
</div>

<script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function() {
        fetch('products/productcategories/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });

    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })
</script>