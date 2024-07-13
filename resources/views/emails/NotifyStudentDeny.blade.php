<x-mail::message>
# Good day Mr/Ms {{ $student->last_name }},

Your application for Subject Accreditation for the subject has been rejected by the corresponding program chairman, reason:”{{ $remarks }}”. You may go to the USTPAS website.

@component('mail::button', ['url' => 'http://127.0.0.1:8000'])
Proceed
@endcomponent

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>