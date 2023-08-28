<div>
    <div class="form-group">
        <label for="layanan">Allowances<span class="text-danger">*</span></label>
        @foreach ($inputs as $index => $input)
            <div class="form-group">
                <div class="input-group-prepend">
                    <select class="form-control" name="Allowance[{{ $index }}][id]"
                        wire:model="inputs.{{ $index }}.id" required>
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
