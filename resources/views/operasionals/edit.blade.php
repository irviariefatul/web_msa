@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">EDIT OPERATIONAL COMPONENT</h4>
                <form class="forms-sample" method="POST" action="{{ route('operasionals.update', $operationals->id) }}">
                    <p class="card-description">
                        Edit Operational Component
                    </p>
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_operasional">Operational Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_operasional" id="nama_operasional"
                            placeholder="Operational Name" value="{{ $operationals->nama_operasional }}" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Description<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="Description"
                            value="{{ $operationals->deskripsi }}" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Price<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="harga" id="harga" placeholder="Price"
                            value="{{ $operationals->harga }}" required>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary align-self-center">Update</button>
                    <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
