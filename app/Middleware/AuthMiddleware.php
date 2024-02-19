<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Hyperf\HttpServer\Contract\ResponseInterface as Response;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Contract\SessionInterface;

class AuthMiddleware implements MiddlewareInterface
{
    #[Inject()]
    private Response $response;

    #[Inject()]
    protected SessionInterface $session;

    public function __construct(protected ContainerInterface $container)
    {
        
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $path = $request->getUri()->getPath();

        if (str_contains($path, '/login')) {
            if($this->session->has('user')){
                return $this->response->redirect('/admin');
            }

            return $handler->handle($request);
        }else{
            if($this->session->has('user')){
                return $handler->handle($request);
            }else{
                $this->session->set('previous_link', [
                    'link' => $request->getUri()
                ]);

                return $this->response->redirect('/admin/login');
            }
        }

        return $handler->handle($request);
    }
}
