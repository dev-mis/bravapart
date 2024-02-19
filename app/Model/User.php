<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\Database\Model\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    protected ?string $table = 'users';

    protected array $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'remember_token'
    ];

    protected array $casts = [];
}
