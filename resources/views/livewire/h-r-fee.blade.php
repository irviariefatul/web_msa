<div>
    <div class="form-row">
        @foreach ($hrs as $index => $hr)
            <div class="form-group col-md-9">
                <label for="ServiceName[{{ $index }}][id]">Service Name<span class="text-danger">*</span></label>
                <select wire:model="hrs.{{ $index }}.id" class="form-control select2"
                    name="hrs[{{ $index }}][id]" required="required" id="ServiceName-{{ $index }}">
                    <option value="">Select Options</option>
                    @foreach ($perhitungan_gajis as $p)
                        @if (auth()->user()->can('manage-admins') || $p->user_id === auth()->user()->id)
                            <option value="{{ $p->id }}">
                                {{ $p->qualifications->layanan }} ||
                                {{ $p->qualifications->salaries->nama_posisi }} ||
                                Rp{{ number_format($p->total_gaji, 0, ',', '.') }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="estimasi{{ $index }}">Estimation<span class="text-danger">*</span></label>
                <div class="input-group">
                    <input wire:model="hrs.{{ $index }}.estimasi" type="number" class="form-control"
                        name="hrs[{{ $index }}][estimasi]" id="estimasi{{ $index }}"
                        placeholder="Estimation" required step="1" wire:key="{{ $index }}">
                    <div class="col-md-2">
                        <button wire:click.prevent="removeInput({{ $index }})"
                            class="btn btn-sm btn-danger">Hapus</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <button wire:click.prevent="addInput" class="btn btn-sm btn-success baris-baru">Add HR</button>
    <script>
        $('#ServiceName-{{ $index }}').select2({
            placeholder: "Search...",
            width: "100%", // Atur lebar dropdown sesuai kebutuhan Anda
        });
        $('#ServiceName-{{ $index }}').on('change', function(e) {
            var index = $(this).attr('id').split('-')[1];
            var data = $(this).val();
            @this.set('hrs.' + index + '.id', data);
        });
    </script>
</div>

@push('scripts2')
    <script>
        $(document).ready(function() {
            window.addEventListener('reApplySelect2', () => {
                @foreach ($hrs as $index => $hr)
                    $('.select2').select2({
                        placeholder: "Search...",
                        width: "100%", // Atur lebar dropdown sesuai kebutuhan Anda
                    });
                    $('.select2').on('change', function(e) {
                        var index = $(this).attr('id').split('-')[1];
                        var data = $(this).val();
                        @this.set('hrs.' + index + '.id', data);
                    });
                @endforeach
            });
        });
    </script>
@endpush
