@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">ADD OPERATIONAL COMPONENR COSTS</h4>
                <form class="forms-sample" method="POST" action="{{ route('operational_fees.store') }}">
                    @csrf
                    <p class="card-description">Operational Component Costs</p>
                    <div class="form-group">
                        <label for="layanan">Service Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="layanan" id="layanan" placeholder="Service Name"
                            required>
                    </div>
                    @livewire('operational-fee')
                    <button type="submit" name="add" class="btn btn-primary align-self-center">Submit</button>
                    <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    @livewireScripts
    @stack('scripts4')
@endsection
