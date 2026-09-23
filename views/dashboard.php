<?php include 'views/layouts/header.php'; ?>
<?php include 'views/layouts/sidebar.php'; ?>

<div class="content mt-4">
    <h2 class="mb-4 fw-bold">Dashboard Analitik</h2>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white shadow-sm mb-3 mb-md-0">
                <div class="card-body">
                    <h6 class="text-white-50 text-uppercase fw-bold mb-1">Total Koleksi Buku</h6>
                    <h2 class="fw-bold mb-0"><?= $totalBuku ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white shadow-sm mb-3 mb-md-0">
                <div class="card-body">
                    <h6 class="text-white-50 text-uppercase fw-bold mb-1">Total Kategori Genre</h6>
                    <h2 class="fw-bold mb-0"><?= $totalGenre ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-dark shadow-sm mb-3 mb-md-0">
                <div class="card-body">
                    <h6 class="text-dark-50 text-uppercase fw-bold mb-1">Total Penulis</h6>
                    <h2 class="fw-bold mb-0"><?= $totalPenulis ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-4 mb-4 mb-md-0">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white fw-bold py-3">
                    Distribusi Genre Buku
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <canvas id="genreChart" style="max-height: 280px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white fw-bold py-3">
                    Jumlah Buku per penerbit
                </div>
                <div class="card-body">
                    <canvas id="penerbitChart" style="max-height: 280px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Konfigurasi Pie Chart (Genre)
    const ctxGenre = document.getElementById('genreChart').getContext('2d');
    new Chart(ctxGenre, {
        type: 'pie',
        data: {
            labels: <?= json_encode(array_keys($genreCount)) ?>,
            datasets: [{
                data: <?= json_encode(array_values($genreCount)) ?>,
                backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#9966ff', '#ff9f40']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                } // Legenda ditaruh di bawah agar rapi
            }
        }
    });

    // Konfigurasi Bar Chart (Penulis)
    const ctxPenerbit = document.getElementById('penerbitChart').getContext('2d');
    new Chart(ctxPenerbit, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_keys($penerbitCount)) ?>,
            datasets: [{
                label: 'Jumlah Buku',
                data: <?= json_encode(array_values($penerbitCount)) ?>,
                backgroundColor: '#36a2eb',
                borderRadius: 5 // Membuat ujung batang grafik sedikit melengkung (modern)
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    } // Karena jumlah buku pasti angka bulat
                }
            }
        }
    });
</script>

</body>

</html>