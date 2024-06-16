@if (session()->has('error')) 
    <p>{{ session()->get('error')}}</p>
@endif