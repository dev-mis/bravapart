@extends('admin.layouts.app')

@section('content')
<div class="subheader py-3 py-lg-8  subheader-transparent " id="kt_subheader">
    <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h2 class="subheader-title text-dark font-weight-bold my-1 mr-3">Dashboard</h2>

                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold my-2 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('admin') }}" class="text-muted">Admin</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#" class="text-muted">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="d-flex flex-column-fluid">
    <div class=" container ">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-custom wave wave-animate-slow wave-warning mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center p-5">
                            <div class="mr-6">
                                <h1 class="text-warning text-lg">{{ $data['pending_approval'] }}</h1>
                            </div>
    
                            <div class="d-flex flex-column">
                                <a href="{{ url('admin/agents') }}" class="text-dark text-hover-warning font-weight-bold font-size-h4 mb-3">
                                    Pending Approval
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom wave wave-animate-slow wave-success mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center p-5">
                            <div class="mr-6">
                                <h1 class="text-success text-lg">{{ $data['approved_agent'] }}</h1>
                            </div>
    
                            <div class="d-flex flex-column">
                                <a href="{{ url('admin/agents') }}" class="text-dark text-hover-success font-weight-bold font-size-h4 mb-3">
                                    Approved Agent
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom wave wave-animate-slow wave-dark mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center p-5">
                            <div class="mr-6">
                                <h1 class="text-dark text-lg">{{ $data['rejected_agent'] }}</h1>
                            </div>
    
                            <div class="d-flex flex-column">
                                <a href="{{ url('admin/agents') }}" class="text-dark text-hover-dark font-weight-bold font-size-h4 mb-3">
                                    Rejected Agent
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection