<?php

declare(strict_types=1);

namespace App\Model;

class Bank extends Model
{
    protected ?string $table = 'banks';

    protected array $fillable = [
        'code',
        'name',
    ];

    protected array $casts = [];
}
