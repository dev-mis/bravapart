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
                    <li class="breadcrumb-item">
                        <a href="{{ url('admin/agents/view/'.$data->id) }}" class="text-muted">View Agent</a>
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
                    <h3 class="card-label">View Agent</h3>
                </div>
                <div class="card-toolbar">
                    <a href="{{ url('admin/agents') }}" class="btn btn-primary font-weight-bold"><i class="flaticon2-back"></i> Back</a>
                    @if ($data->status == 0)
                        <a href="{{ url('admin/agents/approve/'.$data->id) }}" class="btn btn-success font-weight-bold ml-3 btn-approve"><i class="flaticon2-check-mark"></i> Approve</a>
                        <a href="{{ url('admin/agents/reject/'.$data->id) }}" class="btn btn-warning btn-reject font-weight-bold ml-3"><i class="flaticon2-delete"></i> Reject</a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th width="20%">Status</th>
                            <td>
                                @if ($data->status == 0)
                                    <span class="label label-lg font-weight-bold label-light-warning label-inline">Pending</span>
                                @elseif ($data->status == 1)
                                    <span class="label label-lg font-weight-bold label-light-success label-inline">Approved</span>
                                @elseif ($data->status == 2)
                                <span class="label label-lg font-weight-bold label-light-danger label-inline">Rejected</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th width="20%">Register Number</th>
                            <td>{{ $data->register_number }}</td>
                        </tr>
                        <tr>
                            <th width="20%">Code</th>
                            <td>{!! !empty($data->code) ? '<span class="label label-lg font-weight-bold label-primary label-inline">'.$data->code.'</span>' : '-' !!}</td>
                        </tr>
                        <tr>
                            <th width="20%">Name</th>
                            <td>{{ $data->name }}</td>
                        </tr>
                        <tr>
                            <th width="20%">Email</th>
                            <td>{{ $data->email }}</td>
                        </tr>
                        <tr>
                            <th width="20%">Phone Number</th>
                            <td>{{ $data->phone_number }}</td>
                        </tr>
                        <tr>
                            <th width="20%">No. KTP</th>
                            <td>{{ $data->identity_number }}</td>
                        </tr>
                        @if(!empty($data->identityCard))
                            <tr>
                                <th width="20%">KTP</th>
                                <td><a href="{{ $data->identityCard->path }}" target="_BLANK"><img src="{{ $data->identityCard->path }}" style="width:300px" alt=""></a></td>
                            </tr>
                        @endif
                        <tr>
                            <th width="20%">No. NPWP</th>
                            <td>{{ $data->tax_number }}</td>
                        </tr>
                        @if(!empty($data->taxCard))
                            <tr>
                                <th width="20%">NPWP</th>
                                <td><a href="{{ $data->taxCard->path }}" target="_BLANK"><img src="{{ $data->taxCard->path }}" style="width:300px" alt=""></a></td>
                            </tr>
                        @endif
                        <tr>
                            <th width="20%">Address</th>
                            <td>{{ $data->address }}</td>
                        </tr>
                        <tr>
                            <th width="20%">Province</th>
                            <td>{{ $data->province }}</td>
                        </tr>
                        <tr>
                            <th width="20%">City</th>
                            <td>{{ $data->city }}</td>
                        </tr>
                        <tr>
                            <th width="20%">District</th>
                            <td>{{ $data->district }}</td>
                        </tr>
                        <tr>
                            <th width="20%">Village</th>
                            <td>{{ $data->village }}</td>
                        </tr>
                        <tr>
                            <th width="20%">Postal Code</th>
                            <td>{{ $data->postal_code }}</td>
                        </tr>
                        <tr>
                            <th width="20%">Bank Name</th>
                            <td>{{ $data->bank_name }}</td>
                        </tr>
                        <tr>
                            <th width="20%">Bank Account Name</th>
                            <td>{{ $data->bank_account_name }}</td>
                        </tr>
                        <tr>
                            <th width="20%">Bank Account Number</th>
                            <td>{{ $data->bank_account_number }}</td>
                        </tr>
                        @if(!empty($data->savingBook))
                            <tr>
                                <th width="20%">Bank Account Book</th>
                                <td><a href="{{ $data->savingBook->path }}" target="_BLANK"><img src="{{ $data->savingBook->path }}" style="width:300px" alt=""></a></td>
                            </tr>
                        @endif
                        <tr>
                            <th width="20%">Created At</th>
                            <td>{{ $data->created_at }}</td>
                        </tr>
                        @if ($data->status == 1)
                            <tr>
                                <th width="20%">Approved</th>
                                <td>{{ $data->approved_at ?? '-' }} ({{ $data->approvedBy->name ?? '' }})</td>
                            </tr>
                        @endif
                        @if ($data->status == 2)
                            <tr>
                                <th width="20%">Rejected</th>
                                <td>{{ $data->rejected_at ?? '-' }} ({{ $data->rejectedBy->name ?? '' }})
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
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
                                window.location.reload();
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
                                window.location.reload();
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