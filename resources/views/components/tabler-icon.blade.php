<svg viewBox="0 0 24 24" stroke="currentColor"
    stroke-width="{{ $strokeWidth ?? 1 }}"
    class="inline-block relative h-2 {{ $class ?? '' }}"
    {{ $attributes->except(['class','icon']) }}
>

    <use xlink:href="/tabler/tabler-sprite-nostroke.svg#tabler-{{$icon}}" />

</svg>
