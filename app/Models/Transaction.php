<?php

namespace App\Models;

use App\Models\Fund;
use App\Models\User;
use App\Models\CashBook;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'cash_book_id',
        'fund_id',
        'user_id',
        'type',
        'amount',
        'description',
        'date',
        'reference_type',
        'reference_id',
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function cashBook(): BelongsTo
    {
        return $this->belongsTo(CashBook::class);
    }

    public function fund(): BelongsTo
    {
        return $this->belongsTo(Fund::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reference(): MorphTo
    {
        return $this->morphTo();
    }
}
