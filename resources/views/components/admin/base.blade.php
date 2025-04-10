@extends('pages.adminDashboard')

@section('content')
 
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-lg font-semibold mb-4">Distribusi Pengguna per Sekolah</h2>
        @if(isset($schoolData) && count($schoolData) > 0)
        <canvas id="schoolChart" width="400" height="300"></canvas>
        @else
        <p class="text-gray-500 text-center py-10">Tidak ada data sekolah yang tersedia</p>
        @endif
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-lg font-semibold mb-4">Pendaftaran Bulanan</h2>
        @if(isset($monthlyRegistrations) && count($monthlyRegistrations) > 0)
        <canvas id="registrationChart" width="400" height="300"></canvas>
        @else
        <p class="text-gray-500 text-center py-10">Tidak ada data pendaftaran bulanan yang tersedia</p>
        @endif
    </div>
</div>

<div class="bg-white p-6 rounded-lg shadow mb-6">
    <h2 class="text-lg font-semibold mb-4">Daftar Pengguna Terbaru</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Nama</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Sekolah</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Email</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">No. HP</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Tanggal Daftar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentUsers ?? [] as $user)
                <tr>
                    <td class="py-2 px-4 border-b border-gray-200">{{ $user->nama }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">{{ $user->sekolah ?? 'Tidak ada' }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">{{ $user->email }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">{{ $user->nomer_hp ?? 'Tidak ada' }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">{{ $user->created_at ? $user->created_at->format('d/m/Y') : 'Tidak ada' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-4 px-4 border-b border-gray-200 text-center text-gray-500">Tidak ada data pengguna</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chart untuk distribusi sekolah
    @if(isset($schoolData) && count($schoolData) > 0)
    const schoolCtx = document.getElementById('schoolChart');
    if (schoolCtx) {
        const schoolChart = new Chart(schoolCtx.getContext('2d'), {
            type: 'pie',
            data: {
                labels: {!! json_encode($schoolData->pluck('sekolah')) !!},
                datasets: [{
                    data: {!! json_encode($schoolData->pluck('count')) !!},
                    backgroundColor: [
                        '#4C51BF', '#48BB78', '#ECC94B', '#ED8936', '#F56565',
                        '#667EEA', '#38B2AC', '#D69E2E', '#DD6B20', '#E53E3E',
                        '#9F7AEA', '#4FD1C5', '#F6E05E', '#F6AD55', '#FC8181'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    }
                }
            }
        });
    }
    @endif

    // Chart untuk pendaftaran bulanan
    @if(isset($monthlyRegistrations) && count($monthlyRegistrations) > 0)
    const registrationCtx = document.getElementById('registrationChart');
    if (registrationCtx) {
        const registrationChart = new Chart(registrationCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($monthlyRegistrations->pluck('month')) !!},
                datasets: [{
                    label: 'Pendaftaran Pengguna',
                    data: {!! json_encode($monthlyRegistrations->pluck('count')) !!},
                    backgroundColor: '#4C51BF'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    }
    @endif
});
</script>
@endpush
@endsection