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
                        @can('manage-Users')
                            <h4 class="card-title">Requests</h4>
                        @endcan
                        @can('manage-admins')
                            <h4 class="card-title">Incoming Requests</h4>
                        @endcan
                        <div class="table-responsive">
                            <a href="/permintaans/create" class="btn btn-primary btn-icon-text">
                                <i class="typcn typcn-input-checked btn-icon-prepend"></i>
                                Add Requests
                            </a>
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Product Name
                                        </th>
                                        <th>
                                            Price
                                        </th>
                                        <th>
                                            Reference (Link)
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        @can('manage-admins')
                                            <th>
                                                Approval
                                            </th>
                                        @endcan
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 0; @endphp
                                    @foreach ($permintaan as $p)
                                        <tr>
                                            <td>{{ ++$no }}</td>
                                            <td>{{ $p->nama_barang }}</td>
                                            <td>Rp{{ number_format($p->harga, 0, ',', '.') }}</td>
                                            <td><a href="{{ $p->link }}" target="_blank">{{ $p->link }}</a></td>
                                            <td>{{ $p->status }}</td>
                                            @can('manage-admins')
                                                <td>
                                                    <form action="{{ route('permintaans.updateStatus', $p->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="status" value="Approved">
                                                        <button type="submit" class="btn btn-success btn-rounded btn-icon">
                                                            <i class="typcn typcn-tick-outline btn-icon-prepend"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('permintaans.updateStatus', $p->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="status" value="Rejected">
                                                        <button type="submit" class="btn btn-danger btn-rounded btn-icon">
                                                            <i class="typcn typcn-cancel-outline btn-icon-append"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            @endcan
                                            <td>
                                                <form action="/permintaans/{{ $p->id }}" method="POST">
                                                    @method('GET')
                                                    <a href="/permintaans/{{ $p->id }}"
                                                        class="btn btn-success btn-icon-text">
                                                        <i class="typcn typcn-clipboard btn-icon-append"></i>
                                                        View</a>
                                                    <a href="/permintaans/{{ $p->id }}/edit"
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
