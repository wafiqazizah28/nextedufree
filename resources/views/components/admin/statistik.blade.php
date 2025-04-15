{{-- File: resources/views/components/admin/statistics.blade.php --}}

@extends('pages.adminDashboard')

@section('content')
<div class="row">
    <!-- Total User Login Bulan Ini -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Login ({{ $bulanSekarang }})</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalLoginBulanIni }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Statistik Login Bulan Ini -->
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Statistik Login User ({{ $bulanSekarang }})</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="userLoginChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Hasil Tes Jurusan -->
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Distribusi Hasil Tes Jurusan</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="hasilTesChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    @php
                    $chartColors = [
                        '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', 
                        '#5a5c69', '#6610f2', '#fd7e14', '#20c9a6', '#858796'
                    ];
                    @endphp
                    
                    @foreach($jurusanLabels as $index => $jurusan)
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: {{ $chartColors[$index % count($chartColors)] }}"></i> {{ $jurusan }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Tabel Data Login Bulan Ini -->
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Login ({{ $bulanSekarang }})</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jumlah Login</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(array_combine($loginDates, $loginCounts) as $date => $count)
                            <tr>
                                <td>{{ $date }}</td>
                                <td>{{ $count }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Hasil Tes Jurusan -->
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Hasil Tes Jurusan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Jurusan</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(array_combine($jurusanLabels, $jurusanCounts) as $jurusan => $count)
                            <tr>
                                <td>{{ $jurusan }}</td>
                                <td>{{ $count }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistik Bulanan -->
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Statistik User Berdasarkan Bulan ({{ date('Y') }})</h6>
            </div>
            <div class="card-body">
                <div class="chart-bar">
                    <canvas id="userByMonthChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<!-- Make sure Chart.js is included before this script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

{{-- In your Blade template file --}}

{{-- First, add these data variables in a format JavaScript can access --}}
<script>
    // Make PHP variables available to JavaScript
    var chartData = {
        loginDates: {!! json_encode($loginDates ?? []) !!},
        loginCounts: {!! json_encode($loginCounts ?? []) !!},
        jurusanLabels: {!! json_encode($jurusanLabels ?? []) !!},
        jurusanCounts: {!! json_encode($jurusanCounts ?? []) !!},
        months: {!! json_encode($months ?? []) !!},
        monthlyCounts: {!! json_encode($monthlyCounts ?? []) !!}
    };
</script>

{{-- Then add Chart.js library --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

{{-- Then add your chart initialization script --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Check if Chart.js is available
    if (typeof Chart === 'undefined') {
        console.error('Chart.js not loaded!');
        return;
    }
    
    // Check if data variables exist
    if (typeof chartData === 'undefined') {
        console.error('Chart data not available!');
        return;
    }
    
    console.log('Chart data available:', chartData);
    
    // Array warna untuk chart
    var chartColors = [
        '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', 
        '#5a5c69', '#6610f2', '#fd7e14', '#20c9a6', '#858796'
    ];

    // Check if elements exist before initializing charts
    var loginCtx = document.getElementById("userLoginChart");
    if (loginCtx) {
        console.log('Creating login chart');
        var userLoginChart = new Chart(loginCtx, {
            type: 'line',
            data: {
                labels: chartData.loginDates,
                datasets: [{
                    label: "Login",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: chartData.loginCounts,
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                return value;
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            return "Jumlah Login: " + tooltipItem.yLabel;
                        }
                    }
                }
            }
        });
    } else {
        console.error('Login chart canvas not found');
    }

    // Grafik untuk hasil tes jurusan (pie chart)
    var hasilTesCtx = document.getElementById("hasilTesChart");
    if (hasilTesCtx) {
        console.log('Creating test results chart');
        var hasilTesChart = new Chart(hasilTesCtx, {
            type: 'doughnut',
            data: {
                labels: chartData.jurusanLabels,
                datasets: [{
                    data: chartData.jurusanCounts,
                    backgroundColor: chartColors.slice(0, chartData.jurusanLabels.length),
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#dda20a', '#cc382f'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
    } else {
        console.error('Test results chart canvas not found');
    }

    // Grafik untuk statistik berdasarkan bulan
    var monthCtx = document.getElementById("userByMonthChart");
    if (monthCtx) {
        console.log('Creating monthly chart');
        var userByMonthChart = new Chart(monthCtx, {
            type: 'bar',
            data: {
                labels: chartData.months,
                datasets: [{
                    label: "Jumlah User",
                    backgroundColor: "#4e73df",
                    hoverBackgroundColor: "#2e59d9",
                    borderColor: "#4e73df",
                    data: chartData.monthlyCounts,
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 12
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            maxTicksLimit: 5,
                            padding: 10,
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                return value;
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            return "Jumlah User: " + tooltipItem.yLabel;
                        }
                    }
                },
            }
        });
    } else {
        console.error('Monthly chart canvas not found');
    }
});
</script>
@endsection