<div class="max-w-3xl mx-auto mt-8 bg-white shadow-md rounded-lg">
    <!-- Invoice Header -->
    <div class="p-6 border-b border-gray-200">
        <h1 class="text-2xl font-bold text-gray-700">Invoice  {{$invoice->status == 'confirmed' ? 'Receipt' : ''}}
        </h1>
        <p class="text-sm text-gray-500">Invoice {{$invoice->invoice_number}}</p>
        <p class="text-sm text-gray-500">{{\Carbon\Carbon::parse($invoice->created_at)->format('d M Y')}}</p>
    </div>

    <!-- Invoice Details -->
    <div class="p-6">
        <table class="w-full border-collapse border border-gray-200">
            <thead>
            <tr>
                <th class="border border-gray-200 p-2 text-left text-gray-600">Item</th>
                <th class="border border-gray-200 p-2 text-right text-gray-600">Price</th>

            </tr>
            </thead>
            <tbody>

            @foreach($invoice->items as $item)

                <tr>
                    <td class="border border-gray-200 p-2">{{$item->description}}</td>
                    <td class="border border-gray-200 p-2 text-right">£{{$item->price}}</td>
                </tr>
            @endforeach

            </tbody>
            <tfoot>
            <tr>
                <td colspan="3" class="border border-gray-200 p-2 text-right font-bold">Total</td>
                <td class="border border-gray-200 p-2 text-right font-bold">
                    £{{$invoice->items->sum('price')}}
                </td>
            </tr>
            </tfoot>
        </table>
    </div>

    <!-- Bank Account Section -->
    @php
    if(file_exists('account-details.txt')){
        $file = file_get_contents('account-details.txt');
    }
    @endphp

    @if(file_exists('account-details.txt'))
        {!! $file !!}
    @else

    @endif


    <!-- Mark as Paid Button -->
    <div class="p-6 border-t border-gray-200 flex justify-end">
        @if($invoice->paid_at)
            <p class="text-sm text-gray-500">Paid on {{\Carbon\Carbon::parse($invoice->paid_at)->format('d M Y')}}</p>
        @else
            <button class="px-4 py-2 bg-blue-500 text-white font-semibold rounded shadow hover:bg-blue-600" wire:click="markAsPaid"
            >Mark as Paid</button>
        @endif

    </div>

    @livewire('notifications')
</div>
