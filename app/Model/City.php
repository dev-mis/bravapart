<?php

declare(strict_types=1);

namespace App\Model;

class City extends Model
{
    protected ?string $table = 'cities';

    protected array $fillable = [
        'province_id',
        'city_name',
    ];

    protected array $casts = [];
}
