<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\View\RenderInterface;
use Hyperf\HttpServer\Contract\RequestInterface;
use function Hyperf\ViewEngine\view;
use Exception;
use Hyperf\DbConnection\Db as DB;
use App\Service\Interface\UploadServiceInterface;
use App\Controller\EmailController;

# MODELS
use App\Model\HeaderBanner;
use App\Model\Testimonial;
use App\Model\Agent;
use App\Model\Bank;
use App\Model\Province;
use App\Model\City;
use App\Model\District;
use App\Model\Village;
use App\Model\PostalCode;

class IndexController extends AbstractController
{
    #[Inject()]
    private UploadServiceInterface $uploadService;

    #[Inject()]
    private EmailController $emailController;

    public function index()
    {
        $input = $this->request->all();

        // if(!empty($input['code'])){
        //     $query = http_build_query($input);

        //     return $this->response->redirect('/admin/login?'.$query);
        // }else{
        //     $headerBanner = HeaderBanner::with(['image', 'imageMobile'])->first();
        //     $testimonial = Testimonial::with(['image'])->where('is_active', 1)->get();
    
        //     $banks = Bank::get();
    
            return view('frontend.pages.home.index');
        // }

    }

    public function store(RequestInterface $request)
    {
        $input = $request->all();

        try{
            DB::beginTransaction();

            $data['name'] = $input['name'];
            $data['email'] = $input['email'];
            $data['phone_number'] = $input['phone_number'];
            $data['address'] = $input['address'];
            $data['identity_number'] = $input['identity_number'];
            $data['tax_number'] = $input['tax_number'];
            $data['register_number'] = $this->generateCode();

            $province = Province::find($input['province']);
            $city = City::find($input['city']);
            $district = District::find($input['district']);
            $village = Village::find($input['village']);
            $postal_code = PostalCode::find($input['postal_code']);
            $bank_name = Bank::find($input['bank_name']);
            unset($input['province'], $input['city'], $input['district'], $input['village'], $input['postal_code'], $input['bank_name']);
            $data['province'] = $province->province_name;
            $data['city'] = $city->city_name;
            $data['district'] = $district->district_name;
            $data['village'] = $village->village_name;
            $data['postal_code'] = $postal_code->postal_code;
            $data['bank_name'] = $bank_name->code . ' - ' . $bank_name->name;
            $data['bank_account_name'] = $input['bank_account_name'];
            $data['bank_account_number'] = $input['bank_account_number'];
            $data['status'] = 0;
            $data['is_active'] = 1;
            $data['created_at'] = date('Y-m-d H:i:s');

            $agent = new Agent();
            $agent->fill($data)->save();

            if($request->hasFile('identity_card')){
                $file = $request->file('identity_card');
                $file_name = $file->getClientFilename();
        
                $this->uploadService->uploadFile($file, 'identity-card', $file_name);
        
                $mediaData = [
                    'content_type' => 'identity_card',
                    'name' => $file_name,
                    'file_name' => $file_name,
                    'path' => 'identity-card/',
                    'type' => 'image',
                    'extension' => $file->getExtension(),
                    'disk' => 'sftp',
                    'size' => $file->getSize()
                ];
        
                $agent->identityCard()->create($mediaData);
            }

            if($request->hasFile('tax_card')){
                $file = $request->file('tax_card');
                $file_name = $file->getClientFilename();
        
                $this->uploadService->uploadFile($file, 'tax-card', $file_name);
        
                $mediaData = [
                    'content_type' => 'tax_card',
                    'name' => $file_name,
                    'file_name' => $file_name,
                    'path' => 'tax-card/',
                    'type' => 'image',
                    'extension' => $file->getExtension(),
                    'disk' => 'sftp',
                    'size' => $file->getSize()
                ];
        
                $agent->taxCard()->create($mediaData);
            }

            if($request->hasFile('saving_book')){
                $file = $request->file('saving_book');
                $file_name = $file->getClientFilename();
        
                $this->uploadService->uploadFile($file, 'saving-book', $file_name);
        
                $mediaData = [
                    'content_type' => 'saving_book',
                    'name' => $file_name,
                    'file_name' => $file_name,
                    'path' => 'saving-book/',
                    'type' => 'image',
                    'extension' => $file->getExtension(),
                    'disk' => 'sftp',
                    'size' => $file->getSize()
                ];
        
                $agent->savingBook()->create($mediaData);
            }

            $this->emailController->sendWaitingApprovalToAgent($data);
            $this->emailController->sendToAdmin(url('admin/agents/view/'.$agent->id));

            $response = [
                'status'    => '200',
                'success'   => true,
                'message'   => 'Data has been successfully created',
            ];

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

    public function firstValidation(RequestInterface $request)
    {
        $input = $request->all();
        
        $messages = [];
        if(empty($input['name'])){
            $messages['name'] = 'Nama tidak boleh kosong!';
        }

        if(empty($input['identity_number'])){
            $messages['identity_number'] = 'No KTP tidak boleh kosong!';
        }

        if(!empty($input['identity_number'])){
            if(strlen($input['identity_number']) < 16){
                $messages['identity_number'] = 'No. KTP harus 16 digit!';
            }else{
                $checkIdentity = Agent::where('status', '!=', 2)->where('identity_number', $input['identity_number'])->first();
    
                if(!empty($checkIdentity)){
                    $messages['identity_number'] = 'No. KTP sudah ada!';
                }
            }
        }

        if(count($messages) > 0){
            $response = [
                'status'    => '406',
                'success'   => false,
                'message'   => $messages,
            ];
        }else{
            $response = [
                'status'    => '200',
                'success'   => true,
                'message'   => 'Success',
            ];
        }

        return $this->sendResponse($response);
    }

    public function secondValidation(RequestInterface $request)
    {
        $input = $request->all();
        
        $messages = [];
        if(empty($input['tax_number'])){
            $messages['tax_number'] = 'No. NPWP tidak boleh kosong!';
        }

        if($input['is_identity_card'] == 0){
            $messages['is_identity_card'] = 'Foto KTP tidak boleh kosong!';
        }
        
        if($input['is_tax_card'] == 0){
            $messages['is_tax_card'] = 'Foto NPWP tidak boleh kosong!';
        }

        if(empty($input['bank_account_name'])){
            $messages['bank_account_name'] = 'Nama Pemilik Rekening tidak boleh kosong!';
        }

        if(empty($input['bank_name'])){
            $messages['bank_name'] = 'Bank tidak boleh kosong!';
        }

        if(empty($input['bank_account_number'])){
            $messages['bank_account_number'] = 'No Rekening tidak boleh kosong!';
        }

        if($input['is_saving_book'] == 0){
            $messages['is_saving_book'] = 'Foto Buku Tabungan tidak boleh kosong!';
        }

        if(count($messages) > 0){
            $response = [
                'status'    => '406',
                'success'   => false,
                'message'   => $messages,
            ];
        }else{
            $response = [
                'status'    => '200',
                'success'   => true,
                'message'   => 'Success',
            ];
        }

        return $this->sendResponse($response);
    }

    public function thirdValidation(RequestInterface $request)
    {
        $input = $request->all();
        
        $messages = [];
        if(empty($input['email'])){
            $messages['email'] = 'Email tidak boleh kosong!';
        }else{
            if(filter_var($input['email'], FILTER_VALIDATE_EMAIL) === false){
                $messages['email'] = 'Format Email salah!';
            }
        }

        if(empty($input['phone_number'])){
            $messages['phone_number'] = 'No Handphone tidak boleh kosong!';
        }

        if(empty($input['address'])){
            $messages['address'] = 'Alamat tidak boleh kosong!';
        }

        if(empty($input['province'])){
            $messages['province'] = 'Provinsi tidak boleh kosong!';
        }
        
        if(empty($input['city'])){
            $messages['city'] = 'Kota tidak boleh kosong!';
        }

        if(empty($input['district'])){
            $messages['district'] = 'Kecamatan tidak boleh kosong!';
        }

        if(empty($input['village'])){
            $messages['village'] = 'Kelurahan tidak boleh kosong!';
        }

        if(empty($input['postal_code'])){
            $messages['postal_code'] = 'Kode Pos tidak boleh kosong!';
        }

        // if(empty($input['agree'])){
        //     $messages['agree'] = '';
        // }

        if(count($messages) > 0){
            $response = [
                'status'    => '406',
                'success'   => false,
                'message'   => $messages,
            ];
        }else{
            $response = [
                'status'    => '200',
                'success'   => true,
                'message'   => 'Success',
            ];
        }

        return $this->sendResponse($response);
    }

    public function getProvinces()
    {
        $data = Province::get();

        return $data;
    }

    public function getCities($provinceId)
    {
        $data = City::where('province_id', $provinceId)->get();

        return $data;
    }

    public function getDistricts($cityId)
    {
        $data = District::where('city_id', $cityId)->get();

        return $data;
    }

    public function getVillages($districtId)
    {
        $data = Village::where('district_id', $districtId)->get();

        return $data;
    }

    public function getPostalCode($villageId)
    {
        $data = PostalCode::where('village_id', $villageId)->get();

        return $data;
    }

    public function generateCode()
    {
        $first = 'MA';
        $second = date('dmy');
        
        $getLastCode = Agent::where(DB::raw("to_char(created_at, 'YYYY-MM-DD')"), date('Y-m-d'))->orderBy('id', 'DESC')->first();
        $getLastCode = !empty($getLastCode) ? substr($getLastCode->register_number, -5) * 1 : 0;

        $lastCode = $getLastCode + 1;

        if($lastCode < 100000){
            $sequentialCode = $lastCode;
            if($lastCode < 10000){
                $sequentialCode = '0'.$lastCode;
                if($lastCode < 1000){
                    $sequentialCode = '00'.$lastCode;
                    if($lastCode < 100){
                        $sequentialCode = '000'.$lastCode;
                        if($lastCode < 10){
                            $sequentialCode = '0000'.$lastCode;
                        }
                    }
                }
            }
        }

        return $first . $second . $sequentialCode;
    }
}
