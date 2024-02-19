<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;
use Illuminate\Support\Facades\Storage;
use Hyperf\Database\Model\SoftDeletes;

class Media extends Model
{
    use SoftDeletes; 
    
    protected ?string $table = 'media';

    protected array $fillable = [
        'name', 'path', 'file_name', 'mime_type', 'disk', 'size', 'type', 'extension', 'content_type'
    ];
    
    protected array $appends = ['directory'];

    protected array $casts = [];

    public function mediable()
    {
        return $this->morphTo();
    }

    public function getPathAttribute($value)
    {
        return env('SFTP_URL', 'http://localhost:8000/') .  $this->attributes['path'] . '/' . $this->attributes['file_name'];
    }

    public function getDirectoryAttribute($value)
    {
        return $this->attributes['path'] . '/' . $this->attributes['file_name'];
    }
}
