<?php

declare(strict_types=1);

namespace App\Model;

class District extends Model
{
    protected ?string $table = 'districts';

    protected array $fillable = [
        'city_id',
        'district_name',
    ];

    protected array $casts = [];
}
