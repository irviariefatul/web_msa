@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">EDIT ALLOWANCE</h4>
                <form class="forms-sample" method="POST" action="{{ route('allowances.update', $allowance->id) }}">
                    @csrf
                    @method('PUT')
                    <p class="card-description">
                        Edit Allowance
                    </p>
                    <div class="form-group">
                        <label for="nama_tunjangan">Allowance Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_tunjangan" id="nama_tunjangan"
                            value="{{ $allowance->nama_tunjangan }}" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Description<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="deskripsi" id="deskripsi"
                            value="{{ $allowance->deskripsi }}" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Price<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="harga" id="harga" placeholder="Price"
                            value="{{ $allowance->harga }}" required>
                    </div>
                    <button type="submit" name="edit" class="btn btn-primary align-self-center">Update</button>
                    <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
