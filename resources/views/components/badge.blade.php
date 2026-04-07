@props(['status'])

@php
    $color = $status === 'published' ? 'success' : 'secondary';
    $label = $status === 'published' ? 'Đã xuất bản' : 'Nháp';
@endphp

<span class="badge bg-{{ $color }}">{{ $label }}</span>
