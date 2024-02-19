<?php

declare(strict_types=1);

namespace App\Model;

class Province extends Model
{
    protected ?string $table = 'provinces';

    protected array $fillable = [
        'province_name',
    ];

    protected array $casts = [];
}
