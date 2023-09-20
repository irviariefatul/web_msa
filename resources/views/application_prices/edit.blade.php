@extends('layouts.app3')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">EDIT APPLICATION PRICE</h4>
                <form class="forms-sample" method="POST"
                    action="{{ route('application_prices.update', $applicationPrice->id) }}">
                    @csrf
                    @method('PUT') <!-- Gunakan metode PUT untuk pembaruan -->

                    <p class="card-description">
                        Edit Application Price
                    </p>

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
                                                <option value="{{ $sf->id }}"
                                                    @if ($applicationPrice->service_fee_id == $sf->id) selected @endif>
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
                                    <option value="{{ $if->id }}" @if ($applicationPrice->invest_fee_id === $if->id) selected @endif>
                                        {{ $if->layanan }} ||
                                        Rp{{ number_format($if->total_biaya_invest, 0, ',', '.') }} ||
                                        Rp{{ number_format($if->total_biaya_pemeliharaan, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="operationalFee">Operational Component Cost<span class="text-danger">*</span></label>
                            <select class="form-control select2" name="OperationalFee" required="required"
                                id="OperationalFee">
                                <option value="">Select Options</option>
                                @foreach ($operationalFees as $of)
                                    <option value="{{ $of->id }}" @if ($applicationPrice->operational_fee_id === $of->id) selected @endif>
                                        {{ $of->layanan }} ||
                                        Rp{{ number_format($of->total_biaya_operational, 0, ',', '.') }} ||
                                        Rp{{ number_format($of->total_biaya_pemeliharaan, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="estimasi_bulan">Year Estimation<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="estimasi_bulan" id="estimasi_bulan"
                                    value="{{ intval($applicationPrice->estimasi_bulan / 12) }}"
                                    placeholder="Year Estimation" required step="1">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="estimasi_user">User Estimation<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="estimasi_user" id="estimasi_user"
                                    value="{{ intval($applicationPrice->estimasi_user) }}" placeholder="User Estimation"
                                    required step="1">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="persentase_biaya_admin">Fee Management<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="persentase_biaya_admin"
                                    id="persentase_biaya_admin"
                                    value="{{ intval($applicationPrice->persentase_biaya_admin * 100) }}"
                                    placeholder="Fee Management" required step="1">
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary align-self-center">Update</button>
                    <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
