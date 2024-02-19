<?php

declare(strict_types=1);

namespace App\Model;

class Village extends Model
{
    protected ?string $table = 'villages';

    protected array $fillable = [
        'district_id',
        'village_name',
    ];

    protected array $casts = [];
}
