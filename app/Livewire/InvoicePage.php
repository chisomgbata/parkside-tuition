<?php

namespace App\Livewire;

use App\Models\Invoice;
use Filament\Notifications\Notification;
use Livewire\Component;


class InvoicePage extends Component
{

    public Invoice $invoice;

    public function mount(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function markAsPaid()
    {
        $this->invoice->update([
            'status' => 'paid',
            'paid_at' => now()
        ]);

        Notification::make()->title('Invoice Paid')->success()->send();


    }


    public function render()
    {
        return view('livewire.invoice');
    }
}
