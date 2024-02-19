<?php

declare (strict_types=1);
namespace App\Service;

use App\Service\Interface\IdentityServiceInterface;
use App\Helper\SAPConnect;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Guzzle\ClientFactory;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Hyperf\Guzzle\CoroutineHandler;
class IdentityService implements IdentityServiceInterface
{
    use \Hyperf\Di\Aop\ProxyTrait;
    use \Hyperf\Di\Aop\PropertyHandlerTrait;
    #[Inject]
    private ClientFactory $cf;
    private Client $client;
    public function __construct()
    {
        $this->__handlePropertyHandler(__CLASS__);
        $options = ['handler' => HandlerStack::create(new CoroutineHandler()), 'verify' => false, 'timeout' => 100, 'http_errors' => false, 'swoole' => ['timeout' => 10000, 'socket_buffer_size' => 1024 * 1024 * 2]];
        $this->client = $this->cf->create($options);
    }
    public function loginMicrosoft($username, $password)
    {
        $request = $this->client->post('https://login.microsoftonline.com/modena.com/oauth2/v2.0/token', ['headers' => ['Cookie' => 'fpc=Ak8PfC5IyJRMgk3baaPlGBP1lKhyAwAAABqkQdwOAAAA; stsservicecookie=estsfd; x-ms-gateway-slice=estsfd'], 'multipart' => [['name' => 'client_id', 'contents' => '35b5f391-3617-47ec-bb2f-ae3e2251ecec'], ['name' => 'scope', 'contents' => 'https://graph.microsoft.com/.default'], ['name' => 'grant_type', 'contents' => 'password'], ['name' => 'username', 'contents' => $username], ['name' => 'password', 'contents' => $password]]]);
        $result = json_decode($request->getBody()->getContents(), true);
        $code = $request->getStatusCode();
        if ($code == 400) {
            $errorCode = $result['error_codes'][0];
            if ($errorCode == 50034) {
                $message = 'The user account does not exist in MODENA directory';
            } else {
                if ($errorCode == 50126) {
                    $message = 'Password do not match';
                } else {
                    if ($errorCode == 50076) {
                        $message = 'Login failed. Please use another method to login';
                    } else {
                        $message = '';
                    }
                }
            }
            return ['code' => $code, 'message' => $message];
        } else {
            return ['code' => $code, 'message' => 'Welcome!', 'data' => $result];
        }
    }
    public function loginMicrosoftWithCode($code)
    {
        $request = $this->client->post('https://login.microsoftonline.com/modena.com/oauth2/v2.0/token', ['headers' => ['Cookie' => 'fpc=Ak8PfC5IyJRMgk3baaPlGBP1lKhyAwAAABqkQdwOAAAA; stsservicecookie=estsfd; x-ms-gateway-slice=estsfd'], 'multipart' => [['name' => 'client_id', 'contents' => env('MICROSOFT_CLIENT_ID')], ['name' => 'client_secret', 'contents' => env('MICROSOFT_SECRET_ID')], ['name' => 'scope', 'contents' => 'https://graph.microsoft.com/.default'], ['name' => 'grant_type', 'contents' => 'authorization_code'], ['name' => 'code', 'contents' => $code]]]);
        $result = json_decode($request->getBody()->getContents(), true);
        $code = $request->getStatusCode();
        if ($code == 400) {
            $errorCode = $result['error_codes'][0];
            if ($errorCode == 50034) {
                $message = 'The user account does not exist in MODENA directory';
            } else {
                if ($errorCode == 50126) {
                    $message = 'Password do not match';
                } else {
                    $message = '';
                }
            }
            return ['code' => $code, 'message' => $message];
        } else {
            $token = $result['access_token'];
            $login = $this->loginUserWithMe($token);
            return ['code' => $code, 'message' => 'Welcome!', 'data' => $login];
        }
    }
    public function loginUserWithMe($token)
    {
        $request = $this->client->get('https://graph.microsoft.com/v1.0/me', ['headers' => ['Authorization' => 'Bearer ' . $token]]);
        $result = json_decode($request->getBody()->getContents(), true);
        return $result;
    }
}