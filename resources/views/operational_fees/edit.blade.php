@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">EDIT OPERATIONAL COMPONENT COSTS</h4>
                <form class="forms-sample" method="POST" action="{{ route('operational_fees.update', $operationalFee->id) }}">
                    @csrf
                    @method('PUT')
                    <p class="card-description">Operational Component Costs</p>
                    <div class="form-group">
                        <label for="layanan">Service Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="layanan" id="layanan" placeholder="Service Name"
                            required value="{{ $operationalFee->layanan }}">
                    </div>
                    @livewire('operational-fee-edit', ['operationalFee' => $operationalFee->id])
                    <button type="submit" name="add" class="btn btn-primary align-self-center">Submit</button>
                    <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    @livewireScripts
    @stack('scripts4')
@endsection
