@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">ADD APPLICATION PRICE</h4>
                <form class="forms-sample" method="POST" action="{{ route('application_prices.store') }}">
                    <p class="card-description">
                        Add Application Price
                    </p>
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="serviceFee">Human Resource Cost<span class="text-danger">*</span></label>
                            <select class="form-control select2" name="ServiceFee" required="required" id="ServiceFee">
                                <option value="">Select Options</option>
                                @foreach ($serviceFees as $sf)
                                    @if (auth()->user()->can('manage-admins') || $sf->user_id === auth()->user()->id)
                                        @php $perhitunganGajiShown = false; @endphp
                                        @foreach ($sf->perhitunganGajis as $perhitunganGaji)
                                            @if (!$perhitunganGajiShown && $perhitunganGaji->pivot->service_fee_id === $sf->id)
                                                <option value="{{ $sf->id }}">
                                                    {{ $perhitunganGaji->qualifications->layanan }} ||
                                                    Rp{{ number_format($sf->total_biaya_sdm, 0, ',', '.') }}
                                                </option>
                                                @php $perhitunganGajiShown = true; @endphp
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="investFee">Investment Component Cost<span class="text-danger">*</span></label>
                            <select class="form-control select2" name="InvestFee" required="required" id="InvestFee">
                                <option value="">Select Options</option>
                                @foreach ($investFees as $if)
                                    @if (auth()->user()->can('manage-admins') || $if->user_id === auth()->user()->id)
                                        <option value="{{ $if->id }}">
                                            {{ $if->layanan }} ||
                                            Rp{{ number_format($if->total_biaya_invest, 0, ',', '.') }} ||
                                            Rp{{ number_format($if->total_biaya_pemeliharaan, 0, ',', '.') }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="OperationalFee">Operational Component Cost<span class="text-danger">*</span></label>
                            <select class="form-control select2" name="OperationalFee" required="required"
                                id="OperationalFee">
                                <option value="">Select Options</option>
                                @foreach ($operationalFees as $of)
                                    @if (auth()->user()->can('manage-admins') || $of->user_id === auth()->user()->id)
                                        <option value="{{ $of->id }}">
                                            {{ $of->layanan }} ||
                                            Rp{{ number_format($of->total_biaya_operational, 0, ',', '.') }} ||
                                            Rp{{ number_format($of->total_biaya_pemeliharaan, 0, ',', '.') }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="estimasi_bulan">Year Estimation<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="estimasi_bulan" id="estimasi_bulan"
                                    placeholder="Year Estimation" required step="1">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="estimasi_user">User Estimation<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="estimasi_user" id="estimasi_user"
                                    placeholder="User Estimation" required step="1">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="persentase_biaya_admin">Fee Management<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="persentase_biaya_admin"
                                    id="persentase_biaya_admin" placeholder="Fee Management" required step="1">
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="add" class="btn btn-primary align-self-center">Submit</button>
                    <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
