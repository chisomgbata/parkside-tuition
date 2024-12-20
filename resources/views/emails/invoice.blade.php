{{--@formatter:off--}}
<x-mail::message>
# Hello, {{ $name }}

Your invoice is ready! You can view your invoice by clicking the link below.

<x-mail::button :url="$invoiceUrl">
    View Invoice
</x-mail::button>

If you have any questions, feel free to contact us.

Thanks,<br>
{{ config('app.name') }}

</x-mail::message>
