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
                                            <h3 class="card-title text-white">Salary Calculations</h3>
                                            <div class="d-inline-block">
                                                <h2 class="text-white">{{ $totalSalaryCalculations }}</h2>
                                            </div>
                                            <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="card gradient-4">
                                        <div class="card-body">
                                            <h3 class="card-title text-white">Application Prices</h3>
                                            <div class="d-inline-block">
                                                <h2 class="text-white">{{ $totalApplicationPrices }}</h2>
                                            </div>
                                            <span class="float-right display-5 opacity-5"><i class="fa fa-star"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="card-body">
                                        <h3>Application Prices Top 10</h3>
                                    </div>
                                    <div class="chart-container">
                                        <canvas id="barChart"></canvas>
                                    </div>
                                </div>

                                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var ctx = document.getElementById('barChart').getContext('2d');

                                        var data = @json($data);
                                        var labels = @json($labels); // Menggunakan variabel labels yang sudah ada

                                        var totalHarga = data.map(function(item) {
                                            return item.total_harga_aplikasi;
                                        });

                                        var jumlahKeuntungan = data.map(function(item) {
                                            return item.jumlah_keuntungan;
                                        });

                                        // Mengonversi totalHarga menjadi format Rp
                                        var formattedTotalHarga = totalHarga.map(function(value) {
                                            return 'Rp ' + value.toLocaleString('id-ID');
                                        });

                                        // Mengonversi jumlahKeuntungan menjadi format Rp
                                        var formattedJumlahKeuntungan = jumlahKeuntungan.map(function(value) {
                                            return 'Rp ' + value.toLocaleString('id-ID');
                                        });

                                        var chart = new Chart(ctx, {
                                            type: 'bar',
                                            data: {
                                                labels: labels,
                                                datasets: [{
                                                    label: 'Total Application Price',
                                                    data: totalHarga,
                                                    backgroundColor: 'rgba(0, 0, 128, 0.2)',
                                                    borderColor: 'rgba(0, 0, 128, 1)',
                                                    borderWidth: 1,
                                                }, {
                                                    label: 'Total Profit',
                                                    data: jumlahKeuntungan,
                                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                                    borderColor: 'rgba(255, 99, 132, 1)',
                                                    borderWidth: 1,
                                                }]
                                            },
                                            options: {
                                                scales: {
                                                    yAxes: [{
                                                        ticks: {
                                                            beginAtZero: true,
                                                            callback: function(value, index, values) {
                                                                // Format angka ke dalam format mata uang Rupiah
                                                                return 'Rp ' + value.toLocaleString('id-ID');
                                                            }
                                                        }
                                                    }]
                                                },
                                                tooltips: {
                                                    enabled: true,
                                                    mode: 'label',
                                                    callbacks: {
                                                        label: function(tooltipItem, data) {
                                                            var label = data.datasets[tooltipItem.datasetIndex].label || '';
                                                            if (label) {
                                                                label += ': ';
                                                            }
                                                            label += 'Rp ' + tooltipItem.yLabel.toLocaleString('id-ID');
                                                            return label;
                                                        }
                                                    }
                                                },
                                                plugins: {
                                                    datalabels: {
                                                        anchor: 'end',
                                                        align: 'end',
                                                        formatter: function(value, context) {
                                                            // Mengatur formatter untuk menampilkan data dengan format Rp
                                                            return 'Rp ' + value.toLocaleString('id-ID');
                                                        }
                                                    }
                                                }
                                            }
                                        });
                                    });
                                </script>
                            </div>
                        @endcan
                        @can('manage-users')
                            <div class="container">
                                <div class="card-body">
                                    <h3>Application Prices Top 10</h3>
                                </div>
                                <div class="chart-container">
                                    <canvas id="barChart"></canvas>
                                </div>
                            </div>

                            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var ctx = document.getElementById('barChart').getContext('2d');

                                    var data = @json($data);
                                    var labels = @json($labels); // Menggunakan variabel labels yang sudah ada

                                    var totalHarga = data.map(function(item) {
                                        return item.total_harga_aplikasi;
                                    });

                                    var jumlahKeuntungan = data.map(function(item) {
                                        return item.jumlah_keuntungan;
                                    });

                                    // Mengonversi totalHarga menjadi format Rp
                                    var formattedTotalHarga = totalHarga.map(function(value) {
                                        return 'Rp ' + value.toLocaleString('id-ID');
                                    });

                                    // Mengonversi jumlahKeuntungan menjadi format Rp
                                    var formattedJumlahKeuntungan = jumlahKeuntungan.map(function(value) {
                                        return 'Rp ' + value.toLocaleString('id-ID');
                                    });

                                    var chart = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: labels,
                                            datasets: [{
                                                label: 'Total Application Price',
                                                data: totalHarga,
                                                backgroundColor: 'rgba(0, 0, 128, 0.2)',
                                                borderColor: 'rgba(0, 0, 128, 1)',
                                                borderWidth: 1,
                                            }, {
                                                label: 'Total Profit',
                                                data: jumlahKeuntungan,
                                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                                borderColor: 'rgba(255, 99, 132, 1)',
                                                borderWidth: 1,
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                yAxes: [{
                                                    ticks: {
                                                        beginAtZero: true,
                                                        callback: function(value, index, values) {
                                                            // Format angka ke dalam format mata uang Rupiah
                                                            return 'Rp ' + value.toLocaleString('id-ID');
                                                        }
                                                    }
                                                }]
                                            },
                                            tooltips: {
                                                enabled: true,
                                                mode: 'label',
                                                callbacks: {
                                                    label: function(tooltipItem, data) {
                                                        var label = data.datasets[tooltipItem.datasetIndex].label || '';
                                                        if (label) {
                                                            label += ': ';
                                                        }
                                                        label += 'Rp ' + tooltipItem.yLabel.toLocaleString('id-ID');
                                                        return label;
                                                    }
                                                }
                                            },
                                            plugins: {
                                                datalabels: {
                                                    anchor: 'end',
                                                    align: 'end',
                                                    formatter: function(value, context) {
                                                        // Mengatur formatter untuk menampilkan data dengan format Rp
                                                        return 'Rp ' + value.toLocaleString('id-ID');
                                                    }
                                                }
                                            }
                                        }
                                    });
                                });
                            </script>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
