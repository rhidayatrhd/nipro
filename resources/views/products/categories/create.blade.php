<div class="modal-content">
    <form action="{{ $category->id ? route('productcategories.update', $category->id) : route('productcategories.store') }}" method="post" id="formProductCategoryAction">
        @csrf
        @if ($category->id)
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
                        @if($category->id)
                        <input type="text" name="name" id="name" placeholder="Product Category" value="{{ old('name', $category->name) }}" class="form-control" disabled readonly>
                        @else
                        <input type="text" name="name" id="name" placeholder="Product Category" value="{{ old('name', $category->name) }}" class="form-control">
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="image" class="form-label">Image Category</label>
                        @if($category->id)
                        <input type="hidden" name="oldImage" value="{{ $category->image }}">
                        @endif
                        @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" class="img-preview img-fluid mb-3 col-sm-5 form-control d-block">
                        @else
                        <img class="img-preview img-fluid mb-3 col-sm-5 d-block">
                        @endif
                        <input type="file" class="form-control" name="image" id="image" onchange="previewImage()">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Excerpt of Category</label>
                        <textarea type="textarea" name="excerpt" id="excerpt" placeholder="Excerpt Product" value="{{ old('excerpt') }}" class="form-control"><?php echo $category->excerpt ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            @if($category->id)
            <button type="submit" href="/masterdatas/productcategories/{{ $category->id }}" class="btn btn-primary">Save</button>
            @else
            <button type="submit" class="btn btn-primary">Save</button>
            @endif
            <a href="/masterdatas/productcategories" class="btn btn-secondary">Cancel</a>
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