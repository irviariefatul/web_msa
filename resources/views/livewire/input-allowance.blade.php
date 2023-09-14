<div>
    <div class="form-group">
        <label for="nama_tunjangan">Allowances<span class="text-danger">*</span></label>
        @foreach ($inputs as $index => $input)
            <div class="form-group">
                <div class="input-group-prepend">
                    <select class="form-control select2" name="Allowance[{{ $index }}][id]"
                        wire:model="inputs.{{ $index }}.id" id="Allowance-{{ $index }}" required>
                        <option value="">Select Options</option>
                        @foreach ($allowances as $a)
                            <option value="{{ $a->id }}">{{ $a->nama_tunjangan }} ||
                                Rp{{ number_format($a->harga, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                    <button wire:click.prevent="removeInput({{ $index }})"
                        class="btn btn-sm btn-danger">Hapus</button>
                </div>
            </div>
        @endforeach
        <button wire:click.prevent="addInput" class="btn btn-sm btn-success">Add Allowances</button>
        <script>
            $('#Allowance-{{ $index }}').select2({
                placeholder: "Search...",
                width: "100%", // Atur lebar dropdown sesuai kebutuhan Anda
            });
            $('#Allowance-{{ $index }}').on('change', function(e) {
                var index = $(this).attr('id').split('-')[1];
                var data = $(this).val();
                @this.set('inputs.' + index + '.id', data);
            });
        </script>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            window.addEventListener('reApplySelect2', () => {
                @foreach ($inputs as $index => $input)
                    $('.select2').select2({
                        placeholder: "Search...",
                        width: "100%", // Atur lebar dropdown sesuai kebutuhan Anda
                    });
                    $('.select2').on('change', function(e) {
                        var index = $(this).attr('id').split('-')[1];
                        var data = $(this).val();
                        @this.set('inputs.' + index + '.id', data);
                    });
                @endforeach
            });
        });
    </script>
@endpush
