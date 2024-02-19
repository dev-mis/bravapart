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
                    <li class="breadcrumb-item">
                        <a href="{{ url('admin/settings/testimonial/edit/'.$data->id) }}" class="text-muted">Edit</a>
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
                    <h3 class="card-label">Edit Testimonial</h3>
                </div>
                <div class="card-toolbar">
                    <a href="{{ url('admin/settings/testimonial') }}" class="btn btn-warning font-weight-bold"><i class="flaticon2-back"></i> Back</a>
                </div>
            </div>
            <form action="{{ url('admin/settings/testimonial/edit/'.$data->id) }}" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group picture_upload">
                                <label>Image</label>
                                <div class="form-group__file">
                                    <div class="file-wrapper">
                                        <input type="file" name="image" class="file-input" accept="image/jpeg, image/png, image/jpg"/>
                                        <div class="file-preview-background">+</div>
                                        <img src="{{ $data->image->path }}" style="opacity: 1" width="240px" class="file-preview"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control form-control-solid" placeholder="Enter name" value="{{ $data->name }}"/>
                            </div>
                            <div class="form-group">
                                <label>Occupation</label>
                                <input type="text" name="occupation" class="form-control form-control-solid" placeholder="Enter occupation" value="{{ $data->occupation }}"/>
                            </div>
                            <div class="form-group">
                                <label>Review</label>
                                <textarea name="review" rows="3" class="form-control form-control-solid" placeholder="Enter review">{{ $data->review }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Is Active?</label>
                                <span class="switch switch-outline switch-icon switch-success">
                                    <label>
                                        <input type="checkbox" name="is_active" {{ $data->is_active == true ? 'checked' : '' }}/>
                                        <span></span>
                                    </label>
                                </span>
                            </div>
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