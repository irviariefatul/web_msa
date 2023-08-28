@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between">
                    <h4 class="card-title mb-3">{{ $investment->nama_invest }}</h4>
                </div>
                <div class="row">
                    <table class="table table-responsive">
                        <tr>
                            <th>Investment Name</th>
                            <th>:</th>
                            <td>{{ $investment->nama_invest }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <th>:</th>
                            <td>{{ $investment->deskripsi }}</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <th>:</th>
                            <td>Rp{{ number_format($investment->harga, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Create At</th>
                            <th>:</th>
                            <td>{{ $investment->created_at }}</td>
                        </tr>
                    </table>
                </div>
                <a class="nav-link" href="http://127.0.0.1:8000/investments" align="right">
                    <button type="button" class="btn btn-primary mr-2">Back</button>
                </a>
            </div>
        </div>
    </div>
@endsection
