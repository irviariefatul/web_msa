@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between">
                    <h4 class="card-title mb-3">{{ $qualification->layanan }}</h4>
                </div>
                <div class="row">
                    <table class="table table-responsive">
                        <tr>
                            <th>Service Name</th>
                            <th>:</th>
                            <td>{{ $qualification->layanan }}</td>
                        </tr>
                        <tr>
                            <th>Service Description</th>
                            <th>:</th>
                            <td>{{ $qualification->deskripsi_layanan }}</td>
                        </tr>
                        <tr>
                            <th>Education Level</th>
                            <th>:</th>
                            <td>{{ $qualification->jenjang_pendidikan }}</td>
                        </tr>
                        <tr>
                            <th>Level</th>
                            <th>:</th>
                            <td>{{ $qualification->salaries->nama_posisi }}</td>
                        </tr>
                        <tr>
                            <th>Salary</th>
                            <th>:</th>
                            <td>Rp{{ number_format($qualification->salaries->gaji, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Create At</th>
                            <th>:</th>
                            <td>{{ $qualification->created_at }}</td>
                        </tr>
                    </table>
                </div>
                <a class="nav-link" href="http://127.0.0.1:8000/qualifications" align="right">
                    <button type="button" class="btn btn-primary mr-2">Back</button>
                </a>
            </div>
        </div>
    </div>
@endsection
