@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">ADD HUMAN RESOURCE COST</h4>
                <form class="forms-sample" method="POST" action="{{ route('service_fees.store') }}">
                    @csrf
                    <p class="card-description">Human Resource Cost</p>
                    @livewire('h-r-fee') <!-- Memanggil komponen Livewire HRFee -->
                    <button type="submit" name="add" class="btn btn-primary align-self-center">Submit</button>
                    <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    @livewireScripts
    @stack('scripts2')
@endsection
