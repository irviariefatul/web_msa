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
                        <h4 class="card-title">Investment Components</h4>
                        <div class="table-responsive">
                            <a href="/investments/create" class="btn btn-primary btn-icon-text">
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
                                            Investment Name
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
                                    @foreach ($investments as $i)
                                        <tr>
                                            <td>{{ ++$no }}</td>
                                            <td>{{ $i->nama_invest }}</td>
                                            <td>{{ Str::limit($i->deskripsi, $limit = 30, $end = '...') }}</td>
                                            <td>Rp{{ number_format($i->harga, 0, ',', '.') }}</td>
                                            <td>
                                                <form action="/investments/{{ $i->id }}" method="POST">
                                                    @method('GET')
                                                    <a href="/investments/{{ $i->id }}"
                                                        class="btn btn-success btn-icon-text">
                                                        <i class="typcn typcn-clipboard btn-icon-append"></i>
                                                        View</a>
                                                    <a href="/investments/{{ $i->id }}/edit"
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
