<?php

namespace App\View;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Utils\Context;
use Hyperf\View\Engine\BladeEngine;
use Hyperf\View\Engine\Compiler\BladeCompiler;

class BladeServiceProvider extends \Hyperf\View\BladeServiceProvider
{
    protected function registerEngine()
    {
        $this->container->define(BladeEngine::class, function ($container) {
            $config = $container->get(ConfigInterface::class);
            $compiler = new BladeCompiler($container->get(FilesystemInterface::class), $config->get('view.compiled'));
            $compiler->directive('fullUrl', function () {
                /** @var RequestInterface $request */
                $request = Context::get(RequestInterface::class);
                return '<?php echo ' . __CLASS__ . '::fullUrl($request); ?>';
            });
            return new BladeEngine($compiler, $config->get('view'));
        });
    }

    public static function fullUrl(RequestInterface $request)
    {
        return $request->fullUrl();
    }
}
