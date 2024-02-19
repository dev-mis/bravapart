<script>
    var KTAppSettings = {
        "breakpoints": {
        "sm": 576,
        "md": 768,
        "lg": 992,
        "xl": 1200,
        "xxl": 1400
        },
        "colors": {
        "theme": {
            "base": {
                "white": "#ffffff",
                "primary": "#3699FF",
                "secondary": "#E5EAEE",
                "success": "#1BC5BD",
                "info": "#8950FC",
                "warning": "#FFA800",
                "danger": "#35C6F9",
                "light": "#E4E6EF",
                "dark": "#181C32"
            },
            "light": {
                "white": "#ffffff",
                "primary": "#E1F0FF",
                "secondary": "#EBEDF3",
                "success": "#C9F7F5",
                "info": "#EEE5FF",
                "warning": "#FFF4DE",
                "danger": "#FFE2E5",
                "light": "#F3F6F9",
                "dark": "#D6D6E0"
            },
            "inverse": {
                "white": "#ffffff",
                "primary": "#ffffff",
                "secondary": "#3F4254",
                "success": "#ffffff",
                "info": "#ffffff",
                "warning": "#ffffff",
                "danger": "#ffffff",
                "light": "#464E5F",
                "dark": "#ffffff"
            }
        },
        "gray": {
            "gray-100": "#F3F6F9",
            "gray-200": "#EBEDF3",
            "gray-300": "#E4E6EF",
            "gray-400": "#D1D3E0",
            "gray-500": "#B5B5C3",
            "gray-600": "#7E8299",
            "gray-700": "#5E6278",
            "gray-800": "#3F4254",
            "gray-900": "#181C32"
        }
        },
        "font-family": "Inter"
    };
</script>

<script src="{{ asset('backend/plugins/global/plugins.bundle.min.js?v=7.0.6') }}"></script>
<script src="{{ asset('backend/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6') }}"></script>
<script src="{{ asset('backend/js/scripts.bundle.min.js?v=7.0.6') }}"></script>
<script src="{{ asset('backend/plugins/custom/datatables/datatables.bundle.min.js?v=7.0.6') }}"></script>
<script>
    $(document).ready(function() {
        $('.file-input').change(function(){
            readImgUrlAndPreview(this);
            function readImgUrlAndPreview(input){
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $(input).parent().find('.file-preview').attr('src', e.target.result);
                        $(input).parent().find('.file-preview').css('opacity', 1);
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        });
    })
    
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    @php
        $flashMes = flash();
    @endphp
    @if(!empty($flashMes))
        toastr.{{ $flashMes["type"] }}('{{ $flashMes["title"] }}', '{{ $flashMes["message"] }}');
    @endif
</script>