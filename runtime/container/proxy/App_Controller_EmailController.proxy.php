<?php

declare (strict_types=1);
namespace App\Controller;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Di\Annotation\Inject;
use App\Service\Interface\MailServiceInterface;
use function Hyperf\ViewEngine\view;
class EmailController
{
    use \Hyperf\Di\Aop\ProxyTrait;
    use \Hyperf\Di\Aop\PropertyHandlerTrait;
    function __construct()
    {
        $this->__handlePropertyHandler(__CLASS__);
    }
    #[Inject]
    private MailServiceInterface $mailService;
    public function sendWaitingApprovalToAgent($data)
    {
        $emailData['to'] = [['email' => $data['email'], 'name' => $data['name']]];
        $emailData['subject'] = 'MODENA Agent - Waiting for Approval';
        $mailContent = view('email.send-waiting-approval-to-agent', compact('data'))->render();
        $emailData['body'] = $mailContent;
        $sendEmail = $this->mailService->send($emailData);
        return $sendEmail;
    }
    public function sendToAdmin($link)
    {
        $link = $link ?? '#';
        $emailData['to'] = [['email' => env('ECOMMERCE_EMAIL_RECIPIENT', 'agent@modena.com'), 'name' => env('ECOMMERCE_EMAIL_NAME', 'MODENA Agent')]];
        $emailData['subject'] = 'MODENA Agent - Notification';
        $mailContent = view('email.send-to-admin', compact('link'))->render();
        $emailData['body'] = $mailContent;
        $sendEmail = $this->mailService->send($emailData);
        return $sendEmail;
    }
    public function sendApprove($data, $code)
    {
        $name = $data['name'];
        $email = $data['email'];
        $emailData['to'] = [['email' => $email, 'name' => $name]];
        $emailData['subject'] = 'MODENA Agent - Approved';
        $mailContent = view('email.send-approve', compact('code'))->render();
        $emailData['body'] = $mailContent;
        $attachment = asset('email/sales-kit.pdf');
        $sendEmail = $this->mailService->sendWithAttachment($emailData, $attachment);
        return $sendEmail;
    }
    public function sendReject($data)
    {
        $link = url('');
        $name = $data['name'];
        $email = $data['email'];
        $emailData['to'] = [['email' => $email, 'name' => $name]];
        $emailData['subject'] = 'MODENA Agent - Rejected';
        $mailContent = view('email.send-reject', compact('link'))->render();
        $emailData['body'] = $mailContent;
        $sendEmail = $this->mailService->send($emailData);
        return $sendEmail;
    }
}