@props([
    'title' => 'null',
    'description' => 'undefined'
])

<div {{ $attributes->merge(['class'=>'col-sm-6 col-md-4 col-lg-3']) }}>
    <a {{ $attributes }}
    class="text-decoration-none">
        <div class="card custom-card h-100 shadow-sm">
            <div class="card-body">
                <h3 class="card-title h5 mb-2 text-dark">
                    {{ $title }}
                </h3>
                <p class="card-text text-muted small">
                    {{ $description }}
                </p>
            </div>
        </div>
    </a>
</div>
