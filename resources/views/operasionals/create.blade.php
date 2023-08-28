@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">ADD OPERATIONAL COMPONENT</h4>
                <form class="forms-sample" method="POST" action="{{ route('operasionals.store') }}">
                    <p class="card-description">
                        Add Operational Component
                    </p>
                    @csrf
                    <div class="form-group">
                        <label for="nama_operasional">Operational Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_operasional" id="nama_operasional"
                            placeholder="Operational Name" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Description<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="Description"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Price<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="harga" id="harga" placeholder="Price"
                            required>
                    </div>
                    <button type="submit" name="add" class="btn btn-primary align-self-center">Submit</button>
                    <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
