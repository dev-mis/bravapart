@extends('frontend.layouts.app')

@section('content')


<div class="banner">
    <span>
        <div class="banner-image desktop" style="background-image: url('{{asset('frontend/assets/images/background1.jpg')}}');"></div>
        <div class="banner-image mobile" style="background-image: url('{{asset('frontend/assets/images/background1.jpg')}}'); display: none;"></div>
    </span>
    <div class="container h-100 position-relative">
        <div class="col-12 col-md-8 col-lg-6 h-100">
            <!-- <a href="https://www.modena.com/" class="link-banner"><span><i class="fi fi-rr-arrow-small-left"></i></span> Kembali ke halaman utama</a> -->
            <div class="flex-center h-100">
                <span>
                    <h1 class="text-s-bold-28 c-white"><img src="{{asset('frontend/assets/images/bravalogo.png')}}" alt="MODENA Agent" style="width:350px;margin-left:-15px"></h1>
                    <p class="text-reg-18 c-white mb-4">Spare Parts and Accessories Product <br />for your Home Appliances
</p>
                    <center><img src="{{asset('frontend/assets/images/ordernow.png')}}" style="max-width: 120px;" alt=""></center>
                </span>    
            </div>
        </div>
    </div>
</div>
<!-- 
<section id="testimonial" class="section bg-gray">
    <div class="container">
        <div class="row mb-4 mb-md-5">
            <div class="col-12 text-center">
                <h3 class="d-block text-bold-38"><img src="{{asset('frontend/assets/images/getproduct.png')}}" /></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 pb-5">
                <div class="slider-testimonial">
                    <div class="slider-testimonial-item">
                        <div class="slider-testimonial-item-image match d-none d-lg-inline-block" style="width:100%;background-image: url('{{asset('frontend/assets/images/slider1.png')}}');"></div>
                       
                    </div>
                    <div class="slider-testimonial-item">
                        <div class="slider-testimonial-item-image match d-none d-lg-inline-block" style="width:100%;background-image: url('{{asset('frontend/assets/images/slider2.png')}}');"></div>
                        
                    </div>
                    <div class="slider-testimonial-item">
                        <div class="slider-testimonial-item-image match d-none d-lg-inline-block" style="width:100%;background-image: url('{{asset('frontend/assets/images/slider3.png')}}');"></div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section id="benefit" class="section bg-bluejeans">
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-12 col-lg-8 text-center title-logo">
                <h5 class="text-s-bold-32"><img src="{{asset('frontend/assets/images/getproduct.png')}}" style="width:400px" /></h5>
                
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-9">
                <div class="row justify-content-center">
                    <div class="col-6 col-lg-4">
                        <div class="card card-benefit text-center match" style="background:none;border:none;padding:0px !Important;height:auto;padding:0px !Important;height:auto">
                        <img src="{{asset('frontend/assets/images/slider1.png')}}" />
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="card card-benefit text-center match"  style="background:none;border:none;padding:0px !Important;height:auto">
                        <img src="{{asset('frontend/assets/images/slider2.png')}}" />
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="card card-benefit text-center match" style="background:none;border:none;padding:0px !Important;height:auto" >
                        <img src="{{asset('frontend/assets/images/slider3.png')}}" />
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center mt-4">
                <center>
                <img src="{{asset('frontend/assets/images/durability.png')}}" style="width:100%;" />
                </center>
            </div>
        </div>
    </div>
</section>


@include('frontend.pages.home.popup')
@include('frontend.partials.loading')

@endsection

@push('scripts')

@endpush