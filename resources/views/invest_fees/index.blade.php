@extends('layouts.app3')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h4 class="card-title">Investment Component Costs</h4>
                        <div class="table-responsive">
                            <a href="{{ route('invest_fees.create') }}" class="btn btn-primary btn-icon-text">
                                <i class="typcn typcn-input-checked btn-icon-prepend"></i>
                                Add Calculation
                            </a>
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Service Name
                                        </th>
                                        <th>
                                            Total Investment Costs
                                        </th>
                                        <th>
                                            Total Maintenance Costs
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 0; @endphp
                                    @foreach ($invest_fees as $if)
                                        @php
                                            $invesmentShown = false; // Variabel untuk melacak apakah data perhitunganGaji telah ditampilkan
                                        @endphp

                                        @foreach ($if->investments as $invesment)
                                            @if (!$invesmentShown)
                                                <tr>
                                                    <td>{{ ++$no }}</td>
                                                    <td>{{ $if->layanan }}</td>
                                                    <td>Rp{{ number_format($if->total_biaya_invest, 0, ',', '.') }}</td>
                                                    <td>Rp{{ number_format($if->total_biaya_pemeliharaan, 0, ',', '.') }}
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('invest_fees.destroy', $if->id) }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <a href="{{ route('invest_fees.show', $if->id) }}"
                                                                class="btn btn-success btn-icon-text">
                                                                <i class="typcn typcn-clipboard btn-icon-append"></i>
                                                                View
                                                            </a>
                                                            <a href="{{ route('invest_fees.edit', $if->id) }}"
                                                                class="btn btn-info btn-icon-text">
                                                                <i class="typcn typcn-edit btn-icon-append"></i>Edit
                                                            </a>
                                                            @can('manage-admins')
                                                                <button type="submit" name="delete"
                                                                    class="btn btn-dark btn-icon-text">
                                                                    <i class="typcn typcn-delete btn-icon-prepend"></i>Delete
                                                                </button>
                                                            @endcan
                                                        </form>
                                                    </td>
                                                </tr>
                                                @php
                                                    $invesmentShown = true; // Tandai bahwa data perhitunganGaji sudah ditampilkan
                                                @endphp
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
