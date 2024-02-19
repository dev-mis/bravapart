<?php

declare (strict_types = 1);

namespace App\Service\Interface;

interface UploadServiceInterface
{
    public function createLocalFile($file, $file_name);
    public function uploadFile($file, $folder, $file_name);
    public function deleteFile($folder, $file_name);
    public function uploadImage($image, $folder, $image_name);
    public function removeImage($folder, $image_name);
    public function moveImage($folder, $image_name);
}
