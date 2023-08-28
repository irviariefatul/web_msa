@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">EDIT SALARY CALCULATION</h4>
                <form class="forms-sample" method="POST"
                    action="{{ route('perhitungan_gajis.update', ['perhitungan_gaji' => $perhitunganGaji->id]) }}">
                    <p class="card-description">Edit Calculation</p>
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="layanan">Service Name<span class="text-danger">*</span></label>
                        <div class="input-group-prepend">
                            @can('manage-users')
                                <select class="form-control select2" name="Qualification" required="required"
                                    id="Qualification">
                                    <option value="">Select Options</option>
                                    @foreach ($qualifications as $q)
                                        @if ($q->user_id === auth()->user()->id)
                                            <option value="{{ $q->id }}"
                                                {{ $q->id == $perhitunganGaji->qualification_id ? 'selected' : '' }}>
                                                {{ $q->layanan }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @endcan
                            @can('manage-admins')
                                <select class="form-control select2" name="Qualification" required="required"
                                    id="Qualification">
                                    <option value="">Select Options</option>
                                    @foreach ($qualifications as $q)
                                        <option value="{{ $q->id }}"
                                            {{ $q->id == $perhitunganGaji->qualification_id ? 'selected' : '' }}>
                                            {{ $q->layanan }}</option>
                                    @endforeach
                                </select>
                            @endcan
                        </div>
                    </div>
                    @livewire('input-allowance-edit', ['existingAllowances' => $perhitunganGaji->allowances])
                    @livewireScripts
                    <button type="submit" name="edit" class="btn btn-primary align-self-center">Update</button>
                    <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
