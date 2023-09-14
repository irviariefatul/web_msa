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
                        <h4 class="card-title">Application Prices</h4>
                        <div class="table-responsive">
                            <a href="{{ route('application_prices.create') }}" class="btn btn-primary btn-icon-text">
                                <i class="typcn typcn-input-checked btn-icon-prepend"></i>
                                Add Calculation
                            </a>
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Service Name</th>
                                        <th>Total Application Price</th>
                                        <th>Total Profits</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 0; @endphp
                                    @foreach ($applicationPrices as $ap)
                                        <tr>
                                            <td>{{ ++$no }}</td>
                                            <td>{{ $ap->investFee->layanan }}</td>
                                            <td>Rp{{ number_format($ap->total_harga_aplikasi, 0, ',', '.') }}</td>
                                            <td>Rp{{ number_format($ap->jumlah_keuntungan, 0, ',', '.') }}</td>

                                            <td>
                                                <form action="{{ route('application_prices.destroy', $ap->id) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <a href="{{ route('application_prices.show', $ap->id) }}"
                                                        class="btn btn-success btn-icon-text">
                                                        <i class="typcn typcn-clipboard btn-icon-append"></i>
                                                        View
                                                    </a>
                                                    <a href="{{ route('application_prices.edit', $ap->id) }}"
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
