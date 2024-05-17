@extends('layouts.dashmain')

@push('css')
<link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/font/bootstrap-icons.css') }}">
@endpush

@section('content')
<title>Nipro &mdash; {{ $title }}</title>
<div class="main-content">
    <div class="title">
        {{ $menu }} - {{ $title }}
    </div>
    @if($computer->isEmpty())
    <form action="{{ route('computer.store') }}" method="post">
        @csrf
        <div class="content-wrapper empty">
            <div class="row same-height">
                <div class="col-md-4">
                    <div class="card pc-info">
                        <div class="card-header">
                            <h4>Network Data Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="netmacadrs">Network MAC Address</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="netmacadrs" name="netmacadrs" value="{{ $networks->MACAddress }}">{{ $networks->MACAddress }}</div>

                                <div class="col-md-5">
                                    <label for="cpu_id">Host Name</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="cpu_id" name="cpu_id" value="{{ $networks->systemname }}">{{ $networks->systemname }}</div>

                                <div class="col-md-5">
                                    <label for="netipadrs">Network IP Address</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="netipadrs" name="netipadrs" value="{{ gethostbyname($networks->systemname) }}">{{ gethostbyname($networks->systemname) }}</div>

                                <div class="col-md-5">
                                    <label for="nettype">Network Adapter Type</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="nettype" name="nettype" value="{{ $networks->adaptertype }}">{{ $networks->adaptertype }}</div>

                                <div class="col-md-5">
                                    <label for="netname">Network Name</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="netname" name="netname" value="{{ $networks->name }}">{{ $networks->name }}</div>

                                <div class="col-md-5">
                                    <label for="netbrand">Network Manufacture</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="netbrand" name="netbrand" value="{{ $networks->manufacturer }}">{{ $networks->manufacturer }}</div>

                                <div class="col-md-12"> </div>
                                <div class="col-md-5">
                                    <label for="wifimacadrs">Wifi MAC Address</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="wifimacadrs" name="wifimacadrs" value="{{ $wifi->MACAddress }}">{{ $wifi->MACAddress }}</div>

                                <div class="col-md-5">
                                    <label for="wifiipadrs">Wifi IP Address</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="wifiipadrs" name="wifiipadrs" value="{{ gethostbyname($wifi->systemname) }}">{{ gethostbyname($wifi->systemname) }}</div>

                                <div class="col-md-5">
                                    <label for="wifitype">Wifi Type</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="wifitype" name="wifitype" value="{{ $wifi->adaptertype }}">{{ $wifi->adaptertype }}</div>

                                <div class="col-md-5">
                                    <label for="wifiname">Wifi Name</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="wifiname" name="wifiname" value="{{ $wifi->name }}">{{ $wifi->name }}</div>

                                <div class="col-md-5">
                                    <label for="wifibrand">Wifi Manufacture</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="wifibrand" name="wifibrand" value="{{ $wifi->manufacturer }}">{{ $wifi->manufacturer }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card pc-info">
                        <div class="card-header">
                            <h4>Operating System & Computer Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="comp_type">Computer Type</label>
                                </div>
                                <div class="col-md-1">: </div>
                                @if(explode('-', $os->csname)[0] == 'NB')
                                <div class="col-md-6" id="comp_type" name="comp_type" value="NoteBook">NoteBook</div>
                                @elseif(explode('-', $os->csname)[0] == 'PC')
                                <div class="col-md-6" id="comp_type" name="comp_type" value="Desktop Computer">Desktop Computer</div>
                                @else
                                <div class="col-md-6" id="comp_type" name="comp_type" value="Unknowed.!">Unknowed.!</div>
                                @endif

                                <div class="col-md-5">
                                    <label for="comp_user_login">Computer User Login</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="comp_user_login" name="comp_user_login" value="{{ \get_current_user() }}">{{ \get_current_user() }}</div>

                                <div class="col-md-5">
                                    <label for="comp_user">User Responsibility</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="comp_user" name="comp_user" value=""></div>

                                <div class="col-md-5">
                                    <label for="comp_model">Model Type</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="comp_model" name="comp_model" value="{{ $comp->systemfamily }}">{{ $comp->systemfamily }}</div>

                                <div class="col-md-5">
                                    <label for="comp_sku_no">SKU Number</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="comp_sku_no" name="comp_sku_no" value="{{ $comp->systemskunumber }}">{{ $comp->systemskunumber }}</div>

                                <div class="col-md-5">
                                    <label for="comp_brand">Computer Manufacture</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="comp_brand" name="comp_brand" value="{{ $comp->Manufacturer }}">{{ $comp->Manufacturer }}</div>

                                <div class="col-md-12"> </div>
                                <div class="col-md-5">
                                    <label for="ossystem">Operating System</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="ossystem" name="ossystem" value="{{ $os->caption }}">{{ $os->caption }}</div>

                                <div class="col-md-5">
                                    <label for="osversion">OS Version</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="osversion" name="osversion" value="{{ $os->version }}">{{ $os->version }}</div>

                                <div class="col-md-5">
                                    <label for="ostype">System Type</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="ostype" name="ostype" value="{{ $os->osarchitecture }}">{{ $os->osarchitecture }}</div>

                                <div class="col-md-5">
                                    <label for="osserialno">OS Serial Number</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="osserialno" name="osserialno" value="{{ $os->serialnumber }}">{{ $os->serialnumber }}</div>

                                <div class="col-md-5">
                                    <label for="osbrand">OS Manufacture</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="osbrand" name="osbrand" value="{{ $os->manufacturer }}">{{ $os->manufacturer }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card pc-info">
                        <div class="card-header">
                            <h4>Processor & Hard Drive Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="procname">Processor Name</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="procname" name="procname" value="{{ $proc->name }}">{{ $proc->name }}</div>

                                <div class="col-md-5">
                                    <label for="procmodel">Processor Model</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="procmodel" name="procmodel" value="{{ $proc->description }}">{{ $proc->description }}</div>

                                <div class="col-md-5">
                                    <label for="procbrand">Processor Manufacture</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="procbrand" name="procbrand" value="{{ $proc->manufacturer }}">{{ $proc->manufacturer }}</div>

                                <div class="col-md-12"></div>
                                <div class="col-md-5">
                                    <label for="hdd_model">Hardisk Model</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="hdd_model" name="hdd_model" value="{{ $disk->model }}">{{ $disk->model }}</div>

                                <div class="col-md-5">
                                    <label for="hdd_size">Harddisk Size</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="hdd_size" name="hdd_size" value="{{ round(($disk->size)/1000000000,2) }} GB">{{ round(($disk->size)/1000000000,2) }} GB</div>

                                <div class="col-md-5">
                                    <label for="hdd_cap">Total Harddisk Capacity</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="hdd_cap" name="hdd_cap" value="{{ round(($disk->size)/1024/1024/1024,2) }} GB">{{ round(($disk->size)/1024/1024/1024,2) }} GB</div>

                                <div class="col-md-12"></div>
                                <div class="col-md-5">
                                    <label for="ram_brand">Memory Manufacture</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="ram_brand" name="ram_brand" value="{{ $ram->manufacturer }}">{{ $ram->manufacturer }}</div>

                                <div class="col-md-5">
                                    <label for="ram_size">Memory Size</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="ram_size" name="ram_size" value="{{ round(($ram->capacity)/1024/1024/1024,2) }} GB">{{ round(($ram->capacity)/1024/1024/1024,2) }} GB</div>

                                <div class="col-md-5">
                                    <label for="ram_cap">Total Memory Capacity</label>
                                </div>
                                <div class="col-md-1">: </div>
                                <div class="col-md-6" id="ram_cap" name="ram_cap" value="{{ round(($comp->TotalPhysicalMemory)/1024/1024/1024,2) }} GB">{{ round(($comp->TotalPhysicalMemory)/1024/1024/1024,2) }} GB</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary m-md-1" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>
    </form>
    @else
    @foreach($computer as $comp)
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-4">
                <div class="card pc-info">
                    <div class="card-header">
                        <h4>Network Data Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="netmacadrs">Mac Address</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="netmacadrs" name="netmacadrs" value="{{ $comp->netmacadrs }}">{{ $comp->netmacadrs }}</div>

                            <div class="col-md-5">
                                <label for="cpu_id">Host Name</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="cpu_id" name="cpu_id" value="{{ $comp->cpu_id }}">{{ $comp->cpu_id }}</div>

                            <div class="col-md-5">
                                <label for="netipadrs">Network IP Address</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="netipadrs" name="netipadrs" value="{{ $comp->netipadrs }}">{{ $comp->netipadrs }}</div>

                            <div class="col-md-5">
                                <label for="nettype">Network Adapter Type</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="nettype" name="nettype" value="{{ $comp->nettype }}">{{ $comp->nettype }}</div>

                            <div class="col-md-5">
                                <label for="netname">Network Name</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="netname" name="netname" value="{{ $comp->netname }}">{{ $comp->netname }}</div>

                            <div class="col-md-5">
                                <label for="netbrand">Network Manufacture</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="netbrand" name="netbrand" value="{{ $comp->netbrand }}">{{ $comp->netbrand }}</div>

                            <div class="col-md-12"> </div>
                            <div class="col-md-5">
                                <label for="wifimacadrs">Wifi MAC Address</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="wifimacadrs" name="wifimacadrs" value="{{ $comp->wifimacadrs }}">{{ $comp->wifimacadrs }}</div>

                            <div class="col-md-5">
                                <label for="wifiipadrs">Wifi IP Address</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="wifiipadrs" name="wifiipadrs" value="{{ $comp->wifiipadrs }}">{{ $comp->wifiipadrs }}</div>

                            <div class="col-md-5">
                                <label for="wifitype">Wifi Type</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="wifitype" name="wifitype" value="{{ $comp->wifitype }}">{{ $comp->wifitype }}</div>

                            <div class="col-md-5">
                                <label for="wifiname">Wifi Name</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="wifiname" name="wifiname" value="{{ $comp->wifiname }}">{{ $comp->wifiname }}</div>

                            <div class="col-md-5">
                                <label for="wifibrand">Wifi Manufacture</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="wifibrand" name="wifibrand" value="{{ $comp->wifibrand }}">{{ $comp->wifibrand }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card pc-info">
                    <div class="card-header">
                        <h4>Operating System & Computer Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="comp_type">Computer Type</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="comp_type" name="comp_type" value="$comp->comp_type">{{ $comp->comp_type }}</div>

                            <div class="col-md-5">
                                <label for="comp_user_login">Computer User Login</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="comp_user_login" name="comp_user_login" value="$comp->comp_user_login">{{ $comp->comp_user_login }}</div>

                            <div class="col-md-5">
                                <label for="comp_user">User Responsibility</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="comp_user" name="comp_user" value="$comp->comp_user">{{ $comp->comp_user }}</div>

                            <div class="col-md-5">
                                <label for="sect_id">User Section</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="sect_id" name="sect_id" value="$comp->sect_id">{{ $comp->department->name }}</div>

                            <div class="col-md-5">
                                <label for="comp_model">Model Type</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="comp_model" name="comp_model" value="{{ $comp->comp_model }}">{{ $comp->comp_model }}</div>

                            <div class="col-md-5">
                                <label for="comp_sku_no">SKU Number</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="comp_sku_no" name="comp_sku_no" value="{{ $comp->comp_sku_no }}">{{ $comp->comp_sku_no }}</div>

                            <div class="col-md-5">
                                <label for="comp_brand">Computer Manufacture</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="comp_brand" name="comp_brand" value="{{ $comp->comp_brand }}">{{ $comp->comp_brand }}</div>

                            <div class="col-md-12"> </div>
                            <div class="col-md-5">
                                <label for="ossystem">Operating System</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="ossystem" name="ossystem" value="{{ $comp->ossystem }}">{{ $comp->ossystem }}</div>

                            <div class="col-md-4">
                                <label for="osversion">OS Version</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-7" id="osversion" name="osversion" value="{{ $comp->osversion }}">{{ $comp->osversion }}</div>

                            <div class="col-md-5">
                                <label for="ostype">System Type</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="ostype" name="ostype" value="{{ $comp->ostype }}">{{ $comp->ostype }}</div>

                            <div class="col-md-5">
                                <label for="osserialno">OS Serial Number</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="osserialno" name="osserialno" value="{{ $comp->osserialno }}">{{ $comp->osserialno }}</div>

                            <div class="col-md-5">
                                <label for="osbrand">OS Manufacture</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="osbrand" name="osbrand" value="{{ $comp->osbrand }}">{{ $comp->osbrand }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card pc-info">
                    <div class="card-header">
                        <h4>Processor & Hard Drive Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="procname">Processor Name</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="procname" name="procname" value="{{ $comp->procname }}">{{ $comp->procname }}</div>

                            <div class="col-md-5">
                                <label for="procmodel">Processor Model</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="procmodel" name="procmodel" value="{{ $comp->procmodel }}">{{ $comp->procmodel }}</div>

                            <div class="col-md-5">
                                <label for="procbrand">Processor Manufacture</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="procbrand" name="procbrand" value="{{ $comp->procbrand }}">{{ $comp->procbrand }}</div>

                            <div class="col-md-12"> </div>
                            <div class="col-md-5">
                                <label for="hdd_model">Hardisk Model</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="hdd_model" name="hdd_model" value="{{ $comp->hdd_model }}">{{ $comp->hdd_model }}</div>

                            <div class="col-md-5">
                                <label for="hdd_size">Harddisk Size</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="hdd_size" name="hdd_size" value="{{ $comp->hdd_size }}">{{ $comp->hdd_size }}</div>

                            <div class="col-md-5">
                                <label for="hdd_cap">Total Harddisk Capacity</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="hdd_cap" name="hdd_cap" value="{{ $comp->hdd_cap }}">{{ $comp->hdd_cap }}</div>

                            <div class="col-md-12"></div>
                            <div class="col-md-5">
                                <label for="ram_brand">Memory Manufacture</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="ram_brand" name="ram_brand" value="{{ $comp->ram_brand }}">{{ $comp->ram_brand }}</div>

                            <div class="col-md-5">
                                <label for="ram_size">Memory Size</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="ram_size" name="ram_size" value="{{ $comp->ram_size }}">{{ $comp->ram_size }}</div>

                            <div class="col-md-5">
                                <label for="ram_cap">Total Memory Capacity</label>
                            </div>
                            <div class="col-md-1">: </div>
                            <div class="col-md-6" id="ram_cap" name="ram_cap" value="{{ $comp->ram_cap }}">{{ $comp->ram_cap }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif

        <div class="modal fade" id="modalPCAction" tabindex="-1" aria-labelledby="modalActionLabel" aria-hidden="false">
            <div class="modal-dialog modal-lg">

            </div>
        </div>

    </div>
    @endsection

    @push('js')
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

        const modal = new bootstrap.Modal($('#modalPCAction'))

        
        // function store() {
        //     $('#formPCAction').on('submit', function(e) {
        //         e.preventDefault()

        //         // console.log(this);
        //         const _form = this
        //         const formData = new FormData(_form)
        //         const url = this.getAttribute('action')
        //         console.log(url);

        //         $.ajax({
        //             method: 'POST',
        //             url,
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             data: formData,
        //             processData: false,
        //             contentType: false,
        //             success: function(res) {
        //                 window.LaravelDataTables["datapc-table"].ajax.reload()
        //                 modal.hide()
        //             },
        //             error: function(res) {
        //                 let errors = res.responseJSON?.errors
        //                 $(_form).find('.text-danger.text-small').remove()
        //                 if (errors) {
        //                     for (const [key, value] of Object.entries(errors)) {
        //                         $(`[hostname='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
        //                         $(`[pctype='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
        //                     }
        //                 }
        //                 console.log(errors);
        //             }
        //         })
        //     })
        // }

        // $('#datapc-table').on('click', '.action', function() {
        //     let data = $(this).data()
        //     let id = data.id
        //     let jenis = data.jenis

        //     // console.log(id)
        //     if (jenis == 'delete') {
        //         Swal.fire({
        //             title: "Are you sure?",
        //             text: "You won't be able to revert this!",
        //             icon: "warning",
        //             showCancelButton: !0,
        //             confirmButtonColor: "#3085d6",
        //             cancelButtonColor: "#d33",
        //             confirmButtonText: "Yes, delete it!"
        //         }).then(t => {
        //             t.isConfirmed &&
        //                 $.ajax({
        //                     method: 'DELETE',
        //                     url: `{{ url('imports/datapc/') }}/${id}`,
        //                     headers: {
        //                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                     },
        //                     success: function(res) {
        //                         window.LaravelDataTables["datapc-table"].ajax.reload()
        //                         Swal.fire("Deleted!", res.message, res.status)
        //                     }
        //                 })
        //         })
        //         return
        //     }

        //     $.ajax({
        //         method: 'get',
        //         url: `{{ url('imports/datapc/') }}/${id}/edit`,
        //         success: function(res) {
        //             // console.log(res)
        //             $('#modalPCAction').find('.modal-dialog').html(res)
        //             modal.show()
        //             store()
        //         }
        //     })
        // })
    </script>

    @endpush