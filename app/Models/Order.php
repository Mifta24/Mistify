<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'total_price',
        'shipping_fee',
        'status',
        'payment_status',
        'shipping_name',
        'shipping_phone',
        'shipping_address',
        'shipping_city',
        'shipping_postal_code',
        'notes',
        'payment_method',
        'processed_at',
        'shipped_at',
        'delivered_at',
        'paid_at',
        'payment_details',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'shipping_fee' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'processed_at' => 'datetime',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
        'paid_at' => 'datetime',
        'payment_details' => 'array',
    ];

    // Status Constants
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SHIPPED = 'shipped';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_CANCELLED = 'cancelled';

    // Payment Status Constants
    const PAYMENT_UNPAID = 'unpaid';
    const PAYMENT_PAID = 'paid';
    const PAYMENT_REFUNDED = 'refunded';

    // Payment Method Constants
    const PAYMENT_METHOD_BANK = 'bank_transfer';
    const PAYMENT_METHOD_EWALLET = 'e_wallet';

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // Accessors
    public function getStatusColorAttribute(): string
    {
        return [
            self::STATUS_PENDING => 'warning',
            self::STATUS_PROCESSING => 'info',
            self::STATUS_SHIPPED => 'primary',
            self::STATUS_DELIVERED => 'success',
            self::STATUS_CANCELLED => 'danger',
        ][$this->status] ?? 'secondary';
    }

    public function getPaymentStatusColorAttribute(): string
    {
        return [
            self::PAYMENT_UNPAID => 'danger',
            self::PAYMENT_PAID => 'success',
            self::PAYMENT_REFUNDED => 'warning',
        ][$this->payment_status] ?? 'secondary';
    }

    public function getSubtotalAttribute(): float
    {
        return $this->total_price - $this->shipping_fee;
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }

    public function getStatusBadgeAttribute(): string
    {
        return sprintf(
            '<span class="badge bg-%s">%s</span>',
            $this->status_color,
            ucfirst($this->status)
        );
    }

    public function getPaymentStatusBadgeAttribute(): string
    {
        return sprintf(
            '<span class="badge bg-%s">%s</span>',
            $this->payment_status_color,
            ucfirst($this->payment_status)
        );
    }

    // Scopes
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeProcessing(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PROCESSING);
    }

    public function scopeShipped(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_SHIPPED);
    }

    public function scopeDelivered(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_DELIVERED);
    }

    public function scopeCancelled(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_CANCELLED);
    }

    public function scopeUnpaid(Builder $query): Builder
    {
        return $query->where('payment_status', self::PAYMENT_UNPAID);
    }

    public function scopePaid(Builder $query): Builder
    {
        return $query->where('payment_status', self::PAYMENT_PAID);
    }

    public function scopeThisMonth(Builder $query): Builder
    {
        return $query->whereMonth('created_at', Carbon::now()->month);
    }

    // Helper Methods
    public function updateStatus(string $status): bool
    {
        $timestamp = match ($status) {
            self::STATUS_PROCESSING => 'processed_at',
            self::STATUS_SHIPPED => 'shipped_at',
            self::STATUS_DELIVERED => 'delivered_at',
            default => null,
        };

        if ($timestamp) {
            return $this->update([
                'status' => $status,
                $timestamp => Carbon::now(),
            ]);
        }

        return $this->update(['status' => $status]);
    }

    public function updatePaymentStatus(string $status): bool
    {
        if ($status === self::PAYMENT_PAID) {
            return $this->update([
                'payment_status' => $status,
                'status' => self::STATUS_PROCESSING,
                'processed_at' => Carbon::now(),
            ]);
        }

        return $this->update(['payment_status' => $status]);
    }

    public function canBeCancelled(): bool
    {
        return in_array($this->status, [
            self::STATUS_PENDING,
            self::STATUS_PROCESSING
        ]) && $this->payment_status !== self::PAYMENT_REFUNDED;
    }

    public function getTotalItems(): int
    {
        return $this->items->sum('quantity');
    }

    public function isOverdue(): bool
    {
        return $this->payment_status === self::PAYMENT_UNPAID
            && $this->created_at->addHours(24)->isPast();
    }
}
