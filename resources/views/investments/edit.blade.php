@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">EDIT INVESTMENT COMPONENT</h4>
                <form class="forms-sample" method="POST"
                    action="{{ route('investments.update', ['investment' => $investment->id]) }}">
                    <p class="card-description">
                        Edit Investment Component
                    </p>
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_invest">Investment Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_invest" id="nama_invest"
                            placeholder="Investment Name" value="{{ $investment->nama_invest }}" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Description<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="Description"
                            value="{{ $investment->deskripsi }}" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Price<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="harga" id="harga" placeholder="Price"
                            value="{{ $investment->harga }}" required>
                    </div>
                    <button type="submit" name="edit" class="btn btn-primary align-self-center">Update</button>
                    <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
