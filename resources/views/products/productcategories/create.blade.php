<div class="modal-content">
    <form action="{{ $productcategory->id ? route('productcategories.update', $productcategory->id) : route('productcategories.store') }}" method="post" id="formProductCategoryAction">
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
                        <label for="title" class="form-label">Product Category</label>
                        <input type="text" name="name" id="name" placeholder="Product Category" value="{{ old('name', $productcategory->name) }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="image" class="form-label">Image Category</label>
                        @if($productcategory->image)
                        <img src="{{ asset('storage/' . $productcategory->image) }}" class="img-preview img-fluid mb-3 col-sm-5 form-control">
                        @else
                        <img class="img-preview img-fluid mb-3 col-sm-5">
                        @endif
                        <input type="file" class="form-control" name="image" id="image" onchange="previewImage()">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Excerpt of Category</label>
                        <textarea type="textarea" name="excerpt" id="excerpt" placeholder="Excerpt Product" value="{{ old('excerpt') }}" class="form-control"><?php echo $productcategory->excerpt?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="/products/productcategories" class="btn btn-secondary">Cancel</a>
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