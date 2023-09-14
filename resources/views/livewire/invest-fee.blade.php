<div>
    <div class="form-row">
        @foreach ($ivts as $index2 => $ivt)
            <div class="form-group col-md-7">
                <label for="InvestmentName[{{ $index2 }}][id]">Investment Name<span
                        class="text-danger">*</span></label>
                <select wire:model="ivts.{{ $index2 }}.id" class="form-control select2"
                    name="ivts[{{ $index2 }}][id]" required="required" id="InvestmentName-{{ $index2 }}">
                    <option value="">Select Options</option>
                    @foreach ($investments as $i)
                        <option value="{{ $i->id }}">
                            {{ $i->nama_invest }} ||
                            Rp{{ number_format($i->harga, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="estimasi_ivts{{ $index2 }}">Estimation<span class="text-danger">*</span></label>
                <div class="input-group">
                    <input wire:model="ivts.{{ $index2 }}.estimasi_ivts" type="number" class="form-control"
                        name="ivts[{{ $index2 }}][estimasi_ivts]" id="estimasi_ivts{{ $index2 }}"
                        placeholder="Estimation" required step="1" wire:key="{{ $index2 }}">
                </div>
            </div>
            <div class="form-group col-md-2">
                <label for="pemeliharaan_ivts{{ $index2 }}">Maintenance Cost (%)<span
                        class="text-danger">*</span></label>
                <div class="input-group">
                    <input wire:model="ivts.{{ $index2 }}.pemeliharaan_ivts" type="number" class="form-control"
                        name="ivts[{{ $index2 }}][pemeliharaan_ivts]" id="pemeliharaan_ivts{{ $index2 }}"
                        placeholder="Maintenance Cost (%)" step="0" wire:key="{{ $index2 }}">
                    <div class="col-md-2">
                        <button wire:click.prevent="removeInput2({{ $index2 }})"
                            class="btn btn-sm btn-danger">Hapus</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <button wire:click.prevent="addInput2" class="btn btn-sm btn-success baris-baru">Add Component </button>
    <script>
        $('#InvestmentName-{{ $index2 }}').select2({
            placeholder: "Search...",
            width: "100%", // Atur lebar dropdown sesuai kebutuhan Anda
        });
        $('#InvestmentName-{{ $index2 }}').on('change', function(e) {
            var index = $(this).attr('id').split('-')[1];
            var data = $(this).val();
            @this.set('ivts.' + index + '.id', data);
        });
    </script>
</div>

@push('scripts3')
    <script>
        $(document).ready(function() {
            window.addEventListener('reApplySelect2i', () => {
                @foreach ($ivts as $index2 => $ivt)
                    $('.select2').select2({
                        placeholder: "Search...",
                        width: "100%", // Atur lebar dropdown sesuai kebutuhan Anda
                    });
                    $('.select2').on('change', function(e) {
                        var index2 = $(this).attr('id').split('-')[1];
                        var data = $(this).val();
                        @this.set('ivts.' + index2 + '.id', data);
                    });
                @endforeach
            });
        });
    </script>
@endpush
