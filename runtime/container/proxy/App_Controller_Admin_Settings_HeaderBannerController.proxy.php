<?php

declare (strict_types=1);
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
use App\Request\Backend\Settings\HeaderBanner\UpdateRequest;
# MODELS
use App\Model\HeaderBanner;
class HeaderBannerController extends AbstractController
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
    private UploadServiceInterface $uploadService;
    public function index()
    {
        $data = HeaderBanner::with(['image', 'imageMobile'])->first();
        return view('admin.pages.settings.header-banner.index', compact('data'));
    }
    public function update(UpdateRequest $request)
    {
        $input = $request->all();
        try {
            DB::beginTransaction();
            $headerBanner = HeaderBanner::with('image')->first();
            $data['title'] = $input['title'];
            $data['description'] = $input['description'];
            if (!empty($headerBanner)) {
                $data['updated_by'] = $this->getAuth()['id'];
                $data['updated_at'] = date('Y-m-d H:i:s');
                $headerBanner->fill($data)->save();
            } else {
                $headerBanner = new HeaderBanner();
                $data['created_by'] = $this->getAuth()['id'];
                $data['created_at'] = date('Y-m-d H:i:s');
                $headerBanner->fill($data)->save();
            }
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $file_name = $file->getClientFilename();
                $this->uploadService->uploadFile($file, 'header-banner', $file_name);
                $mediaData = ['content_type' => 'image', 'name' => $file_name, 'file_name' => $file_name, 'path' => 'header-banner/', 'type' => 'image', 'extension' => $file->getExtension(), 'disk' => 'sftp', 'size' => $file->getSize()];
                if (empty($headerBanner->image)) {
                    $headerBanner->image()->create($mediaData);
                } else {
                    $this->uploadService->deleteFile('header-banner', $headerBanner->image->file_name);
                    $headerBanner->image()->update($mediaData);
                }
            }
            if ($request->hasFile('image_mobile')) {
                $file = $request->file('image_mobile');
                $file_name = $file->getClientFilename();
                $this->uploadService->uploadFile($file, 'header-banner-mobile', $file_name);
                $mediaData = ['content_type' => 'image_mobile', 'name' => $file_name, 'file_name' => $file_name, 'path' => 'header-banner-mobile/', 'type' => 'image', 'extension' => $file->getExtension(), 'disk' => 'sftp', 'size' => $file->getSize()];
                if (empty($headerBanner->imageMobile)) {
                    $headerBanner->imageMobile()->create($mediaData);
                } else {
                    $this->uploadService->deleteFile('header-banner-mobile', $headerBanner->imageMobile->file_name);
                    $headerBanner->imageMobile()->update($mediaData);
                }
            }
            $response = ['status' => '200', 'success' => true, 'message' => 'Header Banner created successfully', 'redirect' => url('admin/settings/header-banner')];
            $this->session->set('flash', ['type' => 'success', 'title' => 'Success', 'message' => 'Header Banner created successfully']);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $message = $e->getFile() . ' at line ' . $e->getLine() . ' ' . $e->getMessage();
            $response = ['status' => '500', 'success' => false, 'message' => 'Error! Message : ' . $message];
        }
        return $this->sendResponse($response);
    }
}