@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between">
                    <h4 class="card-title mb-3">{{ $perhitunganGaji->qualifications->layanan }}</h4>
                </div>
                <div class="row">
                    <table class="table table-responsive">
                        <tr>
                            <th>Service Name</th>
                            <th>:</th>
                            <td>{{ $perhitunganGaji->qualifications->layanan }}</td>
                        </tr>
                        <tr>
                            <th>Level</th>
                            <th>:</th>
                            <td>{{ $perhitunganGaji->qualifications->salaries->nama_posisi }}</td>
                        </tr>
                        <tr>
                            <th>Salary</th>
                            <th>:</th>
                            <td>Rp{{ number_format($perhitunganGaji->qualifications->salaries->gaji, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Allowance</th>
                            <th>:</th>
                            <td>
                                @foreach ($perhitunganGaji->allowances as $allowance)
                                    <li>
                                        {{ $loop->iteration }}. {{ $allowance->nama_tunjangan }} -
                                        Rp{{ number_format($allowance->harga, 0, ',', '.') }}
                                    </li>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Total Allowance</th>
                            <th>:</th>
                            <td>Rp{{ number_format($perhitunganGaji->total_allowance, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Total Salary</th>
                            <th>:</th>
                            <td>Rp{{ number_format($perhitunganGaji->total_gaji, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <th>:</th>
                            <td>{{ $perhitunganGaji->created_at }}</td>
                        </tr>
                    </table>
                </div>
                <a class="nav-link" href="http://127.0.0.1:8000/perhitungan_gajis" align="right">
                    <button type="button" class="btn btn-primary mr-2">Back</button>
                </a>
            </div>
        </div>
    </div>
@endsection
