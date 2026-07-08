@php
    $steps = [
        1 => ['label' => 'Data Jurusan', 'icon' => 'fa-info-circle'],
        2 => ['label' => 'Kepala Kompetensi', 'icon' => 'fa-user-tie'],
        3 => ['label' => 'Visi & Misi', 'icon' => 'fa-bullseye'],
        4 => ['label' => 'Galeri', 'icon' => 'fa-images'],
    ];
@endphp

<div class="d-flex justify-content-between mb-4 position-relative">
    @foreach ($steps as $num => $step)
        <div class="text-center flex-fill">
            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center mb-1
                {{ $num < $currentStep ? 'bg-success text-white' : ($num == $currentStep ? 'bg-primary text-white' : 'bg-light text-muted border') }}"
                 style="width:40px;height:40px;">
                @if ($num < $currentStep)
                    <i class="fas fa-check"></i>
                @else
                    <i class="fas {{ $step['icon'] }}"></i>
                @endif
            </div>
            <div class="small {{ $num == $currentStep ? 'fw-semibold text-dark' : 'text-muted' }}">
                {{ $step['label'] }}
            </div>
        </div>
    @endforeach
</div>