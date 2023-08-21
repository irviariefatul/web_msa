@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">ADD REQUEST</h4>
                <form class="forms-sample" method="POST" action="{{ route('permintaans.store') }}">
                    <p class="card-description">
                        Add Request
                    </p>
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="nama_barang"> Product Name <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama_barang" id="nama_barang"
                                        placeholder="Product Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="jenis_barang">Types of Products <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="jenis_barang" id="jenis_barang" required="required">
                                        <option value="">Please Select</option>
                                        <option value="Investment">Investment</option>
                                        <option value="Operational">Operational</option>
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
                                        placeholder="Price" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="link">Link <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="url" class="form-control" name="link" id="link"
                                        placeholder="Link" required>
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
                                        placeholder="Note">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <p align="center">
                                        <button type="submit" name="add"
                                            class="btn btn-primary align-self-center">Submit</button>
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
