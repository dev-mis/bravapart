<?php

declare(strict_types=1);

namespace App\Model;

class HeaderBanner extends Model
{
    protected ?string $table = 'header_banner';

    protected array $fillable = [
        'id',
        'title',
        'description',
        'created_by',
        'updated_by'
    ];

    protected array $casts = [
        
    ];

    public function image()
    {
        return $this->morphOne('App\Model\Media', 'mediable')->where('content_type', 'image');
    }

    public function imageMobile()
    {
        return $this->morphOne('App\Model\Media', 'mediable')->where('content_type', 'image_mobile');
    }

    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function updatedBy()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }
}
