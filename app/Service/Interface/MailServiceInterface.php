<?php

namespace App\Service\Interface;

interface MailServiceInterface {
    public function send($data);
    public function sendWithAttachment($data, $attachment);
}
