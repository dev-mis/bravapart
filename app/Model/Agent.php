<?php

declare(strict_types=1);

namespace App\Model;

class Agent extends Model
{
    protected ?string $table = 'agents';

    protected array $fillable = [
        'id',
        'name',
        'email',
        'phone_number',
        'address',
        'identity_number',
        'tax_number',
        'province',
        'city',
        'district',
        'village',
        'postal_code',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'status',
        'code',
        'register_number',
        'is_active',
        'approved_by',
        'rejected_by',
        'created_at',
        'approved_at',
        'rejected_at',
    ];

    protected array $casts = [
        
    ];

    public function identityCard()
    {
        return $this->morphOne('App\Model\Media', 'mediable')->where('content_type', 'identity_card');
    }

    public function taxCard()
    {
        return $this->morphOne('App\Model\Media', 'mediable')->where('content_type', 'tax_card');
    }

    public function savingBook()
    {
        return $this->morphOne('App\Model\Media', 'mediable')->where('content_type', 'saving_book');
    }

    public function approvedBy()
    {
        return $this->hasOne(User::class, 'id', 'approved_by');
    }

    public function rejectedBy()
    {
        return $this->hasOne(User::class, 'id', 'rejected_by');
    }
}
