<?php 

namespace App\Service;

use Hyperf\Guzzle\ClientFactory;
use Hyperf\Guzzle\CoroutineHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client;
use Hyperf\Di\Annotation\Inject;
use App\Service\Interface\MailServiceInterface;

class MailService implements MailServiceInterface
{
    
    #[Inject()]
    private ClientFactory $cf;
    private Client $client;

    public function __construct() 
    {
        $options = [
            'base_uri' => env("BASE_MAIL_SERVICE"),
            'handler' => HandlerStack::create(new CoroutineHandler()),
            'timeout' => 0,
            'http_errors' => false,
            'swoole' => [
                'timeout' => 0,
                'socket_buffer_size' => 1024 * 1024 * 30,
            ],
        ];
        $this->client = $this->cf->create($options);
    }

    public function send($data)
    {
        $options = [];
        $options['json'] = [
            "appName" => "MODENA Agent",
            "to" => $data["to"],
            "subject" => $data["subject"],
            "body" => $data["body"],
            "isHtml" => true,
        ];
        
        return $this->client->post("/mail/send", $options);
    }

    public function sendWithAttachment($data, $attachment){
        $options = [];

        $file = file_get_contents($attachment);
        $options['multipart'] = [
            [
                'name' => "attachment",
                'contents' => $file,
                'filename' => 'marketing.pdf'
            ],
            [
                'name' => 'appName',
                'contents' => 'MODENA Agent'
            ],
            [
                'name' => "subject",
                'contents' => $data['subject'],
            ],
            [
                'name' => "body",
                'contents' => $data['body'],
            ],
            [
                'name' => 'isHtml',
                'contents' => true
            ],
            [
                'name' => 'to[0][email]',
                'contents' => $data['to'][0]['email']
            ],
            [
                'name' => 'to[0][name]',
                'contents' => $data['to'][0]['name']
            ]
        ];
        
        return $this->client->post("/mail/send", $options);
    }
}