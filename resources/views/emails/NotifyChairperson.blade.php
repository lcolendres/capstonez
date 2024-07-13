<x-mail::message>
# Good day Mr/Ms {{ $body->last_name }},

A set of students has been added to your dashboard for your approval. Please visit USTP Accreditation System Website.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/login'])
Proceed
@endcomponent

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
