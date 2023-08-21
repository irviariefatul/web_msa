@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">EDIT SALARY</h4>
                <form class="forms-sample" method="POST" action="{{ route('salaries.update', $salary->id) }}">
                    @csrf
                    @method('PUT')
                    <p class="card-description">
                        Edit Salary
                    </p>
                    <div class="form-group">
                        <label for="nama_posisi">Level <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_posisi" id="nama_posisi"
                            value="{{ $salary->nama_posisi }}" required>
                    </div>
                    <div class="form-group">
                        <label for="kompetensi">Competency <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="kompetensi" id="kompetensi"
                            value="{{ $salary->kompetensi }}" required>
                    </div>
                    <div class="form-group">
                        <label for="gaji">Salary <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="gaji" id="gaji" placeholder="Salary"
                            value="{{ $salary->gaji }}" required>
                    </div>
                    <button type="submit" name="edit" class="btn btn-primary align-self-center">Update</button>
                    <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
