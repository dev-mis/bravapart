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
use App\Request\Backend\Settings\Testimonial\CreateRequest;
use App\Request\Backend\Settings\Testimonial\EditRequest;

# MODELS
use App\Model\Testimonial;
use App\Request\Backend\Agents\UpdateRequest;
use PHPUnit\Framework\Test;

class TestimonialController extends AbstractController
{
    #[Inject()]
    private UploadServiceInterface $uploadService;

    public function index()
    {
        return view('admin.pages.settings.testimonial.index');
    }

    public function datatable()
    {
        $request = $this->request->all();

        $testimonial = Testimonial::with(['image']);

        $data['recordsTotal'] = $testimonial->count();

        if(!empty($request)){
            $testimonial = $testimonial->orderBy($request['columns'][$request['order'][0]['column']]['data'], $request['order'][0]['dir']);

            $testimonial = $testimonial->offset($request['start']);
            $testimonial = $testimonial->limit($request['length']);

            if(!empty($request['search']['value'])){
                $no = 0;
                foreach($request['columns'] as $key => $val){
                    if($val['searchable'] == 'true'){

                        if($no == 0){
                            $testimonial = $testimonial->where($val['data'], 'LIKE', '%' . $request['search']['value'] . '%');
                        }else{
                            $testimonial = $testimonial->orWhere($val['data'], 'LIKE', '%' . $request['search']['value'] . '%');
                        }

                        $no++;
                    }
                }
            }
        }

        $data['recordsFiltered'] = $testimonial->count();

        $testimonial = $testimonial->get();

        $data['data'] = [];
        foreach($testimonial as $key => $val){
            $data['data'][$key] = $val;

            $data['data'][$key]['image_path'] = $val->image->path;
            $data['data'][$key]['actions'] = $val->id;
        }

        return $data;
    }

    public function create()
    {
        return view('admin.pages.settings.testimonial.create');
    }

    public function store(CreateRequest $request)
    {
        $input = $request->all();

        try{
            DB::beginTransaction();

            $testimonial = new Testimonial();

            $data['name'] = $input['name'];
            $data['occupation'] = $input['occupation'];
            $data['review'] = $input['review'];
            $data['is_active'] = !empty($input['is_active']) ? true : false;
            $data['created_by'] = $this->getAuth()['id'];

            $testimonial->fill($data)->save();

            if($request->hasFile('image')){
                $file = $request->file('image');
                $file_name = $file->getClientFilename();
        
                $this->uploadService->uploadFile($file, 'testimonial', $file_name);
        
                $mediaData = [
                    'content_type' => 'image',
                    'name' => $file_name,
                    'file_name' => $file_name,
                    'path' => 'testimonial/',
                    'type' => 'image',
                    'extension' => $file->getExtension(),
                    'disk' => 'sftp',
                    'size' => $file->getSize()
                ];
        
                if(empty($testimonial->image)){
                    $testimonial->image()->create($mediaData);
                }else{
                    $this->uploadService->deleteFile('testimonial', $testimonial->image->file_name);
                    
                    $testimonial->image()->update($mediaData);
                }
            }

            $response = [
                'status'    => '200',
                'success'   => true,
                'message'   => 'Testimonial created successfully',
                'redirect'  => url('admin/settings/testimonial'),
            ];

            $this->session->set('flash', [
                'type' => 'success',
                'title' => 'Success',
                'message' => 'Testimonial created successfully'
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

    public function edit($id)
    {
        $data = Testimonial::with(['image'])->findOrFail($id);

        return view('admin.pages.settings.testimonial.edit', compact('data'));
    }

    public function update($id, UpdateRequest $request)
    {
        $input = $request->all();

        try{
            DB::beginTransaction();

            $testimonial = Testimonial::find($id);

            $data['name'] = $input['name'];
            $data['occupation'] = $input['occupation'];
            $data['review'] = $input['review'];
            $data['is_active'] = !empty($input['is_active']) ? true : false;
            $data['updated_by'] = $this->getAuth()['id'];

            $testimonial->fill($data)->save();

            if($request->hasFile('image')){
                $file = $request->file('image');
                $file_name = $file->getClientFilename();
        
                $this->uploadService->uploadFile($file, 'testimonial', $file_name);
        
                $mediaData = [
                    'content_type' => 'image',
                    'name' => $file_name,
                    'file_name' => $file_name,
                    'path' => 'testimonial/',
                    'type' => 'image',
                    'extension' => $file->getExtension(),
                    'disk' => 'sftp',
                    'size' => $file->getSize()
                ];
        
                if(empty($testimonial->image)){
                    $testimonial->image()->create($mediaData);
                }else{
                    $this->uploadService->deleteFile('testimonial', $testimonial->image->file_name);
                    
                    $testimonial->image()->update($mediaData);
                }
            }

            $response = [
                'status'    => '200',
                'success'   => true,
                'message'   => 'Testimonial updated successfully',
                'redirect'  => url('admin/settings/testimonial'),
            ];

            $this->session->set('flash', [
                'type' => 'success',
                'title' => 'Success',
                'message' => 'Testimonial updated successfully'
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

    public function delete($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if(!empty($testimonial)){
            $data = [
                'deleted_by' => $this->getAuth()['id'],
                'deleted_at'    => date('Y-m-d H:i:s')
            ];

            $testimonial = Testimonial::where('id', $id)->update($data);
            
            $response = [
                'status'    => '200',
                'success'   => true,
                'message'   => 'Testimonial deleted successfully',
                'redirect'  => url('admin/settings/testimonial'),
            ];
        }else{
            $response = [
                'status'    => '404',
                'success'   => false,
                'message'   => 'Testimonial not found',
            ];
        }

        return $this->sendResponse($response);
    }
}
