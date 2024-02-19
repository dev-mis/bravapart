<?php

declare (strict_types = 1);

namespace App\Service;

use Exception;
use App\Helper\SftpClient;
use App\Service\Interface\UploadServiceInterface;

class UploadService implements UploadServiceInterface
{
    private $sftp;

    public function __construct()
    {
        $this->sftp = new SftpClient(env('SFTP_HOST','192.168.3.86'), env('SFTP_PORT','221'));
        $this->sftp->login(env('SFTP_USERNAME'), env('SFTP_PASSWORD'));
    }

    public function createLocalFile($file, $file_name)
    {
        $path = env("PATH_UPLOAD") . $file_name;
        $file->moveTo($path);

        $old = umask(0);
        chmod($path, 0777);
        umask($old);
    }

    public function receiveFile($folder, $file_name)
    {
        try
        {
            $local_file = env("PATH_UPLOAD") . $file_name;
            $remote_file =  env("SFTP_FOLDER")."/$folder/$file_name";

            $this->sftp->receiveFile($remote_file, $local_file);
        } catch (Exception $e) {
            echo $e->getMessage() . "\n";
        }
    }

    public function uploadFile($file, $folder, $file_name)
    {
        $this->createLocalFile($file, $file_name);
        
        $path = env("PATH_UPLOAD") . $file_name;

        try
        {
            $this->sftp->uploadFile($path, env("SFTP_FOLDER")."/$folder/$file_name");
            unlink($path);
        } catch(Exception $e) {
            unlink($path);
            echo $e->getMessage() . "\n";
        }
    }

    public function deleteFile($folder, $file_name)
    {
        try
        {
            $path = env("SFTP_FOLDER")."/$folder/$file_name";
            $this->sftp->deleteFile($path);
        } catch (Exception $e) {
            echo $e->getMessage() . "\n";
        }
    }
    
    public function uploadImage($image, $folder, $image_name)
    {
        $file_name = env("PATH_UPLOAD") . $image_name;
        $image->moveTo($file_name);

        $old = umask(0);
        chmod($file_name, 0644);
        umask($old);

        try
        {
            $this->sftp->uploadFile($file_name, env("SFTP_FOLDER")."/$folder/$image_name");
            unlink($file_name);
        } catch(Exception $e) {
            unlink($file_name);
            echo $e->getMessage() . "\n";;
        }
    }

    public function removeImage($folder, $image_name)
    {
        try
        {
            $path = env("SFTP_FOLDER")."/$folder/$image_name";
            $this->sftp->deleteFile($path);
        } catch (Exception $e) {
            echo $e->getMessage() . "\n";
        }
    }

    public function moveImage($folder, $image_name)
    {
        try
        {
            $temp = env("SFTP_FOLDER")."/temps/$image_name";
            $path = env("SFTP_FOLDER")."/$folder/$image_name";

            $this->sftp->renameFile($temp, $path);
        } catch (Exception $e) {
            echo $e->getMessage() . "\n";
        }
    }
}
