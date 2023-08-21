@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between">
                    <h4 class="card-title mb-3">{{ $permintaan->nama_barang }}</h4>
                </div>
                <div class="row">
                    <table class="table table-responsive">
                        <tr>
                            <th>Product Name</th>
                            <th>:</th>
                            <td>{{ $permintaan->nama_barang }}</td>
                        </tr>
                        <tr>
                            <th>Types of Products</th>
                            <th>:</th>
                            <td>{{ $permintaan->jenis_barang }}</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <th>:</th>
                            <td>Rp{{ number_format($permintaan->harga, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Link</th>
                            <th>:</th>
                            <td><a href="{{ $permintaan->link }}" target="_blank">{{ $permintaan->link }}</a></td>
                        </tr>
                        <tr>
                            <th>Create At</th>
                            <th>:</th>
                            <td>{{ $permintaan->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Note</th>
                            <th>:</th>
                            <td>{{ $permintaan->note }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <th>:</th>
                            <td>{{ $permintaan->status }}</td>
                        </tr>
                    </table>
                </div>
                <a class="nav-link" href="http://127.0.0.1:8000/permintaans" align="right">
                    <button type="button" class="btn btn-primary mr-2">Back</button>
                </a>
            </div>
        </div>
    </div>
@endsection
