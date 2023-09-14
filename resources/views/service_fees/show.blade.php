@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between">
                    <h4 class="card-title mb-3">Human Resource Cost Details</h4>
                </div>
                <div class="row">
                    <table class="table table-responsive">
                        <tr>
                            <th>Service Name</th>
                            <th>:</th>
                            <td>{{ $serviceFee->perhitunganGajis[0]->qualifications->layanan }}</td>
                        </tr>
                        <tr>
                            <th>Salary</th>
                            <th>:</th>
                            <td>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Position</th>
                                            <th>Allowances</th>
                                            <th>Salary</th>
                                            <th>Total Salary</th>
                                            <th>Needs Estimation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($serviceFee->perhitunganGajis as $perhitunganGaji)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $perhitunganGaji->qualifications->salaries->nama_posisi }}</td>
                                                <td>
                                                    <ul>
                                                        @foreach ($perhitunganGaji->allowances as $allowance)
                                                            <li>
                                                                {{ $allowance->nama_tunjangan }} -
                                                                Rp{{ number_format($allowance->harga, 0, ',', '.') }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>Rp{{ number_format($perhitunganGaji->qualifications->salaries->gaji, 0, ',', '.') }}
                                                </td>
                                                <td>Rp{{ number_format($perhitunganGaji->total_gaji, 0, ',', '.') }}</td>
                                                <td>{{ number_format($perhitunganGaji->pivot->estimasi) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th>Total HR Cost</th>
                            <th>:</th>
                            <td>Rp{{ number_format($serviceFee->total_biaya_sdm, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
                <a class="nav-link" href="http://127.0.0.1:8000/service_fees" align="right">
                    <button type="button" class="btn btn-primary mr-2">Back</button>
                </a>
            </div>
        </div>
    </div>
@endsection
