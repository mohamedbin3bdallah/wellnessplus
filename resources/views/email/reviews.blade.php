@component('mail::message')
    # Reviews
    Hi !!

    {{ $x }}.


    {{--@component('mail::button', ['url' => url('appointment/'. $request['id'])])--}}
    {{--View Appointment--}}
    {{--@endcomponent--}}



    Thanks,
    {{ config('app.name') }}
@endcomponent
