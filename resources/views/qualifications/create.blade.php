@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">ADD QUALIFICATION</h4>
                <form class="forms-sample" method="POST" action="{{ route('qualifications.store') }}">
                    <p class="card-description">Add Qualification</p>
                    @csrf
                    <div class="form-group">
                        <label for="layanan">Service Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="layanan" id="layanan" placeholder="Service Name"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_layanan">Service Description<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="deskripsi_layanan" id="deskripsi_layanan"
                            placeholder="Service Description" required>
                    </div>
                    <div class="form-group">
                        <label for="jenjang_pendidikan">Education Level<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="jenjang_pendidikan" id="jenjang_pendidikan"
                            placeholder="Education Level" required>
                    </div>
                    <div class="form-group">
                        <label for="lavel">Level<span class="text-danger">*</span></label>
                        <div class="input-group-prepend">
                            <input type="text" class="form-control" aria-label="Text input with dropdown button"
                                id="searchInput" placeholder="Search...">
                            <select class="btn btn-sm btn-outline-primary dropdown-toggle" aria-haspopup="true"
                                aria-expanded="false" name="Salary" required="required" id="salaryDropdown">
                                <option value="">Select Options</option>
                                @foreach ($salaries as $s)
                                    <option value="{{ $s->id }}">{{ $s->nama_posisi }}</option>
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
