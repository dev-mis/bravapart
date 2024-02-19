<?php

declare (strict_types=1);
namespace App\Controller\Admin;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Di\Annotation\Inject;
use App\Controller\AbstractController;
use function Hyperf\ViewEngine\view;
use Hyperf\DbConnection\Db;
use Exception;
use GuzzleHttp\Client;
use App\Service\Interface\WebsiteServiceInterface;
use App\Controller\EmailController;
# REQUESTS
use App\Request\Backend\Agents\CreateRequest;
use App\Request\Backend\Agents\EditRequest;
# MODELS
use App\Model\Agent;
class AgentsController extends AbstractController
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
    #[Inject]
    private WebsiteServiceInterface $websiteService;
    #[Inject]
    private EmailController $emailController;
    public function index()
    {
        return view('admin.pages.agents.index');
    }
    public function datatable()
    {
        $request = $this->request->all();
        $agent = new Agent();
        $data['recordsTotal'] = $agent->count();
        if (!empty($request)) {
            if (!empty($request['status'])) {
                if ($request['status'] == 'pending') {
                    $agent = $agent->where('status', '0');
                } else {
                    if ($request['status'] == 'approved') {
                        $agent = $agent->where('status', '1');
                    } else {
                        if ($request['status'] == 'rejected') {
                            $agent = $agent->where('status', '2');
                        }
                    }
                }
            }
            $agent = $agent->orderBy($request['columns'][$request['order'][0]['column']]['data'], $request['order'][0]['dir']);
            if (!empty($request['search']['value'])) {
                $no = 0;
                foreach ($request['columns'] as $key => $val) {
                    if ($val['searchable'] == 'true') {
                        if ($no == 0) {
                            $agent = $agent->where($val['data'], 'LIKE', '%' . $request['search']['value'] . '%');
                        } else {
                            $agent = $agent->orWhere($val['data'], 'LIKE', '%' . $request['search']['value'] . '%');
                        }
                        $no++;
                    }
                }
            }
        }
        $data['recordsFiltered'] = $agent->count();
        $agent = $agent->offset($request['start']);
        $agent = $agent->limit($request['length']);
        $agent = $agent->get();
        $data['data'] = [];
        foreach ($agent as $key => $val) {
            $data['data'][$key] = $val;
            $data['data'][$key]['actions'] = $val->id;
        }
        return $data;
    }
    public function view($id)
    {
        $data = Agent::with(['identityCard', 'taxCard', 'savingBook'])->find($id);
        return view('admin.pages.agents.view', compact('data'));
    }
    public function approve($id)
    {
        try {
            DB::beginTransaction();
            $agent = Agent::find($id);
            $data['status'] = 1;
            $data['approved_by'] = $this->getAuth()['id'];
            $data['approved_at'] = date('Y-m-d H:i:s');
            $pushToWebsite = $this->websiteService->create(['name' => $agent->name, 'email' => $agent->email, 'phone_number' => $agent->phone_number, 'identity_number' => $agent->identity_number, 'tax_number' => $agent->tax_number, 'bank_name' => $agent->bank_name, 'bank_account_name' => $agent->bank_account_name, 'bank_account_number' => $agent->bank_account_number]);
            $data['code'] = $pushToWebsite['data']['code'];
            $this->emailController->sendApprove($agent->toArray(), $data['code']);
            $agent->fill($data)->save();
            $response = ['status' => '200', 'success' => true, 'message' => 'Agent approved successfully', 'redirect' => url('admin/agents')];
            $this->session->set('flash', ['type' => 'success', 'title' => 'Success', 'message' => 'Agent approved successfully']);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
            $response = ['status' => '500', 'success' => false, 'message' => 'Error! Message : ' . $message];
        }
        return $this->sendResponse($response);
    }
    public function reject($id)
    {
        try {
            DB::beginTransaction();
            $agent = Agent::find($id);
            $data['status'] = 2;
            $data['rejected_by'] = $this->getAuth()['id'];
            $data['rejected_at'] = date('Y-m-d H:i:s');
            $agent->fill($data)->save();
            $this->emailController->sendReject($agent->toArray());
            $response = ['status' => '200', 'success' => true, 'message' => 'Agent rejected successfully', 'redirect' => url('admin/agents')];
            $this->session->set('flash', ['type' => 'success', 'title' => 'Success', 'message' => 'Agent rejected successfully']);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
            $response = ['status' => '500', 'success' => false, 'message' => 'Error! Message : ' . $message];
        }
        return $this->sendResponse($response);
    }
}