@extends('admin.layouts.app')

@section('content')
<div class="subheader py-3 py-lg-8  subheader-transparent " id="kt_subheader">
    <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h2 class="subheader-title text-dark font-weight-bold my-1 mr-3">Users</h2>

                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold my-2 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('admin') }}" class="text-muted">Admin</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#" class="text-muted">Settings</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ url('admin/settings/users') }}" class="text-muted">Users</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ url('admin/settings/users/create') }}" class="text-muted">Create</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="d-flex flex-column-fluid">
    <div class=" container ">
        <div class="alert alert-dark" role="alert">
            The user is integrated with Office365. Please make sure to enter the email address associated with Microsoft!
        </div>
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon"><i class="flaticon2-user text-primary"></i></span>
                    <h3 class="card-label">Create User</h3>
                </div>
                <div class="card-toolbar">
                    <a href="{{ url('admin/settings/users') }}" class="btn btn-warning font-weight-bold"><i class="flaticon2-back"></i> Back</a>
                </div>
            </div>
            <form action="{{ url('admin/settings/users/create') }}" method="POST">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control form-control-solid" placeholder="Enter name"/>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control form-control-solid" placeholder="Enter email"/>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Is Active?</label>
                            <span class="switch switch-outline switch-icon switch-success">
                                <label>
                                    <input type="checkbox" checked="checked"' name="is_active"/>
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
		            <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('form').submit(function(e){
            e.preventDefault();

            var action = $(this).attr('action');

            var serialize = $(this).serialize();

            $.ajax({
                url: action,
                type: 'POST',
                data: serialize,
                success: function(data){
                    var result = data;
                    let timerInterval;

                    if(data.redirect != null){
                        window.location.replace(data.redirect);
                    }
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
        });
    })
</script>
@endsection