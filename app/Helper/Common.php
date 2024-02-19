<?php

declare(strict_types = 1);

use Hyperf\Contract\SessionInterface;
use Hyperf\HttpServer\Contract\RequestInterface;
use App\Model\User;
use Hyperf\Context\ApplicationContext;
use App\Model\Seo;

if(!function_exists('asset')){
    function asset($asset = null)
    {
        return env('APP_URL', '192.168.3.86:30083') . (substr(env('APP_URL', '192.168.3.86:30083'), -1) == '/' ? '' : '/') . $asset;
    }
}

if(!function_exists('url')){
    function url($prefix = null)
    {
        return env('APP_URL', '192.168.3.86:30083') . (substr(env('APP_URL', '192.168.3.86:30083'), -1) == '/' ? '' : '/') . $prefix;
    }
}

if(!function_exists('ifPath')){
    function ifPath($url)
    {
        $request = ApplicationContext::getContainer()->get(RequestInterface::class);

        if($request->is($url)){
            return true;
        }else{
            return false;
        }
    }
}

if(!function_exists('auth')){
    function auth()
    {
        $session = ApplicationContext::getContainer()->get(SessionInterface::class);

        $userSession = $session->get('user');
        $users = User::where('id', $userSession['id'])->first()->toArray();
            
        return $users;
    }
}

if(!function_exists('flash')){
    function flash()
    {
        $session = ApplicationContext::getContainer()->get(SessionInterface::class);

        if ($session->has('flash')) {
            $flash = $session->get('flash') ?? null;
    
            $session->remove('flash');

            return $flash;
        }

        return null;
    }
}

if(!function_exists('seo')){
    function seo()
    {
        $seo = Seo::first();

        if(!empty($seo)){
            $seo = $seo->toArray();
        }
            
        return $seo;
    }
}