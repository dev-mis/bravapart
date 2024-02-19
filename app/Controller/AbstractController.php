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
namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Container\ContainerInterface;
use Hyperf\Contract\SessionInterface;

abstract class AbstractController
{
    #[Inject()]
    protected ContainerInterface $container;

    #[Inject()]
    protected RequestInterface $request;

    #[Inject()]
    protected ResponseInterface $response;

    #[Inject()]
    protected SessionInterface $session;

    public function sendResponse($response = null)
    {
        $response['status'] = $response['status'] ?? 204;
        $response['message'] = $response['message'] ?? null;
        $response['success'] = $response['success'] ?? false;
        $response['redirect'] = $response['redirect'] ?? null;
        
        return $this->response->withStatus($response['status'])->json($response);
    }

    public function getAuth()
    {
        return $this->session->get('user');
    }

    public function getPreviousLink()
    {
        return $this->session->get('previous_link');
    }
}
