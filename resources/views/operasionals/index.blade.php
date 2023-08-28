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
                        <h4 class="card-title">Operational Components</h4>
                        <div class="table-responsive">
                            <a href="/operasionals/create" class="btn btn-primary btn-icon-text">
                                <i class="typcn typcn-input-checked btn-icon-prepend"></i>
                                Add Components
                            </a>
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Operationals Name
                                        </th>
                                        <th>
                                            Description
                                        </th>
                                        <th>
                                            Price
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 0; @endphp
                                    @foreach ($operasionals as $o)
                                        <tr>
                                            <td>{{ ++$no }}</td>
                                            <td>{{ $o->nama_operasional }}</td>
                                            <td>{{ Str::limit($o->deskripsi, $limit = 30, $end = '...') }}</td>
                                            <td>Rp{{ number_format($o->harga, 0, ',', '.') }}</td>
                                            <td>
                                                <form action="/operasionals/{{ $o->id }}" method="POST">
                                                    @method('GET')
                                                    <a href="/operasionals/{{ $o->id }}"
                                                        class="btn btn-success btn-icon-text">
                                                        <i class="typcn typcn-clipboard btn-icon-append"></i>
                                                        View</a>
                                                    <a href="/operasionals/{{ $o->id }}/edit"
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
