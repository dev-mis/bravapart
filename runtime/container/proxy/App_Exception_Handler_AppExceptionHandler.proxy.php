<?php

declare (strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Exception\Handler;

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Hyperf\HttpServer\Response;
use Hyperf\Di\Annotation\Inject;
use Throwable;
class AppExceptionHandler extends ExceptionHandler
{
    use \Hyperf\Di\Aop\ProxyTrait;
    use \Hyperf\Di\Aop\PropertyHandlerTrait;
    #[Inject]
    protected Response $response;
    public function __construct(protected StdoutLoggerInterface $logger)
    {
        $this->__handlePropertyHandler(__CLASS__);
    }
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->logger->error(sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile()));
        $this->logger->error($throwable->getTraceAsString());
        $error['status'] = 500;
        $error['success'] = false;
        $error['message'] = $throwable->getMessage() . ' At line : ' . $throwable->getLine() . ' in file : ' . $throwable->getFile();
        return $this->response->withHeader('Server', 'Hyperf')->withStatus(500)->json($error);
    }
    public function isValid(Throwable $throwable) : bool
    {
        return true;
    }
}