<div class="modal-content">
    <form action="{{ $computer->id ? route('computer.update', $computer->id) : route('computer.store') }}" method="post" id="formPCAction">
        @csrf
        @if($computer->id)
        @method('put')
        @endif
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Confirmation Computer Data</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-2">
                    <div class="mb-2">
                        <label for="hostname" class="form-label">Host Name</label>
                        <input type="text" placeholder="Host name" value="{{ $computer->pchost }}" class="form-control" name="hostname" id="hostname">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-2">
                        <label for="name" class="form-label">Computer Name</label>
                        <input type="text" placeholder="Computer Name" value="{{ $computer->name }}" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-2">
                        <label for="pctype" class="form-label">Computer Type</label>
                        <input type="text" placeholder="Computer Type" value="{{ $computer->pctype }}" class="form-control" name="pctype" id="pctype">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-2">
                        <label for="brand" class="form-label">Brand</label>
                        <input type="text" placeholder="Brand Name" value="{{ $computer->brand }}" class="form-control" name="brand" id="brand">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-2">
                        <label for="model" class="form-label">Computer Model</label>
                        <input type="text" placeholder="Computer Model" value="{{ $computer->model }}" class="form-control" name="model" id="model">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-2">
                        <label for="processor" class="form-label">Computer Processor</label>
                        <input type="text" placeholder="Computer Processor" value="{{ $computer->processor }}" class="form-control" name="processor" id="processor">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="mb-2">
                        <label for="ipadrs" class="form-label">IP Address Number</label>
                        <input type="text" placeholder="IP Address Number" value="{{ $computer->ipadrs }}" class="form-control" name="ipadrs" id="ipadrs">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="mb-2">
                        <label for="ram" class="form-label">RAM Size</label>
                        <input type="text" placeholder="RAM Size" value="{{ $computer->ram }}" class="form-control" name="ram" id="ram">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="mb-2">
                        <label for="hdd" class="form-label">Harddisk Size</label>
                        <input type="text" placeholder="Harddisk Size" value="{{ $computer->hdd }}" class="form-control" name="hdd" id="hdd">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="mb-2">
                        <label for="purchyear" class="form-label">Purchase Year</label>
                        <input type="text" placeholder="Purchase Year" value="{{ $computer->purchyear }}" class="form-control" name="purchyear" id="purchyear">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-2">
                        <label for="username" class="form-label">User Responsibility</label>
                        <input type="text" placeholder="User Responsibility" value="{{ $computer->username }}" class="form-control" name="username" id="username">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="mb-2">
                        <label for="userlevel" class="form-label">User Level</label>
                        <input type="text" placeholder="User Level" value="{{ $computer->userlevel }}" class="form-control" name="userlevel" id="userlevel">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-2">
                        <label for="userdept" class="form-label">Department</label>
                        <input type="text" placeholder="Department" value="{{ $computer->userdept }}" class="form-control" name="userdept" id="userdept">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-2">
                        <label for="useremail" class="form-label">Email Address</label>
                        <input type="email" placeholder="Email Address" value="{{ $computer->useremail }}" class="form-control" name="useremail" id="useremail">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-2">
                        <label for="osystem" class="form-label">Operating System</label>
                        <input type="text" placeholder="Operating System" value="{{ $computer->osystem }}" class="form-control" name="osystem" id="osystem">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="mb-2">
                        <label for="spreadsheet" class="form-label">Spreadsheet Application</label>
                        <input type="text" placeholder="Spreadsheet Application" value="{{ $computer->spreadsheet }}" class="form-control" name="spreadsheet" id="spreadsheet">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-2">
                        <label for="usedfor" class="form-label">Computer used to</label>
                        <input type="text" placeholder="Computer usge for" value="{{ $computer->usedfor }}" class="form-control" name="usedfor" id="usedfor">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="mb-2">
                        <label for="antivirus" class="form-label">Use Antivirus</label>
                        <input type="text" placeholder="Use Antivirus" value="{{ old('antivirus') ?? '1' }}" class="form-control" name="antivirus" id="antivirus">
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