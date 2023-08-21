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
                        <h4 class="card-title">Salaries</h4>
                        <div class="table-responsive">
                            <a href="/salaries/create" class="btn btn-primary btn-icon-text">
                                <i class="typcn typcn-input-checked btn-icon-prepend"></i>
                                Add Salary
                            </a>
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Lavel
                                        </th>
                                        <th>
                                            Competencies
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
                                    @foreach ($salary as $s)
                                        <tr>
                                            <td>{{ ++$no }}</td>
                                            <td>{{ $s->nama_posisi }}</td>
                                            <td>{{ Str::limit($s->kompetensi, $limit = 30, $end = '...') }}</td>
                                            <td>Rp{{ number_format($s->gaji, 0, ',', '.') }}</td>
                                            <td>
                                                <form action="/salaries/{{ $s->id }}" method="POST">
                                                    @method('GET')
                                                    <a href="/salaries/{{ $s->id }}"
                                                        class="btn btn-success btn-icon-text">
                                                        <i class="typcn typcn-clipboard btn-icon-append"></i>
                                                        View</a>
                                                    <a href="/salaries/{{ $s->id }}/edit"
                                                        class="btn btn-info btn-icon-text">
                                                        <i class="typcn typcn-edit btn-icon-append"></i>Edit</a>
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" name="delete"
                                                        class="btn btn-dark btn-icon-text">
                                                        <i class="typcn typcn-delete btn-icon-prepend"></i>Delete
                                                    </button>
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
