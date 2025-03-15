<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'payment_number',
        'amount',
        'payment_method',
        'status',
        'payment_proof',
        'bank_name',
        'account_number',
        'account_name',
        'notes',
        'paid_at'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    // Payment Method Constants
    const METHOD_BANK_TRANSFER = 'bank_transfer';
    const METHOD_E_WALLET = 'e_wallet';
    const METHOD_CREDIT_CARD = 'credit_card';
    const METHOD_COD = 'cash_on_delivery';

    // Status Constants
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';
    const STATUS_REFUNDED = 'refunded';

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function isPaid()
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function markAsPaid()
    {
        $this->update([
            'status' => self::STATUS_COMPLETED,
            'paid_at' => now()
        ]);
    }
}
