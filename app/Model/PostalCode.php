<?php

declare(strict_types=1);

namespace App\Model;

class PostalCode extends Model
{
    protected ?string $table = 'postal_code';

    protected array $fillable = [
        'village_id',
        'postal_code',
    ];

    protected array $casts = [];
}
