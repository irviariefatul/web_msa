@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between">
                    <h4 class="card-title mb-3">{{ $operationals->nama_operasional }}</h4>
                </div>
                <div class="row">
                    <table class="table table-responsive">
                        <tr>
                            <th>Operational Name</th>
                            <th>:</th>
                            <td>{{ $operationals->nama_operasional }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <th>:</th>
                            <td>{{ $operationals->deskripsi }}</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <th>:</th>
                            <td>Rp{{ number_format($operationals->harga, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Create At</th>
                            <th>:</th>
                            <td>{{ $operationals->created_at }}</td>
                        </tr>
                    </table>
                </div>
                <a class="nav-link" href="http://127.0.0.1:8000/operasionals" align="right">
                    <button type="button" class="btn btn-primary mr-2">Back</button>
                </a>
            </div>
        </div>
    </div>
@endsection
