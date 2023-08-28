<div>
    <div class="form-group">
        <label for="layanan">Allowances<span class="text-danger">*</span></label>
        @foreach ($inputs as $index => $input)
            <div class="form-group">
                <div class="input-group-prepend">
                    <select class="form-control select2" name="Allowance[{{ $index }}][id]"
                        wire:model="inputs.{{ $index }}.id" id="Allowance-{{ $index }}" required>
                        <option value="">Select Options</option>
                        @foreach ($allowances as $a)
                            <option value="{{ $a->id }}">{{ $a->nama_tunjangan }}</option>
                        @endforeach
                    </select>
                    <button wire:click.prevent="removeInput({{ $index }})"
                        class="btn btn-sm btn-danger">Hapus</button>
                </div>
            </div>
        @endforeach
        <button wire:click.prevent="addInput" class="btn btn-sm btn-success">Add Allowances</button>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize Select2 for existing inputs
            @foreach ($inputs as $index => $input)
                $('#Allowance-{{ $index }}').select2();
                $('#Allowance-{{ $index }}').on('change', function(e) {
                    var data = $(this).val();
                    @this.set('inputs.{{ $index }}.id', data);
                });
            @endforeach
        });
    </script>
@endpush
