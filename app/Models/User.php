<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'wallet_address',
        'wallet_type',
        'payment_amount',
        'total_amount',
        'payment_currency',
        'payment_method',
        'bank_name',
        'account_number',
        'account_name',
        'routing_number',
        'sort_code',
        'bank_address',
        'receiver_wallet_address',
        'receiver_company',
        'payment_wallet_address',
        'payment_instruction_currency',
        'payment_instruction',
        'special_notes',
        'security_message',
        'payment_expires_at',
        'payment_status',
        'spread_fee',
        'fee_reason',
        'status',
        // Progress tracking fields
        'progress_step',
        'progress_percentage',
        'step1_name',
        'step1_date',
        'step2_name',
        'step2_date',
        'step3_name',
        'step3_date',
        'step4_name',
        'step4_date'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'payment_amount' => 'decimal:2',
        'spread_fee' => 'decimal:2',
        'payment_expires_at' => 'datetime',
        // Cast dates for progress steps
        'step1_date' => 'datetime',
        'step2_date' => 'datetime',
        'step3_date' => 'datetime',
        'step4_date' => 'datetime'
    ];
}
