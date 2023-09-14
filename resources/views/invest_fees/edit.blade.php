@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">EDIT INVESTMENT COMPONENT COSTS</h4>
                <form class="forms-sample" method="POST" action="{{ route('invest_fees.update', $investFee->id) }}">
                    @csrf
                    @method('PUT')
                    <p class="card-description">Investment Component Costs</p>
                    <div class="form-group">
                        <label for="layanan">Service Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="layanan" id="layanan" placeholder="Service Name"
                            required value="{{ $investFee->layanan }}">
                    </div>
                    @livewire('invest-fee-edit', ['investFee' => $investFee->id]) <!-- Memanggil komponen Livewire InvestFeeEdit -->
                    <button type="submit" name="add" class="btn btn-primary align-self-center">Submit</button>
                    <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    @livewireScripts
    @stack('scripts3')
@endsection
