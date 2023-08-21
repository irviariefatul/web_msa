@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between">
                    <h4 class="card-title mb-3">{{ $salary->nama_posisi }}</h4>
                </div>
                <div class="row">
                    <table class="table table-responsive">
                        <tr>
                            <th>Lavel</th>
                            <th>:</th>
                            <td>{{ $salary->nama_posisi }}</td>
                        </tr>
                        <tr>
                            <th>Competencies</th>
                            <th>:</th>
                            <td>{{ $salary->kompetensi }}</td>
                        </tr>
                        <tr>
                            <th>Salary</th>
                            <th>:</th>
                            <td>Rp{{ number_format($salary->gaji, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Create At</th>
                            <th>:</th>
                            <td>{{ $salary->created_at }}</td>
                        </tr>
                    </table>
                </div>
                <a class="nav-link" href="http://127.0.0.1:8000/salaries" align="right">
                    <button type="button" class="btn btn-primary mr-2">Back</button>
                </a>
            </div>
        </div>
    </div>
@endsection
