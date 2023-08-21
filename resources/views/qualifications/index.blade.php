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
                        <h4 class="card-title">Qualifications</h4>
                        <div class="table-responsive">
                            <a href="/qualifications/create" class="btn btn-primary btn-icon-text">
                                <i class="typcn typcn-input-checked btn-icon-prepend"></i>
                                Add Qualification
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
                                            Service Description
                                        </th>
                                        <th>
                                            Education Level
                                        </th>
                                        <th>
                                            Lavel
                                        </th>
                                        <th>
                                            Salaries
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 0; @endphp
                                    @foreach ($qualifications as $q)
                                        <tr>
                                            <td>{{ ++$no }}</td>
                                            <td>{{ $q->layanan }}</td>
                                            <td>{{ Str::limit($q->deskripsi_layanan, $limit = 30, $end = '...') }}</td>
                                            <td>{{ $q->jenjang_pendidikan }}</td>
                                            <td>{{ $q->salaries->nama_posisi }}</td>
                                            <td>Rp{{ number_format($q->salaries->gaji, 0, ',', '.') }}</td>
                                            <td>
                                                <form action="/qualifications/{{ $q->id }}" method="POST">
                                                    @method('GET')
                                                    <a href="/qualifications/{{ $q->id }}"
                                                        class="btn btn-success btn-icon-text">
                                                        <i class="typcn typcn-clipboard btn-icon-append"></i>
                                                        View</a>
                                                    <a href="/qualifications/{{ $q->id }}/edit"
                                                        class="btn btn-info btn-icon-text">
                                                        <i class="typcn typcn-edit btn-icon-append"></i>Edit</a>
                                                    @can('manage-admins')
                                                        @method('DELETE')
                                                        @csrf
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
