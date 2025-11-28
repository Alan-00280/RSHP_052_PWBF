@props([
    'text'=>'null',
    'icon' => 'icon-grid menu-icon'
])

<li class="nav-item">
    <a class="nav-link" {{ $attributes }}>
        <i class="{{ $icon }} menu-icon" style="font-size: 20px"></i>
        <span class="menu-title">{{ $text }}</span>
    </a>
</li>