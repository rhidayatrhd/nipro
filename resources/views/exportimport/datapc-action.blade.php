<div class="modal-content">
    <form action="{{ $datapc->id ? route('datapc.update', $datapc->id) : route('datapc.store') }}" method="post" id="formPCAction">
        @csrf
        @if($datapc->id)
        @method('put')
        @endif
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Data PC Menu</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-2">
                <div class="col-md-2">
                    <div class="mb-2">
                        <label for="pchost" class="form-label">Host Name</label>
                        <input type="text" placeholder="Host name" value="{{ $datapc->pchost }}" class="form-control" name="pchost" id="pchost">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-2">
                        <label for="asset_id" class="form-label">Asset Number</label>
                        <input type="text" placeholder="Computer Name" value="{{ $datapc->asset_id }}" class="form-control" name="asset_id" id="asset_id">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-2">
                        <label for="pctype" class="form-label">Computer Type</label>
                        <input type="text" placeholder="Computer Type" value="{{ $datapc->pctype }}" class="form-control" name="pctype" id="pctype">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-2">
                        <label for="brand" class="form-label">Computer Brand</label>
                        <input type="text" placeholder="Brand Name" value="{{ $datapc->brand }}" class="form-control" name="brand" id="brand">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-2">
                        <label for="model" class="form-label">Computer Model</label>
                        <input type="text" placeholder="Computer Model" value="{{ $datapc->model }}" class="form-control" name="model" id="model">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4">
                    <div class="mb-2">
                        <label for="processor" class="form-label">Computer Processor</label>
                        <input type="text" placeholder="Computer Processor" value="{{ $datapc->processor }}" class="form-control" name="processor" id="processor">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="mb-2">
                        <label for="ipadrs" class="form-label">IP Address Number</label>
                        <input type="text" placeholder="IP Address Number" value="{{ $datapc->ipadrs }}" class="form-control" name="ipadrs" id="ipadrs">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="mb-2">
                        <label for="ram" class="form-label">RAM Size</label>
                        <input type="text" placeholder="RAM Size" value="{{ $datapc->ram }}" class="form-control" name="ram" id="ram">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="mb-2">
                        <label for="hdd" class="form-label">Harddisk Size</label>
                        <input type="text" placeholder="Harddisk Size" value="{{ $datapc->hdd }}" class="form-control" name="hdd" id="hdd">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="mb-2">
                        <label for="purchyear" class="form-label">Purchase Year</label>
                        <input type="text" placeholder="Purchase Year" value="{{ $datapc->purchyear }}" class="form-control" name="purchyear" id="purchyear">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-2">
                    <div class="mb-2">
                        <label for="username" class="form-label">User Responsibility</label>
                        <input type="text" placeholder="User Responsibility" value="{{ $datapc->username }}" class="form-control" name="username" id="username">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-2">
                        <label for="userlevel" class="form-label">User Level</label>
                        <input type="text" placeholder="User Level" value="{{ $datapc->userlevel }}" class="form-control" name="userlevel" id="userlevel">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-2">
                        <label for="userdept" class="form-label">Department</label>
                        <input type="text" placeholder="Department" value="{{ $datapc->userdept }}" class="form-control" name="userdept" id="userdept">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-2">
                        <label for="useremail" class="form-label">Email Address</label>
                        <input type="email" placeholder="Email Address" value="{{ $datapc->useremail }}" class="form-control" name="useremail" id="useremail">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-3">
                    <div class="mb-2">
                        <label for="cost_ctr" class="form-label">Cost Center</label>
                        <select name="cost_ctr" id="cost_ctr" class="form-select form-control">
                            @if($datapc->cost_ctr)
                            <option value="{{ $datapc->cost_ctr }}" selected>{{ $datapc->cost_ctr }}</option>
                            @else
                            <option value="" selected>Select Cost Center</option>
                            <option value="PDA1">PDA1 - Injection</option>
                            <option value="PDA2">PDA2 - Extrusion</option>
                            <option value="PDB1">PDB1 - Syringe</option>
                            <option value="PDB2">PDB2 - Insulin Syringe</option>
                            <option value="PDB3">PDB3 - Bulk Needle Assy</option>
                            <option value="PDC1">PDC1 - BTS</option>
                            <option value="PDC2">PDC2 - Infusion Set</option>
                            <option value="PDC3">PDC3 - Suction Catheter</option>
                            <option value="PDD1">PDD1 - IV Cath</option>
                            <option value="PDD2">PDD2 - AVF</option>
                            <option value="PDD3">PDD3 - Blood Lancet</option>
                            <option value="STR1">STR1 - ETO</option>
                            <option value="STR2">STR2 - E-Beam</option>
                            <option value="HRG1">HRG1 - Human Resource General Affair</option>
                            <option value="ITD1">ITD1 - Information Technology</option>
                            <option value="FAD1">FAD1 - Finance & Accounting</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-2">
                        <label for="dept_id" class="form-label">Department</label>
                        <select name="dept_id" id="dept_id" class="form-select form-control">
                            @if($datapc->dept_id)
                            <option value="{{ $datapc->dept_id }}" selected>{{ $datapc->departments->name }}</option>
                            @else
                            <option value="-1" selected>Select Department</option>
                            @foreach($deptcost as $dept)
                            @if(old('dept_id') == $dept)
                            <option value="{{ $datapc->dept_id }}" selected>{{ $datapc->departments->name }}</option>
                            @else
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endif
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-2">
                        <label for="sect_id" class="form-label">Section</label>
                        <select name="sect_id" id="sect_id" class="form-select form-control">
                            @if($datapc->sect_id)
                            <option value="{{ $datapc->sect_id }}" selected>{{ $datapc->sections->name }}</option>
                            @else
                            <option value="-1" selected>Select Section</option>
                            @foreach($sectcost as $sect)
                            @if(old('sect_id') == $sect)
                            <option value="{{ $datapc->sect_id }}" selected>{{ $datapc->sections->name }}</option>
                            @else
                            <option value="{{ $sect->id }}">{{ $sect->name }}</option>
                            @endif
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-3">
                    <div class="mb-2">
                        <label for="osystem" class="form-label">Operating System</label>
                        <input type="text" placeholder="Operating System" value="{{ $datapc->osystem }}" class="form-control" name="osystem" id="osystem">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-2">
                        <label for="spreadsheet" class="form-label">Spreadsheet Application</label>
                        <input type="text" placeholder="Spreadsheet Application" value="{{ $datapc->spreadsheet }}" class="form-control" name="spreadsheet" id="spreadsheet">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="mb-2">
                        <label for="usedfor" class="form-label">Computer used to</label>
                        <input type="text" placeholder="Computer usage for" value="{{ $datapc->usedfor }}" class="form-control" name="usedfor" id="usedfor">
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
            <button class="btn btn-primary" type="submit">Save</button>
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
        </div>
    </form>
</div>