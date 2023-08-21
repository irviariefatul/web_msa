@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">ADD CALCULATION</h4>
                <form class="forms-sample" method="POST" action="{{ route('perhitungan_gajis.store') }}">
                    <p class="card-description">Add Calculation</p>
                    @csrf
                    <div class="form-group">
                        <label for="layanan">Service Name<span class="text-danger">*</span></label>
                        <div class="input-group-prepend">
                            <input type="text" class="form-control" aria-label="Text input with dropdown button"
                                id="searchInput" placeholder="Search...">
                            <select class="btn btn-sm btn-outline-primary dropdown-toggle" aria-haspopup="true"
                                aria-expanded="false" name="Qualification" required="required" id="qualificationDropdown">
                                <option value="">Select Options</option>
                                @foreach ($qualifications as $q)
                                    <option value="{{ $q->id }}">{{ $q->layanan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="add" class="btn btn-primary align-self-center">Submit</button>
                    <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
