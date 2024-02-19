<?php

declare(strict_types=1);

namespace App\Controller\Admin\Settings;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Di\Annotation\Inject;
use App\Controller\AbstractController;
use function Hyperf\ViewEngine\view;
use Hyperf\DbConnection\Db as DB;
use App\Service\Interface\UploadServiceInterface;
use Exception;

# REQUESTS
use App\Request\Backend\Settings\Seo\UpdateRequest;

# MODELS
use App\Model\Seo;

class SeoController extends AbstractController
{
    public function index()
    {
        $data = Seo::with(['updatedBy'])->first();

        return view('admin.pages.settings.seo.index', compact('data'));
    }

    public function update(UpdateRequest $request)
    {
        $input = $request->all();

        try{
            DB::beginTransaction();

            $seo = Seo::first();

            $data['title'] = $input['title'];
            $data['description'] = $input['description'];

            if(!empty($seo)){
                $data['updated_by'] = $this->getAuth()['id'];
                $data['updated_at'] = date('Y-m-d H:i:s');

                $seo->fill($data)->save();
            }else{
                $seo = new Seo();

                $data['created_by'] = $this->getAuth()['id'];
                $data['created_at'] = date('Y-m-d H:i:s');

                $seo->fill($data)->save();
            }

            $response = [
                'status'    => '200',
                'success'   => true,
                'message'   => 'SEO created successfully',
                'redirect'  => url('admin/settings/seo'),
            ];

            $this->session->set('flash', [
                'type' => 'success',
                'title' => 'Success',
                'message' => 'SEO created successfully'
            ]);

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();

            $message = $e->getMessage();

            $response = [
                'status'    => '500',
                'success'   => false,
                'message'   => 'Error! Message : '. $message,
            ];
        }

        return $this->sendResponse($response);
    }
}
