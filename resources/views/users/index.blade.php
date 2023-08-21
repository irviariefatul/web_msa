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
                        <h4 class="card-title">Users</h4>
                        <div class="table-responsive">
                            <a href="/users/create" class="btn btn-primary btn-icon-text">
                                <i class="typcn typcn-input-checked btn-icon-prepend"></i>
                                Add User
                            </a>
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Username
                                        </th>
                                        <th>
                                            Role
                                        </th>
                                        <th>
                                            Created At
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 0; @endphp
                                    @foreach ($user as $s)
                                        <tr>
                                            <td>{{ ++$no }}</td>
                                            <td>{{ $s->name }}</td>
                                            <td>{{ $s->email }}</td>
                                            <td>{{ $s->username }}</td>
                                            <td>{{ $s->role }}</td>
                                            <td>{{ $s->created_at }}</td>
                                            <td>
                                                <form action="/users/{{ $s->id }}" method="POST">
                                                    <a href="/users/{{ $s->id }}/edit"
                                                        class="btn btn-info btn-icon-text">
                                                        <i class="typcn typcn-edit btn-icon-append"></i>Edit</a>
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" name="delete"
                                                        class="btn btn-dark btn-icon-text">
                                                        <i class="typcn typcn-delete btn-icon-prepend"></i>
                                                        Delete</button>
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
