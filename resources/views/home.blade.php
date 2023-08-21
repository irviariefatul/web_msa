@extends('layouts.app3')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @can('manage-admins')
                            <div class="row">
                                <div class="col-lg-3 col-sm-6">
                                    <div class="card gradient-1">
                                        <div class="card-body">
                                            <h3 class="card-title text-white">Users</h3>
                                            <div class="d-inline-block">
                                                <h2 class="text-white">{{ $totalUsers }}</h2>
                                            </div>
                                            <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="card gradient-2">
                                        <div class="card-body">
                                            <h3 class="card-title text-white">Incoming Requests</h3>
                                            <div class="d-inline-block">
                                                <h4 class="text-white"> All : {{ $totalPermintaans }}</h4>
                                                <h4 class="text-white"> Pending : {{ $totalPendingPermintaans }}</h4>
                                            </div>
                                            <span class="float-right display-5 opacity-5"><i class="fa fa-folder"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="card gradient-3">
                                        <div class="card-body">
                                            <h3 class="card-title text-white">Kelahiran</h3>
                                            <div class="d-inline-block">
                                                <h2 class="text-white"></h2>
                                            </div>
                                            <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="card gradient-4">
                                        <div class="card-body">
                                            <h3 class="card-title text-white">Kematian</h3>
                                            <div class="d-inline-block">
                                                <h2 class="text-white"></h2>
                                            </div>
                                            <span class="float-right display-5 opacity-5"><i class="fa fa-star"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
