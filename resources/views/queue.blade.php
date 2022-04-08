@component('mail::message')
# Welcome {{$user->name}}
This is Test Message



@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
