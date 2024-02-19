<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\View\Engine\NoneEngine;
use Hyperf\ViewEngine\HyperfViewEngine;
use Hyperf\View\Mode;

return [
    'engine' => Hyperf\ViewEngine\HyperfViewEngine::class,
    'mode' => Hyperf\View\Mode::SYNC,
    'config' => [
        'view_path' => BASE_PATH.'/storage/view/',
        'cache_path' => BASE_PATH.'/runtime/view/',
    ],

    # Custom component registration
    'components' => [
        'url' => BASE_PATH
        //'alert' => \App\View\Components\Alert::class
    ],

    # View namespace (mainly used in extension packages)
    'namespaces' => [
        'admin' => BASE_PATH . '/public/assets/',
    ],
];

