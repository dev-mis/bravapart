
$( document ).ready(function() {

    "use strict";
    
    $('.match').matchHeight();

    $('#bank_name').select2({
        placeholder: "Pilih Bank",
        allowClear: true
    });
    $('#province').select2({
        placeholder: "Pilih provinsi",
        allowClear: true
    });
    $('#city').select2({
        placeholder: "Pilih kota",
        allowClear: true
    });
    $('#district').select2({
        placeholder: "Pilih kecamatan",
        allowClear: true
    });
    $('#village').select2({
        placeholder: "Pilih kelurahan",
        allowClear: true
    });
    $('#postal_code').select2({
        placeholder: "Pilih kode pos",
        allowClear: true
    });

    $('#identity_number, #bank_account_number, #tax_number').mask('0000000000000000');
    $('#phone_number').mask('0000000000000');

    $('#triggerPopup').fancybox({
        src: '#popupTnc',
        closeEffect: 'none',
        clickSlide: false,
        touch: false 
    });

    $('#closePopup').on('click', function(){
        if( $('#agreeing').is(':checked') ) {
        } else {
            $("input[type='checkbox']").click();
        }
        $.fancybox.close(); 
    });

    $('.close-popups').on('click', function() {
        $.fancybox.close(); 
    });

    $('#backToFirst').on('click', function() {
        $('#firstForm').addClass('active-form');
        $('#secondForm').removeClass('active-form-animate');

        setTimeout(function() { 
            $('#secondForm').removeClass('active-form');
        }, 400);
        setTimeout(function() { 
            $('#firstForm').addClass('active-form-animate');
        }, 800);

        $('.form-indicator-second').removeClass('active');
        $('.form-indicator-first').removeClass('success');
        $('.form-indicator-first').addClass('active');            
    });
    $('#backToSecond').on('click', function() {
        $('#secondForm').addClass('active-form');
        $('#thirdForm').removeClass('active-form-animate');

        setTimeout(function() { 
            $('#thirdForm').removeClass('active-form');
        }, 400);
        setTimeout(function() { 
            $('#secondForm').addClass('active-form-animate');
        }, 800);


        $('.form-indicator-third').removeClass('active');
        $('.form-indicator-second').removeClass('success');
        $('.form-indicator-second').addClass('active');         
    });

    $(document).on('change', ".file-input", function () {
        var inputIs = $(this).parent().parent().parent().find('input[type="hidden"]');
        inputIs.removeClass('is-invalid');
        inputIs.parent().find('.text-danger').remove();
    
        var attrName = $(this).attr('name');
    
        if(this.files[0].size > (5 * 1024 * 1024)){
            $(this).parent().parent().parent().find('input[type="hidden"]').addClass('is-invalid');
            $(this).parent().parent().parent().find('input[type="hidden"]').parent().append('<span class="text-danger">Ukuran file terlalu besar, pastikan file di bawah 5MB!</span>');
    
            $(this).replaceWith('<input type="file" name="'+attrName+'" class="file-input" accept="image/jpeg, image/png, image/jpg"/>');
            return false;
        }
    
        !(function (e) {
            if (e.files && e.files[0]) {
                var t = new FileReader();
                t.onload = function (t) {
                    $(e).parent().find(".file-preview").attr("src", t.target.result), $(e).parent().find(".file-preview").css("opacity", 1), $(e).parent().parent().parent().find('input[type="hidden"]').val(1);
                };
            }
            t.readAsDataURL(e.files[0]);
        })(this);
    })
});