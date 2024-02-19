<?php
namespace App\Helper;

use Exception;

class SftpClient
{
    private $connection;
    private $sftp;

    public function __construct($host, $port = 22)
    {
        $this->connection = @ssh2_connect($host, intval($port));
        if (!$this->connection) {
            throw new Exception("Could not connect to $host on port $port.");
        }

    }

    public function login($username, $password)
    {
        if (!@ssh2_auth_password($this->connection, $username, $password)) {
            throw new Exception("Could not authenticate with username $username " .
                "and password $password.");
        }

        $this->sftp = @ssh2_sftp($this->connection);
        if (!$this->sftp) {
            throw new Exception("Could not initialize SFTP subsystem.");
        }
    }

    public function uploadFile($local_file, $remote_file)
    {
        $sftp = $this->sftp;

        $stream = @fopen("ssh2.sftp://$sftp/$remote_file", 'w');

        if (!$stream) {
            throw new Exception("Could not open file: $remote_file");
        }

        $data_to_send = @file_get_contents($local_file);
        if ($data_to_send === false) {
            throw new Exception("Could not open local file: $local_file.");
        }

        if (@fwrite($stream, $data_to_send) === false) {
            throw new Exception("Could not send data from file: $local_file.");
        }

        @fclose($stream);
    }

    public function deleteFile($remote_file)
    {
        $sftp = $this->sftp;
        unlink("ssh2.sftp://$sftp/$remote_file");
    }

    public function renameFile($from, $to)
    {
        $sftp = $this->sftp;
        ssh2_sftp_rename($sftp, $from, $to);
    }

    public function receiveFile($remote_file, $local_file)
    {
        $sftp = $this->sftp;
        $stream = @fopen("ssh2.sftp://$sftp/$remote_file", 'r');
        if (! $stream)
            throw new Exception("Could not open file: $remote_file");
        $contents = fread($stream, filesize("ssh2.sftp://$sftp/$remote_file"));   
        file_put_contents ($local_file, $contents);
        @fclose($stream);
    }
}
