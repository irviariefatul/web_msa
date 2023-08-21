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
                        <h4 class="card-title">Salary Calculations</h4>
                        <div class="table-responsive">
                            <a href="{{ route('perhitungan_gajis.create') }}" class="btn btn-primary btn-icon-text">
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
                                            Level
                                        </th>
                                        <th>
                                            Salaries
                                        </th>
                                        <th>
                                            Total Allowance
                                        </th>
                                        <th>
                                            Total Salary
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 0; @endphp
                                    @foreach ($perhitungan_gajis as $pg)
                                        <tr>
                                            <td>{{ ++$no }}</td>
                                            <td>{{ $pg->qualifications->layanan }}</td>
                                            <td>{{ $pg->qualifications->salaries->nama_posisi }}</td>
                                            <td>Rp{{ number_format($pg->qualifications->salaries->gaji, 0, ',', '.') }}</td>
                                            <td>Rp{{ number_format($pg->total_allowance, 0, ',', '.') }}</td>
                                            <td>Rp{{ number_format($pg->total_gaji, 0, ',', '.') }}</td>
                                            <td>
                                                <form action="{{ route('perhitungan_gajis.destroy', $pg->id) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <a href="{{ route('perhitungan_gajis.show', $pg->id) }}"
                                                        class="btn btn-success btn-icon-text">
                                                        <i class="typcn typcn-clipboard btn-icon-append"></i>
                                                        View
                                                    </a>
                                                    <a href="{{ route('perhitungan_gajis.edit', $pg->id) }}"
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
