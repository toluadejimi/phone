@component('mail::message')

Dear {{ $data1['name'] }},<br><br>

{{ __('Below are the details of your log') }}
<br><br>
{{ __('Log Data') }} <br>
<strong>{{ $data1['logdata'] }}</strong>.<br><br>
{{ __('Area Code ') }}  <br>
<strong>{{ $data1['area_code'] }}</strong>.<br><br>





{{ __('Thank Your ') }} <br>
{{ config('app.name') }}
