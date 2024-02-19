<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="icon" type="image/png" href="{{ asset('backend/media/favicon.png') }}">

<link href="{{ asset('backend/plugins/global/plugins.bundle.min.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('backend/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('backend/css/style.bundle.min.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('backend/plugins/custom/datatables/datatables.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
<style>
    .form-group__file {
        display: flex;
        flex-direction: column;
        position: relative;
        width: 100%;
        min-width: 130px;
        height: 240px;
    }

    .file-wrapper {
        position: relative;
    }

    .file-label {
        margin: 10px 0;
    }

    .file-input {
        opacity: 0;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 240px;
        cursor: pointer;
        z-index: 100;
    }

    .file-preview-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 240px;
        border: 1px solid #E4E6EF;
        border-radius: 14px;
        text-transform: uppercase;
        font-size: 70px;
        letter-spacing: 3px;
        text-align: center;
        color: #bbb;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1;
    }

    .file-preview {
        width: 100%;
        height: 240px;
        position: absolute;
        top: 0;
        left: 0;
        border-radius: 10px;
        z-index: 10;
        object-fit: cover;
        opacity: 0;
        transition: opacity 0.4s ease-in;
    }
</style>