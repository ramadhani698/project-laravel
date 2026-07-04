@php
    $steps = [
        1 => 'Biodata',
        2 => 'Keluarga',
        3 => 'Jurusan',
        4 => 'Berkas',
        5 => 'Review',
    ];
@endphp

<div class="tracker" id="tracker">
    @foreach ($steps as $number => $label)
        <div class="step-node @if($number === 1) active @endif" data-step="{{ $number }}">
            <div class="dot">
                <span class="dot-number">{{ $number }}</span>
                <span class="dot-check"><i class="ti ti-check"></i></span>
                <div class="rays">
                    <span style="transform:rotate(45deg)"></span>
                    <span style="transform:rotate(90deg)"></span>
                    <span style="transform:rotate(135deg)"></span>
                    <span style="transform:rotate(180deg)"></span>
                    <span style="transform:rotate(225deg)"></span>
                    <span style="transform:rotate(270deg)"></span>
                </div>
            </div>
            <div class="label">{{ $label }}</div>
        </div>
    @endforeach
</div>