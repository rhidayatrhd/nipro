<div class="modal-content">
    <form action="{{ $navigationmenu->id ? route('navigationmenu.update', $navigationmenu->id) : route('navigationmenu.store') }}" method="post" id="formNavigationAction">
        @csrf
        @if($navigationmenu->id)
        @method('put')
        @endif
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Navigation Menu</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="navigationname" class="form-label">Menu Name</label>
                        <input type="text" placeholder="Navigation menu name" value="{{ $navigationmenu->name }}" class="form-control" name="name" id="navigationname">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="url" class="form-label">URL Address</label>
                        <input type="text" placeholder="URL Address" value="{{ $navigationmenu->url }}" class="form-control" name="url" id="url">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon</label>
                        <input type="text" placeholder="Icon Name" value="{{ $navigationmenu->icon }}" class="form-control" name="icon" id="icon">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="main_menu" class="form-label">Sub Menu</label>
                        <input type="text" placeholder="Fill empty for Menu" value="{{ $navigationmenu->main_menu }}" class="form-control" name="main_menu" id="main_menu">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="submit">Save</button>
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
        </div>
    </form>
</div>