<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\Database\Model\SoftDeletes;

class Testimonial extends Model
{
    use SoftDeletes;
    
    protected ?string $table = 'testimonial';

    protected array $fillable = [
        'id',
        'name',
        'occupation',
        'review',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected array $casts = [
        
    ];

    public function image()
    {
        return $this->morphOne('App\Model\Media', 'mediable')->where('content_type', 'image');
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
