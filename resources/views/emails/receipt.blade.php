{{--@formatter:off--}}
<x-mail::message>
# Hello, {{ $name }}

Payment Confirmed! Your receipt is ready! You can view your receipt by clicking the link below.

<x-mail::button :url="$invoiceUrl">
    View Invoice Receipt
</x-mail::button>

If you have any questions, feel free to contact us.

Thanks,<br>
{{ config('app.name') }}

</x-mail::message>
