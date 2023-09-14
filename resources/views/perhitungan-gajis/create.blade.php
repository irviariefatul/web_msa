@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">ADD SALARY CALCULATION</h4>
                <form class="forms-sample" method="POST" action="{{ route('perhitungan_gajis.store') }}">
                    <p class="card-description">Add Salary Calculation</p>
                    @csrf
                    <div class="form-group">
                        <label for="layanan">Service Name<span class="text-danger">*</span></label>
                        <div class="input-group-prepend">
                            @can('manage-users')
                                <select class="form-control select2" name="Qualification" required="required"
                                    id="Qualification">
                                    <option value="">Select Options</option>
                                    @foreach ($qualifications as $q)
                                        @if ($q->user_id === auth()->user()->id)
                                            <option value="{{ $q->id }}">{{ $q->salaries->nama_posisi }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @endcan
                            @can('manage-admins')
                                <select class="form-control select2" name="Qualification" required="required"
                                    id="Qualification">
                                    <option value="">Select Options</option>
                                    @foreach ($qualifications as $q)
                                        <option value="{{ $q->id }}">{{ $q->layanan }} ||
                                            {{ $q->salaries->nama_posisi }}
                                        </option>
                                    @endforeach
                                </select>
                            @endcan
                        </div>
                    </div>
                    @livewire('input-allowance')
                    <button type="submit" name="add" class="btn btn-primary align-self-center">Submit</button>
                    <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    @livewireScripts
    @stack('scripts')
@endsection
