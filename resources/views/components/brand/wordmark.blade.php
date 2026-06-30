@props(['class' => '', 'markClass' => 'h-9 w-auto'])

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-2 '.$class]) }}>
    <x-brand.mark :class="$markClass" />
    <span class="font-wordmark text-[1.7rem] leading-none lowercase">asfouri</span>
</span>
