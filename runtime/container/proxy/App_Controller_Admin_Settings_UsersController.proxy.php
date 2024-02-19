<?php

declare (strict_types=1);
namespace App\Controller\Admin\Settings;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Di\Annotation\Inject;
use App\Controller\AbstractController;
use function Hyperf\ViewEngine\view;
use Hyperf\DbConnection\Db as DB;
# REQUESTS
use App\Request\Backend\Settings\Users\CreateRequest;
use App\Request\Backend\Settings\Users\EditRequest;
# MODELS
use App\Model\User;
class UsersController extends AbstractController
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
        return view('admin.pages.settings.users.index');
    }
    public function datatable()
    {
        $request = $this->request->all();
        $user = new User();
        $data['recordsTotal'] = $user->count();
        if (!empty($request)) {
            $user = $user->orderBy($request['columns'][$request['order'][0]['column']]['data'], $request['order'][0]['dir']);
            $user = $user->offset($request['start']);
            $user = $user->limit($request['length']);
            if (!empty($request['search']['value'])) {
                $no = 0;
                foreach ($request['columns'] as $key => $val) {
                    if ($val['searchable'] == 'true') {
                        if ($no == 0) {
                            $user = $user->where($val['data'], 'LIKE', '%' . $request['search']['value'] . '%');
                        } else {
                            $user = $user->orWhere($val['data'], 'LIKE', '%' . $request['search']['value'] . '%');
                        }
                        $no++;
                    }
                }
            }
        }
        $data['recordsFiltered'] = $user->count();
        $user = $user->get();
        $data['data'] = [];
        foreach ($user as $key => $val) {
            $data['data'][$key] = $val;
            $data['data'][$key]['actions'] = $val->id;
        }
        return $data;
    }
    public function create()
    {
        return view('admin.pages.settings.users.create');
    }
    public function store(CreateRequest $request)
    {
        $input = $request->all();
        $userCheck = User::where('email', $input['email'])->first();
        if (empty($userCheck)) {
            $data = ['email' => $input['email'], 'name' => $input['name'], 'password' => hash('sha256', '123456'), 'is_active' => !isset($input['is_active']) ? false : true, 'created_at' => date('Y-m-d H:i:s')];
            $user = User::insert($data);
            $response = ['status' => '200', 'success' => true, 'message' => 'User created successfully', 'redirect' => url('admin/settings/users')];
            $this->session->set('flash', ['type' => 'success', 'title' => 'Success', 'message' => 'User created successfully']);
        } else {
            $response = ['status' => '500', 'success' => false, 'message' => 'Email is already registered'];
        }
        return $this->sendResponse($response);
    }
    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('admin.pages.settings.users.edit', compact('data'));
    }
    public function update($id, EditRequest $request)
    {
        $input = $request->all();
        $user = User::findOrFail($id);
        $userCheck = User::where('email', $input['email'])->where('id', '!=', $id)->first();
        if (empty($userCheck)) {
            $data = ['email' => $input['email'], 'name' => $input['name'], 'password' => hash('sha256', '123456'), 'is_active' => !isset($input['is_active']) ? false : true, 'updated_at' => date('Y-m-d H:i:s')];
            $user = User::where('id', $id)->update($data);
            $response = ['status' => '200', 'success' => true, 'message' => 'User updated successfully', 'redirect' => url('admin/settings/users')];
            $this->session->set('flash', ['type' => 'success', 'title' => 'Success', 'message' => 'User updated successfully']);
        } else {
            $response = ['status' => '500', 'success' => false, 'message' => 'Email is already registered'];
        }
        return $this->sendResponse($response);
    }
    public function delete($id)
    {
        $user = User::findOrFail($id);
        if (!empty($user)) {
            $data = ['deleted_at' => date('Y-m-d H:i:s')];
            $user = User::where('id', $id)->update($data);
            $response = ['status' => '200', 'success' => true, 'message' => 'User deleted successfully', 'redirect' => url('admin/settings/users')];
        } else {
            $response = ['status' => '404', 'success' => false, 'message' => 'User not found'];
        }
        return $this->sendResponse($response);
    }
}