@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">EDIT HUMAN RESOURCE COST</h4>
                <form class="forms-sample" method="POST" action="{{ route('service_fees.update', $serviceFee->id) }}">
                    @csrf
                    @method('PUT') <!-- Untuk metode HTTP PUT/PATCH -->
                    <p class="card-description">Human Resource Cost</p>
                    @livewire('h-r-fee-edit', ['serviceFee' => $serviceFee]) <!-- Mengirim data serviceFee ke komponen Livewire HRFeeEdit -->
                    <button type="submit" name="update" class="btn btn-primary align-self-center">Update</button>
                    <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    @livewireScripts
    @stack('scripts2')
@endsection
