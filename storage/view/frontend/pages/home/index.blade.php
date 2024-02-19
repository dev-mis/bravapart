@extends('frontend.layouts.app')

@section('content')

@if(!empty($headerBanner))
<div class="banner">
    <span>
        <div class="banner-image desktop" style="background-image: url('{{ $headerBanner->image->path ?? '#' }}');"></div>
        <div class="banner-image mobile" style="background-image: url('{{ $headerBanner->imageMobile->path ?? '#' }}'); display: none;"></div>
    </span>
    <div class="container h-100 position-relative">
        <div class="col-12 col-md-8 col-lg-6 h-100">
            <a href="https://www.modena.com/" class="link-banner"><span><i class="fi fi-rr-arrow-small-left"></i></span> Kembali ke halaman utama</a>
            <div class="flex-center h-100">
                <span>
                    <h1 class="text-s-bold-28 c-white">{{ $headerBanner->title }}</h1>
                    <p class="text-reg-18 c-white mb-4">{!! $headerBanner->description !!}</p>
                    <img src="{{asset('frontend/assets/images/funancial.svg')}}" style="max-width: 340px;" alt="">
                </span>    
            </div>
        </div>
    </div>
</div>
@endif

<section id="benefit" class="section bg-bluejeans">
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-12 col-lg-8 text-center title-logo">
                <h5 class="text-s-bold-32">Benefit</h5>
                <span class="d-block mb-4 mb-md-5">
                    <h2 class="d-inline-block text-med-42 mb-0">Be a</h2>
                    <img src="{{asset('frontend/assets/images/logo-modena-agent.svg')}}" class="ms-2" alt="MODENA Agent">
                </span>
                <p class="text-reg-18 mb-3">Berdiri sejak 1960, MODENA merupakan salah satu pemimpin pasar dalam industri Home Appliances dengan lebih dari jutaan produk terjual. Anda akan mendapatkan bimbingan dan dukungan penuh untuk menjadi seorang MODENA Agent.</p>
                <p class="text-reg-18 mb-5">Daftar sekarang dan dapatkan penghasilan tambahan dengan mudah kapan pun, di mana pun.</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-9">
                <div class="row justify-content-center">
                    <div class="col-6 col-lg-4">
                        <div class="card card-benefit text-center match">
                            <div class="card-icon">
                                <img src="{{asset('frontend/assets/images/mark.svg')}}" alt="">
                            </div>
                            <span>
                                <h5 class="text-med-24 d-inline-block c-black">Komisi</h5>
                                <h2 class="text-bold-24 d-inline-block c-grad-purple">5%</h2>
                            </span>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="card card-benefit text-center match">
                            <div class="card-icon">
                                <img src="{{asset('frontend/assets/images/mark.svg')}}" alt="">
                            </div>
                            <span>
                                <h5 class="text-med-24 d-block c-black">Dibayarkan</h5>
                                <h2 class="text-bold-24 d-block c-grad-purple">Perbulan</h2>
                            </span>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="card card-benefit text-center match">
                            <div class="card-icon">
                                <img src="{{asset('frontend/assets/images/mark.svg')}}" alt="">
                            </div>
                            <span>
                                <h2 class="text-bold-24 d-inline-block c-grad-purple">Tanpa</h2>
                                <h5 class="text-med-24 d-inline-block c-black">Target</h5>
                            </span>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="card card-benefit text-center match">
                            <div class="card-icon">
                                <img src="{{asset('frontend/assets/images/mark.svg')}}" alt="">
                            </div>
                            <span>
                                <h2 class="text-bold-24 d-inline-block c-grad-purple">Bonus</h2>
                                <h5 class="text-med-24 d-inline-block c-black">Komisi</h5>
                            </span>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="card card-benefit text-center match">
                            <div class="card-icon">
                                <img src="{{asset('frontend/assets/images/mark.svg')}}" alt="">
                            </div>
                            <span>
                                <h2 class="text-med-24 d-block c-black">Jaringan</h2>
                                <h5 class="text-bold-24 d-block c-grad-purple">Bisnis Luas</h5>
                            </span>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="card card-benefit text-center match">
                            <div class="card-icon">
                                <img src="{{asset('frontend/assets/images/mark.svg')}}" alt="">
                            </div>
                            <span>
                                <h2 class="text-med-24 c-black">Proses</h2>
                                <h5 class="text-bold-24 c-grad-purple">Mudah & Transparan</h5>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center mt-4">
                <a href="javascript:;" data-fancybox data-src="#tnc" class="link">Syarat dan Ketentuan MODENA Agent</a>
            </div>
        </div>
    </div>
</section>

<section id="how" class="section">
    <div class="container">
        <div class="row mx-2">
            <div class="col-12 col-lg-6 col-xl-4">
                <span class="d-block mb-3">
                    <h2 class="d-inline-block text-bold-38 mb-0">Langkah Mudah Menjadi <span class="d-inline-block"><img src="{{asset('frontend/assets/images/logo-modena-agent.svg')}}" class="ms-2 d-inline-block" alt="MODENA Agent"></span></h2>
                </span>
            </div>
            <div class="col-12 col-lg-8 d-none">
                <p class="text-reg-18">Mulai dari saudara, kawan, teman kantor sebelah meja atau siapa pun yang butuh peralatan untuk rumah barunya. Kemudahan berbagi informasi ​seputar rumah yang ternyata juga bisa jadi solusi untuk mengisi peralatan rumah anda.​</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="slider-how-to mt-5">
                    <div class="card-how match">
                        <span class="d-block mb-3">
                            <img src="{{asset('frontend/assets/images/Siapkan-syarat.svg')}}" alt="">
                        </span>
                        <h4 class="text-bold-18 c-black">Siapkan Kelengkapan Data</h4>
                        <p class="text-reg-16 c-dgray">Cek di bawah untuk mengetahui data yang dibutuhkan.</p>
                        <i class="fi  fi-rr-arrow-small-right"></i>
                    </div>
                    <div class="card-how match">
                        <span class="d-block mb-3">
                            <img src="{{asset('frontend/assets/images/Isi-form-pendaftaran.svg')}}" alt="">
                        </span>
                        <h4 class="text-bold-18 c-black">Isi Form Pendaftaran</h4>
                        <p class="text-reg-16 c-dgray">Lengkapi data diri sesuai kartu identitas dan dokumen yang berlaku.</p>
                        <i class="fi  fi-rr-arrow-small-right"></i>
                    </div>
                    <div class="card-how match">
                        <span class="d-block mb-3">
                            <img src="{{asset('frontend/assets/images/Verifikasi-admin.svg')}}" alt="">
                        </span>
                        <h4 class="text-bold-18 c-black">Verifikasi Admin</h4>
                        <p class="text-reg-16 c-dgray">Admin akan mengecek data anda dalam maks. 3x24 jam.</p>
                        <i class="fi  fi-rr-arrow-small-right"></i>
                    </div>
                    <div class="card-how match">
                        <span class="d-block mb-3">
                            <img src="{{asset('frontend/assets/images/Sukses.svg')}}" alt="">
                        </span>
                        <h4 class="text-bold-18 c-black">Pendaftaran Berhasil</h4>
                        <p class="text-reg-16 c-dgray">Anda akan menerima notifikasi email terkait status pendaftaran anda.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <div class="card-standard mx-4">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-8">
                            <h5 class="text-bold-18 c-black mb-4">Syarat menjadi MODENA Agent:</h5>
                            <ul class="list-custom d-inline-block c-dgray text-med-16">
                                <li>KTP.</li>
                                <li>NPWP.</li>
                            </ul>
                            <ul class="d-inline-block c-dgray text-med-16">
                                <li>Buku Tabungan.</li>
                                <li>Nomor rekening (sesuai nama yang terdaftar di KTP).</li>
                                <li>Mengisi form pendaftaran dan berhasil menjadi MODENA Agent.</li>
                                <li>Memiliki smartphone.​​​​​​​</li>
                                <li>Tidak memiliki hubungan keluarga (dalam 1 Kartu Keluarga) dengan karyawan Modena yang berada dalam departemen Business Development (Sales).</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="testimonial" class="section bg-gray">
    <div class="container">
        <div class="row mb-4 mb-md-5">
            <div class="col-12 text-center">
                <h3 class="d-block text-bold-38">Testimonial</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 pb-5">
                <div class="slider-testimonial">
                    @foreach ($testimonial as $key => $val)
                    <div class="slider-testimonial-item">
                        <div class="slider-testimonial-item-image match d-none d-lg-inline-block" style="background-image: url('{{ $val->image->path }}');"></div>
                        <div class="slider-testimonial-item-content position-relative match">
                            <p class="text-italic-16 mb-4">“{{ $val->review }}”</p>
                            <div class="slider-testimonial-item-image d-inline-block d-lg-none" style="background-image: url('{{ $val->image->path }}');"></div>
                            <span>
                                <h6 class="text-bold-14 mb-1">{{ $val->name }}</h6>
                                <p class="text-reg-14 mb-0">{{ $val->occupation }}</p>
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section id="form" class="section" style="background: #F3F7FC;">
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-12 col-lg-6 col-xl-4 text-start text-md-center">
                <h2 class="d-inline-block text-bold-38 mb-0">Daftarkan <br> sebagai <span class="d-inline-block"><img src="{{asset('frontend/assets/images/logo-modena-agent.svg')}}" class="ms-2 d-inline-block" alt="MODENA Agent"></span></h2>
            </div>
        </div>
        <div class="row justify-content-center mb-5">
            <div class="col-12 col-lg-8 text-start text-md-center">
                <p class="text-reg-18">Selangkah lebih dekat dengan komisi penjualan, diskon ekstra, dan keuntungan lainnya</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-9">
                <form id="register" class="form" action="{{ url('store') }}">
                    
                    <div class="form-card">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-4">
                                <h3 class="c-black text-s-bold-28 text-center text-md-start">Form Pendaftaran</h3>
                            </div>
                            <div class="col-12 col-md-6 text-start text-md-end">
                                <ul class="form-indicator text-center text-md-end">
                                    <li class="form-indicator-first active"><a href="javascript:;"></a></li>
                                    <li class="form-indicator-second"><a href="javascript:;"></a></li>
                                    <li class="form-indicator-third"><a href="javascript:;"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div id="firstForm" class="form-item mt-4 active-form active-form-animate">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label text-s-bold-14">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Ketik Nama" onkeydown="return /[a-z ]/i.test(event.key)">
                                    </div>                                      
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="identity_number" class="form-label text-s-bold-14">No KTP</label>
                                        <input type="text" class="form-control" id="identity_number" name="identity_number" placeholder="Ketik No KTP">
                                    </div>                                      
                                </div>
                            </div>
                            {{-- <div class="d-flex">
                                <div class="mb-4">
                                    <div class="g-recaptcha" data-sitekey="{{ env('NOCAPTCHA_SITEKEY') }}"></div>
                                </div>
                            </div> --}}
                            <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <a href="javascript:;" id="submitFirstForm" class="button-primary">Selanjutnya</a>
                                </div>
                            </div>
                        </div>

                        <div id="secondForm" class="form-item mt-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label text-s-bold-14">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama" disabled>
                                    </div>  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="identity_number" class="form-label text-s-bold-14">No KTP</label>
                                        <input type="text" class="form-control" id="identity_number" name="identity_number" placeholder="No KTP" disabled>
                                    </div>         
                                    <div class="form-group mb-3">
                                        <label class="form-label text-s-bold-14 mb-0">Upload Foto KTP</label>
                                        <span class="d-block mb-2">* Ukuran maksimal foto yang diupload 5Mb</span>
                                        <div class="form-group picture_upload col-md-12">
                                            <div class="form-group__file">
                                                <div class="file-wrapper">
                                                    <input type="file" name="identity_card" class="file-input" accept="image/jpeg, image/png, image/jpg"/>
                                                    <div class="file-preview-background">+</div>
                                                    <img src="" class="file-preview"/>
                                                </div>
                                            </div>
                                            <input type="hidden" name="is_identity_card" value="0">
                                        </div>
                                    </div>                                  
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="tax_number" class="form-label text-s-bold-14">No NPWP</label>
                                        <input type="text" class="form-control" id="tax_number" name="tax_number" placeholder="No NPWP">
                                    </div>           
                                    <div class="form-group mb-3">
                                        <label class="form-label text-s-bold-14 mb-0">Upload Foto NPWP</label>
                                        <span class="d-block mb-2">* Ukuran maksimal foto yang diupload 5Mb</span>
                                        <div class="form-group picture_upload col-md-12">
                                            <div class="form-group__file">
                                                <div class="file-wrapper">
                                                    <input type="file" name="tax_card" class="file-input" accept="image/jpeg, image/png, image/jpg"/>
                                                    <div class="file-preview-background">+</div>
                                                    <img src="" class="file-preview"/>
                                                </div>
                                            </div>
                                            <input type="hidden" name="is_tax_card" value="0">
                                        </div>
                                    </div>                              
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="bank_account_name" class="form-label text-s-bold-14">Nama Pemilik Rekening</label>
                                        <input type="text" class="form-control" id="bank_account_name" name="bank_account_name" placeholder="Nama Pemilik Rekening" onkeydown="return /[a-z ]/i.test(event.key)">
                                    </div>  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="bank" class="form-label text-s-bold-14">Bank</label>
                                        <select class="select2" name="bank_name" id="bank_name">
                                            <option value=""></option>
                                            @foreach ($banks as $key => $val)
                                                <option value="{{ $val->id }}">{{ $val->code }} - {{ $val->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>                                      
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="bank_account_number" class="form-label text-s-bold-14">No Rekening</label>
                                        <input type="text" class="form-control" id="bank_account_number" name="bank_account_number" placeholder="Ketik No Rekening">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12">    
                                    <div class="form-group mb-3">
                                        <label class="form-label text-s-bold-14 mb-0">Upload Buku Tabungan/Bank Account</label>
                                        <span class="d-block mb-2">* Ukuran maksimal foto yang diupload 5Mb</span>
                                        <div class="form-group picture_upload col-md-12">
                                            <div class="form-group__file">
                                                <div class="file-wrapper">
                                                    <input type="file" name="saving_book" class="file-input" accept="image/jpeg, image/png, image/jpg"/>
                                                    <div class="file-preview-background">+</div>
                                                    <img src="" class="file-preview"/>
                                                </div>
                                            </div>
                                            <input type="hidden" name="is_saving_book" value="0">
                                        </div>
                                    </div>                              
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 text-center"> 
                                    <a href="javascript:;" id="backToFirst" class="button-secondary">Kembali</a>
                                    <a href="javascript:;" id="submitSecondForm" class="button-primary ms-2 ms-md-4">Selanjutnya</a>
                                </div>
                            </div>
                        </div>

                        <div id="thirdForm" class="form-item mt-4">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label text-s-bold-14">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Ketik Email Anda" pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/">
                                    </div>                                      
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="phone_number" class="form-label text-s-bold-14">No Handphone</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Ketik No Handphone">
                                    </div>                                      
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="address" class="form-label text-s-bold-14">Alamat</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Ketik Alamat Anda">
                                    </div>                                      
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="province" class="form-label text-s-bold-14">Pilih Provinsi</label>
                                        <select class="select2" name="province" id="province">
                                            <option></option>
                                        </select>
                                    </div>                                    
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="city" class="form-label text-s-bold-14">Pilih Kota</label>
                                        <select class="select2" name="city" id="city" disabled>
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="district" class="form-label text-s-bold-14">Pilih Kecamatan</label>
                                        <select class="select2" name="district" id="district" disabled>
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="village" class="form-label text-s-bold-14">Pilih Kelurahan</label>
                                        <select class="select2" name="village" id="village" disabled>
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="postal_code" class="form-label text-s-bold-14">Pilih Kode Pos</label>
                                        <select class="select2" name="postal_code" id="postal_code" disabled>
                                            <option></option>
                                        </select>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check mt-3">
                                        <a href="javascript:;" id="triggerPopup">
                                            <input class="form-check-input" type="checkbox" name="agree" value="yes" id="agreeing">
                                            <label class="form-check-label" for="agreeing">
                                                Dengan ini saya bersedia menyetujui segala <span class="link-standard">syarat dan ketentuan</span> dalam pelaksanaan MODENA Agent dan tunduk dalam peraturan yang ditetapkan MODENA Indonesia.
                                            </label>
                                        </a>
                                    </div>                                      
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 text-center"> 
                                    <a href="javascript:;" id="backToSecond" class="button-secondary">Kembali</a>
                                    <a href="javascript:" id="submitThirdForm" class="button-primary ms-2 ms-md-4">Kirim</a>

                                    <button type="hidden" class="d-none"></button>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>

@include('frontend.pages.home.popup')
@include('frontend.partials.loading')

@endsection

@push('scripts')
<script>
    $('#register').submit(function(e){
        e.preventDefault();

        var activeForm = $('.active-form');
    
        if(activeForm.attr('id') == 'firstForm'){
            $('#submitFirstForm').click();
        }else if(activeForm.attr('id') == 'secondForm'){
            $('#submitSecondForm').click();
        }else if(activeForm.attr('id') == 'thirdForm'){
            $('#submitThirdForm').click();
        }
    });
    
    $('#submitFirstForm').on('click', function(){
        var name = $("#firstForm").find('input[name="name"]');
        var identity_number = $("#firstForm").find('input[name="identity_number"]');

        name.removeClass('is-invalid');
        identity_number.removeClass('is-invalid');

        name.parent().find('.text-danger').remove();
        identity_number.parent().find('.text-danger').remove();

        $.ajax({
            type: "POST",
            url: "{{ url('first-validation') }}",
            data: {
                "name": name.val(),
                "identity_number": identity_number.val(),
            },
            success:function(data) {
                $('#firstForm').removeClass('active-form-animate');
                $('#secondForm').addClass('active-form');

                setTimeout(function() { 
                    $('#firstForm').removeClass('active-form');
                }, 400);
                setTimeout(function() { 
                    $('#secondForm').addClass('active-form-animate');
                }, 800);

                $('.form-indicator-first').removeClass('active');
                $('.form-indicator-first').addClass('success');
                $('.form-indicator-second').addClass('active');

                $('#secondForm').find('input[name="name"]').val(name.val());
                $('#secondForm').find('input[name="identity_number"]').val(identity_number.val());
            },
            error:function(data) {
                var json = data.responseJSON;

                var message = json.message;

                $.each(message, function(k, v){
                    $("#firstForm").find('input[name="'+k+'"]').addClass('is-invalid');
                    $("#firstForm").find('input[name="'+k+'"]').parent().append('<span class="text-danger">'+v+'</span>')
                });
            }
        });
    });

    $('#submitSecondForm').on('click', function(){
        var tax_number = $("#secondForm").find('input[name="tax_number"]');
        var is_identity_card = $("#secondForm").find('input[name="is_identity_card"]');
        var is_tax_card = $("#secondForm").find('input[name="is_tax_card"]');
        var bank_account_name = $("#secondForm").find('input[name="bank_account_name"]');
        var bank_name = $("#secondForm").find('select[name="bank_name"]');
        var bank_account_number = $("#secondForm").find('input[name="bank_account_number"]');
        var is_saving_book = $("#secondForm").find('input[name="is_saving_book"]');

        tax_number.removeClass('is-invalid');
        is_identity_card.removeClass('is-invalid');
        is_tax_card.removeClass('is-invalid');
        bank_account_name.removeClass('is-invalid');
        bank_name.removeClass('is-invalid');
        bank_account_number.removeClass('is-invalid');
        is_saving_book.removeClass('is-invalid');

        tax_number.parent().find('.text-danger').remove();
        is_identity_card.parent().find('.text-danger').remove();
        is_tax_card.parent().find('.text-danger').remove();
        bank_account_name.parent().find('.text-danger').remove();
        bank_name.parent().find('.text-danger').remove();
        bank_account_number.parent().find('.text-danger').remove();
        is_saving_book.parent().find('.text-danger').remove();

        $.ajax({
            type: "POST",
            url: "{{ url('second-validation') }}",
            data: {
                "tax_number": tax_number.val(),
                "is_identity_card": is_identity_card.val(),
                "is_tax_card": is_tax_card.val(),
                "bank_account_name": bank_account_name.val(),
                "bank_name": bank_name.find('option:selected').val(),
                "bank_account_number": bank_account_number.val(),
                "is_saving_book": is_saving_book.val(),
            },
            success:function(data) {
                $('#secondForm').removeClass('active-form-animate');
                setTimeout(function() { 
                    $('#secondForm').removeClass('active-form');
                }, 400);

                $('#thirdForm').addClass('active-form');
                setTimeout(function() { 
                    $('#thirdForm').addClass('active-form-animate');
                }, 800);

                $('.form-indicator-second').removeClass('active');
                $('.form-indicator-second').addClass('success');
                $('.form-indicator-third').addClass('active');
            },
            error:function(data) {
                var json = data.responseJSON;

                var message = json.message;

                $.each(message, function(k, v){
                    if(k == 'bank_name'){
                        $("#secondForm").find('select[name="'+k+'"]').addClass('is-invalid');
                        $("#secondForm").find('select[name="'+k+'"]').parent().append('<span class="text-danger">'+v+'</span>')
                    }else{
                        $("#secondForm").find('input[name="'+k+'"]').addClass('is-invalid');
                        $("#secondForm").find('input[name="'+k+'"]').parent().append('<span class="text-danger">'+v+'</span>')
                    }
                });
            }
        });
    });

    $('#submitThirdForm').on('click', function(){
        var email = $("#thirdForm").find('input[name="email"]');
        var phone_number = $("#thirdForm").find('input[name="phone_number"]');
        var address = $("#thirdForm").find('input[name="address"]');
        var province = $("#thirdForm").find('select[name="province"]');
        var city = $("#thirdForm").find('select[name="city"]');
        var district = $("#thirdForm").find('select[name="district"]');
        var village = $("#thirdForm").find('select[name="village"]');
        var postal_code = $("#thirdForm").find('select[name="postal_code"]');
        var agree = $("#thirdForm").find('input[name="agree"]:checked');

        email.removeClass('is-invalid');
        phone_number.removeClass('is-invalid');
        address.removeClass('is-invalid');
        province.removeClass('is-invalid');
        city.removeClass('is-invalid');
        district.removeClass('is-invalid');
        village.removeClass('is-invalid');
        postal_code.removeClass('is-invalid');
        agree.removeClass('is-invalid');

        email.parent().find('.text-danger').remove();
        phone_number.parent().find('.text-danger').remove();
        address.parent().find('.text-danger').remove();
        province.parent().find('.text-danger').remove();
        city.parent().find('.text-danger').remove();
        district.parent().find('.text-danger').remove();
        village.parent().find('.text-danger').remove();
        postal_code.parent().find('.text-danger').remove();
        agree.parent().find('.text-danger').remove();

        $.ajax({
            type: "POST",
            url: "{{ url('third-validation') }}",
            data: {
                "email": email.val(),
                "phone_number": phone_number.val(),
                "address": address.val(),
                "province": province.find('option:selected').val(),
                "city": city.find('option:selected').val(),
                "district": district.find('option:selected').val(),
                "village": village.find('option:selected').val(),
                "postal_code": postal_code.find('option:selected').val()
                // "agree": agree.val(),
            },
            success:function(data) {
                if(agree.val() == null){
                    $.fancybox.open({
                        src: '#popupTnc',
                        clickSlide: false, 
                        touch: false 
                    });

                    return;
                }
                
                var form = $('form#register');
                var action = form.attr('action');
                var formData = new FormData(form[0]);

                $('.loading').fadeIn();

                $.ajax({
                    url: action,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data){
                        var result = data;
                        var modal = $('#success-popup');

                        $('.loading').fadeOut();
                        modal.fancybox({
                            clickSlide: false,
                            touch: false,
                            afterClose  : function () {
                                parent.location.reload(true);
                            } 
                        }).trigger('click');

                        if(data.redirect != null){
                            window.location.replace(data.redirect);
                        }
                    },
                    error: function(data){
                        var result = data.responseJSON;
                    }
                })
            },
            error:function(data) {
                var json = data.responseJSON;

                var message = json.message;

                $.each(message, function(k, v){
                    if(k == 'province' || k == 'city' || k == 'district' || k == 'village' || k == 'postal_code'){
                        $("#thirdForm").find('select[name="'+k+'"]').addClass('is-invalid');
                        $("#thirdForm").find('select[name="'+k+'"]').parent().append('<span class="text-danger">'+v+'</span>')
                    }else{
                        $("#thirdForm").find('input[name="'+k+'"]').addClass('is-invalid');
                        $("#thirdForm").find('input[name="'+k+'"]').parent().append('<span class="text-danger">'+v+'</span>')
                    }
                });
            }
        });
    });

    $(document).ready(function() {

        $.ajax({
            type: "POST",
            url: "{{ url('get-provinces') }}",
            success:function(data) {
                $('#thirdForm').find('select[name="city"]').html('<option value=""></option>');
                $('#thirdForm').find('select[name="district"]').html('<option value=""></option>');
                $('#thirdForm').find('select[name="village"]').html('<option value=""></option>');
                $('#thirdForm').find('select[name="postal_code"]').html('<option value=""></option>');

                var select = $('#thirdForm').find('select[name="province"]');

                var html = '<option value=""></option>';
                $.each(data, function(k, v){
                    html += '<option value="'+v.id+'">'+v.province_name+'</option>'
                })

                select.html(html);
            },
        });

        $('#thirdForm').find('select[name="province"]').on('change', function(){
            var provinceId = $(this).find('option:selected').val();

            $('select[name="city"]').prop("disabled", false);

            $.ajax({
                type: "POST",
                url: "{{ url('get-cities') }}/"+provinceId,
                success:function(data) {
                    $('#thirdForm').find('select[name="district"]').html('<option value=""></option>');
                    $('#thirdForm').find('select[name="village"]').html('<option value=""></option>');
                    $('#thirdForm').find('select[name="postal_code"]').html('<option value=""></option>');

                    var select = $('#thirdForm').find('select[name="city"]');

                    var html = '<option value=""></option>';
                    $.each(data, function(k, v){
                        html += '<option value="'+v.id+'">'+v.city_name+'</option>'
                    })

                    select.html(html);
                },
            });
        })

        $('#thirdForm').find('select[name="city"]').on('change', function(){
            var cityId = $(this).find('option:selected').val();

            $('select[name="district"]').prop("disabled", false);

            $.ajax({
                type: "POST",
                url: "{{ url('get-districts') }}/"+cityId,
                success:function(data) {
                    $('#thirdForm').find('select[name="village"]').html('<option value=""></option>');
                    $('#thirdForm').find('select[name="postal_code"]').html('<option value=""></option>');

                    var select = $('#thirdForm').find('select[name="district"]');

                    var html = '<option value=""></option>';
                    $.each(data, function(k, v){
                        html += '<option value="'+v.id+'">'+v.district_name+'</option>'
                    })

                    select.html(html);
                },
            });
        })

        $('#thirdForm').find('select[name="district"]').on('change', function(){
            var districtId = $(this).find('option:selected').val();

            $('select[name="village"]').prop("disabled", false);

            $.ajax({
                type: "POST",
                url: "{{ url('get-villages') }}/"+districtId,
                success:function(data) {
                    $('#thirdForm').find('select[name="postal_code"]').html('<option value=""></option>');

                    var select = $('#thirdForm').find('select[name="village"]');

                    var html = '<option value=""></option>';
                    $.each(data, function(k, v){
                        html += '<option value="'+v.id+'">'+v.village_name+'</option>'
                    })

                    select.html(html);
                },
            });
        })

        $('#thirdForm').find('select[name="village"]').on('change', function(){
            var villageId = $(this).find('option:selected').val();

            $('select[name="postal_code"]').prop("disabled", false);

            $.ajax({
                type: "POST",
                url: "{{ url('get-postal-code') }}/"+villageId,
                success:function(data) {
                    var select = $('#thirdForm').find('select[name="postal_code"]');

                    var html = '<option value=""></option>';
                    $.each(data, function(k, v){
                        html += '<option value="'+v.id+'">'+v.postal_code+'</option>'
                    })

                    select.html(html);
                },
            });
        })

        
        $('#popupClose').on('click', function(){
            $.fancybox.close(); 
        });
    });

</script>
@endpush