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
return [
    App\Service\Interface\IdentityServiceInterface::class => \App\Service\IdentityService::class,
    App\Service\Interface\MailServiceInterface::class => App\Service\MailService::class,App\Service\Interface\UploadServiceInterface::class => App\Service\UploadService::class,
    App\Service\Interface\WebsiteServiceInterface::class => App\Service\WebsiteService::class,
];
