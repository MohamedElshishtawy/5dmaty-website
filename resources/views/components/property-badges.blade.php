@props(['property'])
@php
    $type = $property->property_type ?? null;
    $status = $property->property_status ?? null;
    $typeLabel = method_exists($property, 'getTypeLabel') ? $property->getTypeLabel() : ($type === 'rent' ? __('general.rent') : __('general.sale'));
    $statusLabel = method_exists($property, 'getStatusLabel') ? $property->getStatusLabel() : null;

    $typeStyle = $type === \App\Models\Property::TYPE_RENT
        ? 'background: linear-gradient(135deg, #FFC107, #FF9800); color:#000;'
        : 'background: linear-gradient(135deg, #A5D6A7, #66BB6A); color:#000;';

    $statusStyle = 'background: linear-gradient(135deg, #FFD700, #FFA500); color:#000;';
@endphp

<div {{ $attributes->merge(['class' => 'd-inline-flex align-items-center gap-2']) }}>
    <span class="badge rounded-pill" style="{{ $typeStyle }} font-weight:600;">
        {{ $typeLabel }}
    </span>
    @if($status === \App\Models\Property::STATUS_SOLD)
        <span class="badge rounded-pill" style="{{ $statusStyle }} font-weight:600;">
            {{ $statusLabel }}
        </span>
    @endif
</div>



















