@component('mail::message')
    # Account Status
    {{--{{dd($request->user)}}--}}
    {{--Hi !!--}}
{{--    <br>--}}
    {{ $x }}.
{{--    <br>--}}

    {{--@component('mail::button', ['url' => url('appointment/'. $request['id'])])--}}
    {{--View Appointment--}}
    {{--@endcomponent--}}



    Thanks,
    {{ config('app.name') }}
@endcomponent
