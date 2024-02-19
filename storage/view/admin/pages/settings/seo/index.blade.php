@extends('admin.layouts.app')

@section('content')
<div class="subheader py-3 py-lg-8  subheader-transparent " id="kt_subheader">
    <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h2 class="subheader-title text-dark font-weight-bold my-1 mr-3">SEO</h2>

                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold my-2 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('admin') }}" class="text-muted">Admin</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#" class="text-muted">Settings</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a href="{{ url('admin/settings/seo') }}" class="text-muted">SEO</a>
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
                    <span class="card-icon"><i class="flaticon2-tag text-primary"></i></span>
                    <h3 class="card-label">Update SEO</h3>
                </div>
            </div>
            <form action="{{ url('admin/settings/seo/update') }}" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control form-control-solid" placeholder="Enter title" value="{{ $data->title ?? '' }}"/>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Description</label>
                            <textarea name="description" rows="3" class="form-control form-control-solid" placeholder="Enter description">{{ $data->description ?? '' }}</textarea>
                        </div>
                    </div>
                    
                    <div class="row">
                        @if (!empty($data->updated_by))
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label class="font-weight-bolder">Last Update</label>
                                    <div>
                                        {{ $data->updated_at }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label class="font-weight-bolder">Updated By</label>
                                    <div>
                                        {{ $data->updatedBy->name }}
                                    </div>
                                </div>
                            </div>
                        @endif
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

            var formData = new FormData(this);

            $.ajax({
                url: action,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
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