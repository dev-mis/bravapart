<!DOCTYPE html>
<html lang="en">
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Brava Parts</title>

        <meta name="title" content="Brava Parts" />
        <meta name="description" content="<?php echo \Hyperf\ViewEngine\T::e(seo()['description'] ?? ''); ?>" />
        <meta name="keywords" content="peluang bisnis, peluang usaha, modal usaha, usaha modal kecil, Modena Indonesia">

        
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo \Hyperf\ViewEngine\T::e(asset('frontend/assets/images/favicon/apple-touch-icon.png')); ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo \Hyperf\ViewEngine\T::e(asset('frontend/assets/images/favicon/favicon-32x32.png')); ?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo \Hyperf\ViewEngine\T::e(asset('frontend/assets/images/favicon/favicon-16x16.png')); ?>">
        <link rel="manifest" href="<?php echo \Hyperf\ViewEngine\T::e(asset('frontend/assets/images/favicon/site.webmanifest')); ?>">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

         
        <link href="<?php echo \Hyperf\ViewEngine\T::e(asset('frontend/dist/style/apps.css')); ?>" rel="stylesheet">
        <link href="<?php echo \Hyperf\ViewEngine\T::e(asset('frontend/dist/style/uicons.css')); ?>" rel="stylesheet">

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
        
        <?php echo $__env->make('frontend.layouts.header', \Hyperf\Utils\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <main>

            <?php echo $__env->yieldContent('content'); ?>

        </main>

        <?php echo $__env->make('frontend.layouts.footer', \Hyperf\Utils\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <?php echo $__env->make('frontend.layouts.script', \Hyperf\Utils\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
    </body>
    <style>
        .header{
            background:black;
        }
        .header-menu .navigation{
            color:white;
            text-align:left;
        }
        .navigation ul li a{
            color:white !important;
            font-weight:bold;
        }
        .banner{
            height:600px;
        }
        .slick-slide{
            width:350px !important;
        }
    </style>
</html><?php /**PATH /home/coprinos/PROJECT/bravapart/storage/view/frontend/layouts/app.blade.php ENDPATH**/ ?>