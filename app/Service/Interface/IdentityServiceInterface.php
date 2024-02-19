<?php 

declare(strict_types=1);

namespace App\Service\Interface;

interface IdentityServiceInterface{
    public function loginMicrosoft($username, $password);
    public function loginMicrosoftWithCode($code);
}