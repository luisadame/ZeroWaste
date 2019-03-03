@php
$types = [
    'primary' => 'alert-primary',
    'secondary' => 'alert-secondary',
    'success' => 'alert-success',
    'danger' => 'alert-danger',
    'warning' => 'alert-warning',
    'info' => 'alert-info',
    'light' => 'alert-light',
    'dark' => 'alert-dark'
];
@endphp
<div class="alert {{ $types[$alert['type']] }}" role="alert">
    {{ $alert['content'] }}
</div>
