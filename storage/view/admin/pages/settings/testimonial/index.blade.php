@extends('admin.layouts.app')

@section('content')
<div class="subheader py-3 py-lg-8  subheader-transparent " id="kt_subheader">
    <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h2 class="subheader-title text-dark font-weight-bold my-1 mr-3">Testimonial</h2>

                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold my-2 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('admin') }}" class="text-muted">Admin</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#" class="text-muted">Settings</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ url('admin/settings/testimonial') }}" class="text-muted">Testimonial</a>
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
                    <span class="card-icon"><i class="flaticon2-chat-1 text-primary"></i></span>
                    <h3 class="card-label">List Testimonial</h3>
                </div>
                <div class="card-toolbar">
                    <a href="{{ url('admin/settings/testimonial/create') }}" class="btn btn-primary font-weight-bold"><i class="flaticon2-plus"></i> Create</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Occupation</th>
                            <th>Review</th>
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
@endsection

@section('script')
<script>
    $(document).ready(function(){
        var table = $('#kt_datatable');

        table.DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
			ajax: {
				url: "{{ url('admin/settings/testimonial/datatable') }}",
				type: 'POST',
			},
            columns: [
                {data: 'image_path', searchable: false, orderable: false, 'className': 'text-center'},
                {data: 'name'},
                {data: 'occupation'},
                {data: 'review'},
                {data: 'is_active', searchable: false, orderable: false, 'className': 'text-center'},
                {data: 'actions', responsivePriority: -1, searchable: false, orderable: false, 'className': 'text-center'},
            ],
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var link = data;

                        return '<a href="' + link + '" target="_BLANK">\
								<img src="' + link + '" style="width:200px">\
							</a>\
                        ';
                    }
                },
                {
                    targets: -1,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var edit = "{{ url('admin/settings/testimonial/edit/') }}" + data;
                        var del = "{{ url('admin/settings/testimonial/delete/') }}" + data;

                        return '<a href="' + edit + '" class="btn btn-sm btn-clean btn-icon" title="Edit">\
								<i class="la la-edit"></i>\
							</a>\
							<a href="' + del + '" class="btn btn-sm btn-clean btn-icon btn-delete" title="Delete">\
								<i class="la la-trash"></i>\
							</a>\
                        ';
                    }
                },
                {
                    targets: -2,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var status = {
                            'true': {
                                'title' : 'Active',
                                'class' : 'label-light-success'
                            },
                            'false': {
                                'title' : 'Not Active',
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
            order: [[1, 'asc']],
        });
        
        $(document).on('click', '.btn-delete', function(e){
            e.preventDefault();
    
            var action = $(this).attr('href');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: action,
                        type: 'GET',
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