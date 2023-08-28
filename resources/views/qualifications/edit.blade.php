@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">EDIT QUALIFICATION</h4>
                <form class="forms-sample" method="POST" action="{{ route('qualifications.update', $qualification->id) }}">
                    <p class="card-description">Edit Qualification</p>
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="layanan">Service Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="layanan" id="layanan" placeholder="Service Name"
                            required value="{{ $qualification->layanan }}">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_layanan">Service Description<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="deskripsi_layanan" id="deskripsi_layanan"
                            placeholder="Service Description" required value="{{ $qualification->deskripsi_layanan }}">
                    </div>
                    <div class="form-group">
                        <label for="jenjang_pendidikan">Education Level<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="jenjang_pendidikan" id="jenjang_pendidikan"
                            placeholder="Education Level" required value="{{ $qualification->jenjang_pendidikan }}">
                    </div>
                    <div class="form-group">
                        <label for="level">Level<span class="text-danger">*</span></label>
                        <div class="input-group-prepend">
                            <select class="form-control select2" name="Salary" required="required" id="Salary">
                                <option value="">Select Options</option>
                                @foreach ($salaries as $s)
                                    <option value="{{ $s->id }}" @if ($qualification->salaries->id == $s->id) selected @endif>
                                        {{ $s->nama_posisi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="edit" class="btn btn-primary align-self-center">Update</button>
                    <a href="{{ route('qualifications.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
