@props(['class' => '', 'markClass' => 'h-9 w-auto'])

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-2.5 '.$class]) }}>
    <x-brand.mark :class="$markClass" />
    <span class="font-display text-2xl font-medium lowercase tracking-tight">asfouri</span>
</span>
