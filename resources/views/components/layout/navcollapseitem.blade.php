@props([
    'text' => 'null'
])
<li class="nav-item"> 
    <a class="nav-link" {{ $attributes }}>{{ $text }}</a>
</li>