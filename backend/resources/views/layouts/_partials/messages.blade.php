@if (session()->has('error')) 
    <p>{{ session()->get('error')}}</p>
@elseif (session()->has('success'))
    <p>{{ session()->get('success') }}</p>
@endif