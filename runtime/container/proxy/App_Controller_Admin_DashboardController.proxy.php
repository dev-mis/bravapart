<?php

declare (strict_types=1);
namespace App\Controller\Admin;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use App\Controller\AbstractController;
use function Hyperf\ViewEngine\view;
use App\Model\Agent;
class DashboardController extends AbstractController
{
    use \Hyperf\Di\Aop\ProxyTrait;
    use \Hyperf\Di\Aop\PropertyHandlerTrait;
    function __construct()
    {
        if (method_exists(parent::class, '__construct')) {
            parent::__construct(...func_get_args());
        }
        $this->__handlePropertyHandler(__CLASS__);
    }
    public function index()
    {
        $data['pending_approval'] = Agent::where('status', 0)->count();
        $data['approved_agent'] = Agent::where('status', 1)->count();
        $data['rejected_agent'] = Agent::where('status', 2)->count();
        return view('admin.pages.dashboard.index', compact('data'));
    }
}