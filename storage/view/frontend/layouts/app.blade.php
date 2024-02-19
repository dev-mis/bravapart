<!DOCTYPE html>
<html lang="en">
    <head>
        {{-- Required meta tags --}}
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ seo()['title'] ?? '' }}</title>

        <meta name="title" content="{{ seo()['title'] ?? '' }}" />
        <meta name="description" content="{{ seo()['description'] ?? '' }}" />
        <meta name="keywords" content="peluang bisnis, peluang usaha, modal usaha, usaha modal kecil, Modena Indonesia">

        {{-- Favicon --}}
        <link rel="apple-touch-icon" sizes="76x76" href="{{asset('frontend/assets/images/favicon/apple-touch-icon.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('frontend/assets/images/favicon/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('frontend/assets/images/favicon/favicon-16x16.png')}}">
        <link rel="manifest" href="{{asset('frontend/assets/images/favicon/site.webmanifest')}}">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

        {{-- Assets --}} 
        <link href="{{ asset('frontend/dist/style/apps.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/dist/style/uicons.css') }}" rel="stylesheet">

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-P7N6H09YCQ"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-P7N6H09YCQ');
        </script>
    </head>
    <body>
        
        @include('frontend.layouts.header')
        
        <main>

            @yield('content')

        </main>

        @include('frontend.layouts.footer')
        
        @include('frontend.layouts.script')
        
    </body>
</html>