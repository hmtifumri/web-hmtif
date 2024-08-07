<div class="flex items-center gap-3 max-w-md">
    <div class="max-w-[140px] w-full">
        <select class="form-input" wire:model.lazy="sortByPeriode">
            @foreach ($periodes as $periode)
                <option value="{{ $periode->id }}">{{ $periode->periode }}</option>
            @endforeach
        </select>
    </div>
    <div class="max-w-[140px] w-full">
        <select class="form-input" wire:model.lazy="sortByDivision">
            <option value="semua">Semua</option>
            @foreach ($divisions as $division)
                @if ($division->divisi != 'admin')
                    <option class="capitalize" value="{{ $division->id }}">{{ $division->singkatan }}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>
