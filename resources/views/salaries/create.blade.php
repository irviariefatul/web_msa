@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">ADD SALARY</h4>
                <form class="forms-sample" method="POST" action="{{ route('salaries.store') }}">
                    <p class="card-description">
                        Add Salary
                    </p>
                    @csrf
                    <div class="form-group">
                        <label for="nama_posisi">Level <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_posisi" id="nama_posisi" placeholder="Level"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="kompetensi">Competency <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="kompetensi" id="kompetensi"
                            placeholder="Competency" required>
                    </div>
                    <div class="form-group">
                        <label for="gaji">Salary<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="gaji" id="gaji" placeholder="Salary"
                            required>
                    </div>
                    <button type="submit" name="add" class="btn btn-primary align-self-center">Submit</button>
                    <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
