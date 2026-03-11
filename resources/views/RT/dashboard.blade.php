@extends('rt.layout.main')
@section('title', 'Dashboard')
@section('konten')
<link href="https://cdn.materialdesignicons.com/6.5.95/css/materialdesignicons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body, h1, h2, h3, h4, h5, h6, p, .card, .btn, .text-muted {
        font-family: 'Poppins', sans-serif !important;
    }
</style>

<div class="container-scroller">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Selamat Datang Kepala RT {{ $rt }} RW {{ $rw }}</h3>

                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex">
        <!-- PIE CHART -->
        <div class="col-md-4 d-flex">
            <div class="card w-100" style="padding: 10px;">
                <div class="card-body">
                    <h5 class="card-title">Statistik Penduduk</h5>
                    <p class="card-description">Pria dan Wanita</p>
                    <canvas id="genderChart" style="height:200px;"></canvas>
                    <div class="mt-3">
                        <span class="badge bg-primary">Pria</span>
                        <span class="badge bg-danger">Wanita</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 6 CARD -->
        <div class="col-md-8 d-flex flex-wrap">
            @php
                $cards = [
                    ['icon' => 'mdi-account-group', 'value' => $jumlahPenduduk, 'label' => 'Jumlah Penduduk'],
                    ['icon' => 'mdi-card-account-details', 'value' => $jumlahKK, 'label' => 'Jumlah KK'],
                    ['icon' => 'mdi-gender-female', 'value' => $jumlahWanita, 'label' => 'Penduduk Wanita', 'color' => '#e91e63'],
                    ['icon' => 'mdi-gender-male', 'value' => $jumlahLaki, 'label' => 'Penduduk Pria', 'color' => '#2196f3'],
                    ['icon' => 'mdi-email-send-outline', 'value' => $jumlahSuratMasuk, 'label' => 'Total Pengajuan Surat', 'color' => '#00c292'],
                    ['icon' => 'mdi-close-circle-outline', 'value' => $jumlahSuratDitolak, 'label' => 'Surat Ditolak', 'color' => '#e74c3c']
                ];
            @endphp

            @foreach($cards as $card)
            <div class="col-md-6 mb-3 d-flex align-items-stretch">
                <div class="card w-100 text-center p-3">
                    <div class="mb-2">
                        <i class="mdi {{ $card['icon'] }}" style="font-size: 24px; color: {{ $card['color'] ?? '#4b49ac' }};"></i>
                    </div>
                    <h4 class="fw-bold mb-0">{{ $card['value'] }}</h4>
                    <small class="text-muted">{{ $card['label'] }}</small>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Library Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Script Chart Gender -->
<script>
    const ctx = document.getElementById('genderChart').getContext('2d');
    const genderChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Pria', 'Wanita'],
            datasets: [{
                data: [{{ $jumlahLaki }}, {{ $jumlahWanita }}],
                backgroundColor: ['#36A2EB', '#FF6384'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endsection