<div class="flex items-center gap-3 max-w-md">
    <div class="max-w-[140px] w-full">
        <select class="form-input" wire:model.lazy="sortByPeriode">
            @foreach ($periodes as $periode)
                <option value="{{ $periode->id }}">{{ $periode->periode }}</option>
            @endforeach
        </select>
    </div>
    <div class="max-w-[140px] w-full">
        @php
            $divisions = ['semua', 'ksb', 'kaderisasi', 'psdm', 'kominfo', 'kwu', 'humas', 'kerohanian'];
        @endphp
        <select class="form-input" wire:model.lazy="sortByDivision">
            @foreach ($divisions as $division)
                <option class="capitalize" value="{{ $division }}">{{ $division }}</option>
            @endforeach
        </select>
    </div>
</div>
