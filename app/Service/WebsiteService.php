<?php 

namespace App\Service;

use Hyperf\Guzzle\ClientFactory;
use Hyperf\Guzzle\CoroutineHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client;
use Hyperf\Di\Annotation\Inject;
use App\Service\Interface\WebsiteServiceInterface;

class WebsiteService implements WebsiteServiceInterface
{
    #[Inject()]
    private ClientFactory $cf;
    private Client $client;

    public function __construct() 
    {
        $options = [
            'handler' => HandlerStack::create(new CoroutineHandler()),
            'timeout' => 5,
            'http_errors' => false,
            'swoole' => [
                'timeout' => 10,
                'socket_buffer_size' => 1024 * 1024 * 2,
            ],
        ];
        $this->client = $this->cf->create($options);
    }

    public function create($data)
    {
        $options = [];
        $options['headers'] = [
            'Authorization' => 'Bearer ' . env('MODENA_API_KEY')
        ];
        $options['json'] = $data;
        
        $request = $this->client->post(env("MODENA_API_HOST")."/sales-code/create", $options);

        return $result = json_decode($request->getBody()->getContents(), true);
    }
}