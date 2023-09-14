<div>
    <div class="form-row">
        @foreach ($opts as $index3 => $opt)
            <div class="form-group col-md-7">
                <label for="OperationalName[{{ $index3 }}][id]">Operational Name<span
                        class="text-danger">*</span></label>
                <select wire:model="opts.{{ $index3 }}.id" class="form-control select2"
                    name="opts[{{ $index3 }}][id]" required="required" id="OperationalName-{{ $index3 }}">
                    <option value="">Select Options</option>
                    @foreach ($operationals as $o)
                        <option value="{{ $o->id }}">
                            {{ $o->nama_operasional }} ||
                            Rp{{ number_format($o->harga, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="estimasi_opts{{ $index3 }}">Estimation<span class="text-danger">*</span></label>
                <div class="input-group">
                    <input wire:model="opts.{{ $index3 }}.estimasi_opts" type="number" class="form-control"
                        name="opts[{{ $index3 }}][estimasi_opts]" id="estimasi_opts{{ $index3 }}"
                        placeholder="Estimation" required step="1" wire:key="{{ $index3 }}">
                </div>
            </div>
            <div class="form-group col-md-2">
                <label for="pemeliharaan_opts{{ $index3 }}">Maintenance Cost (%)<span
                        class="text-danger">*</span></label>
                <div class="input-group">
                    <input wire:model="opts.{{ $index3 }}.pemeliharaan_opts" type="number" class="form-control"
                        name="opts[{{ $index3 }}][pemeliharaan_opts]" id="pemeliharaan_opts{{ $index3 }}"
                        placeholder="Maintenance Cost (%)" step="0" wire:key="{{ $index3 }}">
                    <div class="col-md-2">
                        <button wire:click.prevent="removeInput3({{ $index3 }})"
                            class="btn btn-sm btn-danger">Hapus</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <button wire:click.prevent="addInput3" class="btn btn-sm btn-success baris-baru">Add Component </button>
    <script>
        $('#OperationalName-{{ $index3 }}').select2({
            placeholder: "Search...",
            width: "100%", // Atur lebar dropdown sesuai kebutuhan Anda
        });
        $('#OperationalName-{{ $index3 }}').on('change', function(e) {
            var index = $(this).attr('id').split('-')[1];
            var data = $(this).val();
            @this.set('opts.' + index + '.id', data);
        });
    </script>
</div>

@push('scripts4')
    <script>
        $(document).ready(function() {
            window.addEventListener('reApplySelect2o', () => {
                @foreach ($opts as $index3 => $opt)
                    $('.select2').select2({
                        placeholder: "Search...",
                        width: "100%", // Atur lebar dropdown sesuai kebutuhan Anda
                    });
                    $('.select2').on('change', function(e) {
                        var index2 = $(this).attr('id').split('-')[1];
                        var data = $(this).val();
                        @this.set('opts.' + index2 + '.id', data);
                    });
                @endforeach
            });
        });
    </script>
@endpush
