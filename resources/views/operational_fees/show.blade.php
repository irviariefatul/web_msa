@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between">
                    <h4 class="card-title mb-3">Operational Component Cost Details</h4>
                </div>
                <div class="row">
                    <table class="table table-responsive">
                        <tr>
                            <th>Service Name</th>
                            <th>:</th>
                            <td>{{ $operationalFee->layanan }}</td>
                        </tr>
                        <tr>
                            <th>Components</th>
                            <th>:</th>
                            <td>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Product Name</th>
                                            <th>Prices</th>
                                            <th>Needs Estimation</th>
                                            <th>Maintenance Cost (%)</th>
                                            <th>Maintenance Cost (Rp)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($operationalFee->operasionals as $operasional)
                                            <tr>
                                                <td> {{ $loop->iteration }}</td>
                                                <td> {{ $operasional->nama_operasional }}</td>
                                                <td> Rp{{ number_format($operasional->harga, 0, ',', '.') }}</td>
                                                <td> {{ number_format($operasional->pivot->estimasi) }}</td>
                                                <td> {{ number_format($operasional->pivot->pemeliharaan_opts * 100, 0, ',', '.') }}%
                                                </td>
                                                <td> Rp{{ number_format($operasional->pivot->biaya_pemeliharaan_opts, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th>Total Operational Component Costs</th>
                            <th>:</th>
                            <td>Rp{{ number_format($operationalFee->total_biaya_operational, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Total Maintenance Cost</th>
                            <th>:</th>
                            <td>Rp{{ number_format($operationalFee->total_biaya_pemeliharaan, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
                <a class="nav-link" href="http://127.0.0.1:8000/operational_fees" align="right">
                    <button type="button" class="btn btn-primary mr-2">Back</button>
                </a>
            </div>
        </div>
    </div>
@endsection
