@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">EDIT REQUEST</h4>
                <form class="forms-sample" method="POST" action="{{ route('permintaans.update', $permintaan->id) }}">
                    <p class="card-description">
                        Edit Request
                    </p>
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="nama_barang"> Product Name <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama_barang" id="nama_barang"
                                        value="{{ $permintaan->nama_barang }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="jenis_barang">Types of Products <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="jenis_barang" id="jenis_barang">
                                        <option value="Investment"
                                            {{ $permintaan->jenis_barang === 'Investment' ? 'selected' : '' }}>Investment
                                        </option>
                                        <option value="Operational"
                                            {{ $permintaan->jenis_barang === 'Operational' ? 'selected' : '' }}>Operational
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="harga">Price <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="harga" id="harga"
                                        value="{{ $permintaan->harga }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="link">Link <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="url" class="form-control" name="link" id="link"
                                        value="{{ $permintaan->link }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="note">Note</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="note" id="note"
                                        value="{{ $permintaan->note }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <p align="center">
                                        <button type="submit" name="edit"
                                            class="btn btn-primary align-self-center">Update</button>
                                        <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
