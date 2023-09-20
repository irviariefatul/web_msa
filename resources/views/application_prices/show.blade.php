@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between">
                    <h3 class="card-title mb-4">Applicatioan Price Details</h3>
                </div>
                <div class="row">
                    <table class="table table-responsive">
                        <tr>
                            <th>Service Name</th>
                            <th>:</th>
                            <td>{{ $applicationPrices->serviceFee->perhitunganGajis->first()->qualifications->layanan }}
                            </td>
                        </tr>
                    </table>
                    <table class="table table-responsive">
                        <tr>
                            <th>
                                <h4> Human Resources Cost</h4>
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
                                        @foreach ($applicationPrices->serviceFee->perhitunganGajis as $perhitunganGaji)
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
                            <td>Rp{{ number_format($applicationPrices->serviceFee->total_biaya_sdm, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                    <table class="table table-responsive">
                        <tr>
                            <th>
                                <h4> Investment Component Cost</h4>
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
                                        @foreach ($applicationPrices->investFee->investments as $investment)
                                            <tr>
                                                <td> {{ $loop->iteration }}</td>
                                                <td> {{ $investment->nama_invest }}</td>
                                                <td> Rp{{ number_format($investment->harga, 0, ',', '.') }}</td>
                                                <td> {{ number_format($investment->pivot->estimasi) }}</td>
                                                <td> {{ number_format($investment->pivot->pemeliharaan_ivts * 100, 0, ',', '.') }}%
                                                </td>
                                                <td> Rp{{ number_format($investment->pivot->biaya_pemeliharaan_ivts, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th>Total Investment Component Cost</th>
                            <th>:</th>
                            <td>Rp{{ number_format($applicationPrices->investFee->total_biaya_invest, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Total Maintenance Cost</th>
                            <th>:</th>
                            <td>Rp{{ number_format($applicationPrices->investFee->total_biaya_pemeliharaan, 0, ',', '.') }}
                            </td>
                        </tr>
                    </table>
                    <table class="table table-responsive">
                        <tr>
                            <th>
                                <h4> Operational Component Cost</h4>
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
                                        @foreach ($applicationPrices->operationalFee->operasionals as $operasional)
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
                            <th>Total Operational Component Cost</th>
                            <th>:</th>
                            <td>Rp{{ number_format($applicationPrices->operationalFee->total_biaya_operational, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Total Maintenance Cost</th>
                            <th>:</th>
                            <td>Rp{{ number_format($applicationPrices->operationalFee->total_biaya_pemeliharaan, 0, ',', '.') }}
                            </td>
                        </tr>
                    </table>
                    <table class="table table-responsive">
                        <tr>
                            <th>
                                <h4>
                                    Calculating Application Price
                                </h4>
                            </th>
                        </tr>
                    </table>
                    <table class="table table-responsive">
                        <tr>
                            <th>Year Estimation</th>
                            <th>:</th>
                            <td>{{ number_format($applicationPrices->estimasi_bulan / 12, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <th>User Estimation</th>
                            <th>:</th>
                            <td>{{ number_format($applicationPrices->estimasi_user, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <th> Monthly Fee</th>
                            <th>:</th>
                            <td>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Human Resources Cost</th>
                                            <th>Investment Component Cost</th>
                                            <th>Operational Component Cost</th>
                                            <th>Maintenance Cost</th>
                                            <th>Total Cost Requirement</th>
                                            <th>Total Income</th>
                                            <th>Total Profit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Rp{{ number_format($applicationPrices->serviceFee->total_biaya_sdm, 0, ',', '.') }}
                                            </td>
                                            <td> Rp{{ number_format($applicationPrices->investFee->total_biaya_invest / $applicationPrices->estimasi_bulan, 0, ',', '.') }}
                                            </td>
                                            <td> Rp{{ number_format($applicationPrices->operationalFee->total_biaya_operational, 0, ',', '.') }}
                                            </td>
                                            <td> Rp{{ number_format($applicationPrices->total_biaya_pemeliharaan, 0, ',', '.') }}
                                            </td>
                                            <td> Rp{{ number_format($applicationPrices->total_biaya_kebutuhan, 0, ',', '.') }}
                                            </td>
                                            <td> Rp{{ number_format($applicationPrices->jumlah_pemasukan, 0, ',', '.') }}
                                            </td>
                                            <td> Rp{{ number_format($applicationPrices->jumlah_keuntungan, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Application Price
                            </th>
                            <th>:</th>
                            <td>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>App Price per user</th>
                                            <th>Fee Management (%)</th>
                                            <th>Fee Management (Rp)</th>
                                            <th>Management Fee In 1 Year</th>
                                            <th>Total App Price per user</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Rp{{ number_format($applicationPrices->harga_aplikasi, 0, ',', '.') }}
                                            </td>
                                            <td>{{ number_format($applicationPrices->persentase_biaya_admin * 100, 0, ',', '.') }}%
                                            </td>
                                            <td>Rp{{ number_format($applicationPrices->biaya_admin, 0, ',', '.') }}
                                            </td>
                                            <td>Rp{{ number_format($applicationPrices->biaya_admin * 12, 0, ',', '.') }}
                                            </td>
                                            <td>Rp{{ number_format($applicationPrices->total_harga_aplikasi, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <tr>
                        <td>
                            Notes: The price of this application is a fixed monthly price where users only get the
                            features
                            that are in the
                            {{ $applicationPrices->serviceFee->perhitunganGajis->first()->qualifications->layanan }}
                            application without any additional features for the next
                            {{ number_format($applicationPrices->estimasi_bulan / 12, 0, ',', '.') }} years.
                        </td>
                    </tr>
                </div>
                <a class="nav-link" href="http://127.0.0.1:8000/application_prices" align="right">
                    <button type="button" class="btn btn-primary mr-2">Back</button>
                </a>
            </div>
        </div>
    </div>
@endsection
