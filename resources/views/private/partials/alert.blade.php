@if(session()->has('alert'))
    @component('private.components.alert', ['alert' => session('alert')])
    @endcomponent
@endif
