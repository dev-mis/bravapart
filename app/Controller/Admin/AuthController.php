<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use App\Controller\AbstractController;
use function Hyperf\ViewEngine\view;
use App\Request\Backend\LoginRequest;
use App\Model\User;
use App\Service\Interface\IdentityServiceInterface;
use Hyperf\Di\Annotation\Inject;

class AuthController extends AbstractController
{
    #[Inject()]
    protected IdentityServiceInterface $identityService;

    public function showLoginForm()
    {
        $data = $this->request->all();

        if(!empty($data['code'])){
            $login = $this->identityService->loginMicrosoftWithCode($data['code']);

            $dataLogin = $login['data'];

            $user = User::where('email', $dataLogin['mail'])->first();

            if(!empty($user)){
                if(!$user->is_active){
                    $this->session->set('flash', [
                        'type' => 'error',
                        'title' => 'Failed',
                        'message' => 'User is not active'
                    ]);

                    return $this->response->redirect('admin/login');
                }else{
                    $this->session->set('user', [
                        'id'        => $user->id,
                        'name'      => $user->name,
                        'username'  => $user->username,
                        'email'     => $user->email
                    ]);

                    if(!empty($this->session->get('previous_link'))){
                        $prev = $this->session->get('previous_link')['link'];
                        $prev = (string) $prev;
                        $response = [
                            'status'    => '200',
                            'success'   => true,
                            'message'   => 'Login successful',
                            'redirect'  => $prev
                        ];
    
                        $this->session->remove('previous_link');

                        return $this->response->redirect($prev);
                    }else{
                        $response = [
                            'status'    => '200',
                            'success'   => true,
                            'message'   => 'Login successful',
                            'redirect'  => url('admin')
                        ];
                        
                        return $this->response->redirect('admin');
                    }
                }
            }else{
                $this->session->set('flash', [
                    'type' => 'error',
                    'title' => 'Failed',
                    'message' => 'User not found'
                ]);

                return $this->response->redirect('admin/login');
            }
        }else{
            return view('admin.auth.login');
        }
    }

    public function login(LoginRequest $request)
    {
        $data = $request->all();

        $user = User::where('email', $data['email'])->first();

        if(!empty($user)){
            if(!$user->is_active){
                $response = [
                    'status'    => '500',
                    'success'   => false,
                    'message'   => 'User is not active',
                ];
    
                return $this->sendResponse($response); 
            }

            $login = $this->identityService->loginMicrosoft($data['email'], $data['password']);
            
            if($login['code'] == 400){
                $response = [
                    'status'    => '500',
                    'success'   => false,
                    'message'   => $login['message'],
                ];
    
                return $this->sendResponse($response); 
            }else{
                $this->session->set('user', [
                    // 'token'     => $login['data']['access_token'],
                    'id'        => $user->id,
                    'name'      => $user->name,
                    'username'  => $user->username,
                    'email'     => $user->email
                ]);
    
                if(!empty($this->session->get('previous_link'))){
                    $prev = $this->session->get('previous_link')['link'];
                    $prev = (string) $prev;
                    $response = [
                        'status'    => '200',
                        'success'   => true,
                        'message'   => 'Login successful',
                        'redirect'  => $prev
                    ];

                    $this->session->remove('previous_link');
                }else{
                    $response = [
                        'status'    => '200',
                        'success'   => true,
                        'message'   => 'Login successful',
                        'redirect'  => url('admin')
                    ];
                }
    
                return $this->sendResponse($response);
            }
        }else{
            $response = [
                'status'    => '500',
                'success'   => false,
                'message'   => 'User not found',
            ];

            return $this->sendResponse($response);
        }
    }

    public function logout()
    {
        $this->session->remove('user');

        return $this->response->redirect("/admin");
    }
}
