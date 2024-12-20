<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_number',
        'client_id',
        'due_date',
        'status',
        'additional_notes',
        'sent_at',
        'paid_at',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    protected function casts()
    {
        return [
            'due_date' => 'timestamp',
            'paid_at' => 'timestamp',
            'sent_at' => 'timestamp',
        ];
    }

    public function invoiceItems(): HasMany
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id');
    }
}
