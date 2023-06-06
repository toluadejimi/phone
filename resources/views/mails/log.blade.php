@component('mail::message')

Dear {{ $data1['name'] }},<br><br>

{{ __('Below are the details of your log') }}
<br><br>
{{ __('Log Data') }} <br>
<strong>{{ $data1['logdata'] }}</strong>.<br><br>
{{ __('Area Code ') }}  <br>
<strong>{{ $data1['area_code'] }}</strong>.<br><br>


  <h1 style="color: red;"> Please read carefully !!!</h1>
  <p>Currently there is an updates going on with @gmail Gv which may lead 
 to blocking instantly as u buy it that why we are unable to upload more here.</p>
  
  <h1><strong>Steps to take when you buy @gmail gv</h1></strong>
  <ul>
  <li>Firstly Delete your google voice app and install it back.</li>
 <li> Don’t change the password of your gv yet.</li>
  <li>Make sure you use the gv to chat first and set 2 factor security.</li>
  <li>Please don’t send too much text at a time wait for a reply before you will send another one</li</ul>
 
 <h3> Note: Please if you know that you cannot folow this rule dont buy the Gv</h3>  
  <h4><strong>IF YOU HAVE ALREADY CHANGE PASSWORD DONT BOTHER TO SEND ANY COMPLAIN</h4> </strong> 



{{ __('Thank Your ') }} <br>
{{ config('app.name') }}
