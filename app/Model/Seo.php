<?php

declare(strict_types=1);

namespace App\Model;

class Seo extends Model
{
    protected ?string $table = 'seo';

    protected array $fillable = [
        'id',
        'title',
        'description',
        'created_by',
        'updated_by'
    ];

    protected array $casts = [
        
    ];

    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function updatedBy()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }
}
