@extends('admin.layouts.app')

@section('content')
<div class="subheader py-3 py-lg-8  subheader-transparent " id="kt_subheader">
    <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h2 class="subheader-title text-dark font-weight-bold my-1 mr-3">Agents</h2>

                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold my-2 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('admin') }}" class="text-muted">Admin</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ url('admin/agents') }}" class="text-muted">Agents</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="d-flex flex-column-fluid">
    <div class=" container ">
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon"><i class="flaticon2-group text-primary"></i></span>
                    <h3 class="card-label">List Agent</h3>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#all-tab" role="tab">
                            <div class="nav-icon"><i class="flaticon2-list-1"></i></div>
                            <div class="nav-text">All</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#pending-tab" role="tab">
                            <div class="nav-icon"><i class="flaticon2-hourglass"></i></div>
                            <div class="nav-text">Pending</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#approved-tab" role="tab">
                            <div class="nav-icon"><i class="flaticon2-check-mark"></i></div>
                            <div class="nav-text">Approved</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#rejected-tab" role="tab">
                            <div class="nav-icon"><i class="flaticon2-delete"></i></div>
                            <div class="nav-text">Rejected</div>
                        </a>
                    </li>
                </ul>
                <div class="tab-content mt-7" id="myTabContent">
                    <div class="tab-pane fade show active" id="all-tab" role="tabpanel" aria-labelledby="home-tab">
                        <table class="table table-bordered table-hover table-checkable" id="all_table" style="margin-top: 13px !important">
                            <thead>
                                <tr>
                                    <th>Created At</th>
                                    <th>Register Number</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
        
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="pending-tab" role="tabpanel" aria-labelledby="home-tab">
                        <table class="table table-bordered table-hover table-checkable" id="pending_table" style="margin-top: 13px !important">
                            <thead>
                                <tr>
                                    <th>Created At</th>
                                    <th>Register Number</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
        
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="approved-tab" role="tabpanel" aria-labelledby="approv">
                        <table class="table table-bordered table-hover table-checkable" id="approved_table" style="margin-top: 13px !important">
                            <thead>
                                <tr>
                                    <th>Created At</th>
                                    <th>Register Number</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
        
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="rejected-tab" role="tabpanel" aria-labelledby="approv">
                        <table class="table table-bordered table-hover table-checkable" id="rejected_table" style="margin-top: 13px !important">
                            <thead>
                                <tr>
                                    <th>Created At</th>
                                    <th>Register Number</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        var all_table = $('#all_table');
        all_table.DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
			ajax: {
				url: "{{ url('admin/agents/datatable') }}",
				type: 'POST',
			},
            columns: [
                {data: 'created_at'},
                {data: 'register_number'},
                {data: 'name'},
                {data: 'email'},
                {data: 'status', searchable: false, orderable: false, 'className': 'text-center'},
                {data: 'actions', responsivePriority: -1, searchable: false, orderable: false, 'className': 'text-center'},
            ],
            columnDefs: [
                {
                    targets: -1,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var view = "{{ url('admin/agents/view/') }}" + data;

                        return '<a href="' + view + '" class="btn btn-sm btn-clean btn-icon" title="View">\
								<i class="flaticon-eye"></i>\
							</a>\
                        ';
                    }
                },
                {
                    targets: -2,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var status = {
                            '0': {
                                'title' : 'Pending',
                                'class' : 'label-light-warning'
                            },
                            '1': {
                                'title' : 'Approved',
                                'class' : 'label-light-success'
                            },
                            '2': {
                                'title' : 'Rejected',
                                'class' : 'label-light-danger'
                            }
                        }

                        if (typeof status[data] === 'undefined') {
							return data;
						}

                        return '<span class="label label-lg font-weight-bold ' + status[data].class + ' label-inline">' + status[data].title + '</span>';
                    }
                }
            ],
            order: [[0, 'desc']],
        });

        setTimeout(function(){
            var pending_table = $('#pending_table');
            pending_table.DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ url('admin/agents/datatable') }}",
                    type: 'POST',
                    data: {
                        "status": 'pending'
                    },
                },
                columns: [
                    {data: 'created_at'},
                    {data: 'register_number'},
                    {data: 'name'},
                    {data: 'email'},
                    {data: 'status', searchable: false, orderable: false, 'className': 'text-center'},
                    {data: 'actions', responsivePriority: -1, searchable: false, orderable: false, 'className': 'text-center'},
                ],
                columnDefs: [
                    {
                        targets: -1,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            var view = "{{ url('admin/agents/view/') }}" + data;

                            return '<a href="' + view + '" class="btn btn-sm btn-clean btn-icon" title="View">\
                                    <i class="flaticon-eye"></i>\
                                </a>\
                            ';
                        }
                    },
                    {
                        targets: -2,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            var status = {
                                '0': {
                                    'title' : 'Pending',
                                    'class' : 'label-light-warning'
                                },
                                '1': {
                                    'title' : 'Approved',
                                    'class' : 'label-light-success'
                                },
                                '2': {
                                    'title' : 'Rejected',
                                    'class' : 'label-light-danger'
                                }
                            }

                            if (typeof status[data] === 'undefined') {
                                return data;
                            }

                            return '<span class="label label-lg font-weight-bold ' + status[data].class + ' label-inline">' + status[data].title + '</span>';
                        }
                    }
                ],
                order: [[0, 'desc']],
            })
        }, 500);

        setTimeout(function(){
            var approved_table = $('#approved_table');
            approved_table.DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ url('admin/agents/datatable') }}",
                    type: 'POST',
                    data: {
                        "status": 'approved',
                    },
                },
                columns: [
                    {data: 'created_at'},
                    {data: 'register_number'},
                    {data: 'name'},
                    {data: 'code'},
                    {data: 'status', searchable: false, orderable: false, 'className': 'text-center'},
                    {data: 'actions', responsivePriority: -1, searchable: false, orderable: false, 'className': 'text-center'},
                ],
                columnDefs: [
                    {
                        targets: -1,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            var view = "{{ url('admin/agents/view/') }}" + data;

                            return '<a href="' + view + '" class="btn btn-sm btn-clean btn-icon" title="View">\
                                    <i class="flaticon-eye"></i>\
                                </a>\
                            ';
                        }
                    },
                    {
                        targets: -2,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            var status = {
                                '0': {
                                    'title' : 'Pending',
                                    'class' : 'label-light-warning'
                                },
                                '1': {
                                    'title' : 'Approved',
                                    'class' : 'label-light-success'
                                },
                                '2': {
                                    'title' : 'Rejected',
                                    'class' : 'label-light-danger'
                                }
                            }

                            if (typeof status[data] === 'undefined') {
                                return data;
                            }

                            return '<span class="label label-lg font-weight-bold ' + status[data].class + ' label-inline">' + status[data].title + '</span>';
                        }
                    }
                ],
                order: [[0, 'desc']],
            });
        }, 1000);

        setTimeout(function(){
            var rejected_table = $('#rejected_table');
            rejected_table.DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ url('admin/agents/datatable') }}",
                    type: 'POST',
                    data: {
                        "status": 'rejected',
                    },
                },
                columns: [
                    {data: 'created_at'},
                    {data: 'register_number'},
                    {data: 'name'},
                    {data: 'email'},
                    {data: 'status', searchable: false, orderable: false, 'className': 'text-center'},
                    {data: 'actions', responsivePriority: -1, searchable: false, orderable: false, 'className': 'text-center'},
                ],
                columnDefs: [
                    {
                        targets: -1,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            var view = "{{ url('admin/agents/view/') }}" + data;

                            return '<a href="' + view + '" class="btn btn-sm btn-clean btn-icon" title="View">\
                                    <i class="flaticon-eye"></i>\
                                </a>\
                            ';
                        }
                    },
                    {
                        targets: -2,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            var status = {
                                '0': {
                                    'title' : 'Pending',
                                    'class' : 'label-light-warning'
                                },
                                '1': {
                                    'title' : 'Approved',
                                    'class' : 'label-light-success'
                                },
                                '2': {
                                    'title' : 'Rejected',
                                    'class' : 'label-light-danger'
                                }
                            }

                            if (typeof status[data] === 'undefined') {
                                return data;
                            }

                            return '<span class="label label-lg font-weight-bold ' + status[data].class + ' label-inline">' + status[data].title + '</span>';
                        }
                    }
                ],
                order: [[0, 'desc']],
            });
        }, 1500);
        
        $(document).on('click', '.btn-approve', function(e){
            e.preventDefault();
    
            var action = $(this).attr('href');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: action,
                        type: 'POST',
                        success: function(data){
                            var result = data;
                            let timerInterval;

                            Swal.fire({
                                title: 'Success',
                                text: result.message,
                                icon: 'success',
                                timer: 2000,
                                timerProgressBar: true,
                                showCancelButton: false,
                                showCloseButton: false,
                                showConfirmButton: false,
                            }).then((result) => {
                                if(data.redirect != null){
                                    window.location.replace(data.redirect);
                                }
                            })
                        },
                        error: function(data){
                            var result = data.responseJSON;

                            Swal.fire({
                                title: 'Error!',
                                text: result.message,
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            })
                        }
                    })
                }
            })
        });

        $(document).on('click', '.btn-reject', function(e){
            e.preventDefault();
    
            var action = $(this).attr('href');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, reject it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: action,
                        type: 'POST',
                        success: function(data){
                            var result = data;
                            let timerInterval;

                            Swal.fire({
                                title: 'Success',
                                text: result.message,
                                icon: 'success',
                                timer: 2000,
                                timerProgressBar: true,
                                showCancelButton: false,
                                showCloseButton: false,
                                showConfirmButton: false,
                            }).then((result) => {
                                if(data.redirect != null){
                                    window.location.replace(data.redirect);
                                }
                            })
                        },
                        error: function(data){
                            var result = data.responseJSON;

                            Swal.fire({
                                title: 'Error!',
                                text: result.message,
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            })
                        }
                    })
                }
            })
        });
    })
</script>
@endsection