<?php
require_once 'includes/header.php';
require_once 'php_action/core.php';

function getDB($connect, $query)
{
    $db = mysqli_query($connect, $query);
    return mysqli_fetch_assoc($db);
}

$jMenu = getDB($connect, 'SELECT COUNT(id_menu) as jumlahmenu FROM menu');
$jTransaksi = getDB($connect, 'SELECT COUNT(id_transaksi) as jumlahtransaksi FROM transaksi');
$jUser = getDB($connect, 'SELECT COUNT(id_user) as jumlahuser FROM user');
$tahun = getDB($connect, "SELECT SUM(transaksi.qty*menu.harga) AS total FROM menu JOIN transaksi ON transaksi.id_menu=menu.id_menu");
$menuTerjual = getDB($connect, 'SELECT SUM(qty) AS menuTerjual FROM transaksi');

// Ambil data untuk chart (label dan data)
$chartData = mysqli_query($connect, "
    SELECT m.nama_menu, SUM(t.qty) AS sold 
    FROM transaksi t 
    JOIN menu m ON t.id_menu = m.id_menu 
    GROUP BY t.id_menu
");

$labels = [];
$data = [];
while ($row = mysqli_fetch_assoc($chartData)) {
    $labels[] = '"' . $row['nama_menu'] . '"';
    $data[] = $row['sold'];
}
?>

<main role="main">
    <div class="container-fluid">
        <h4 class="mb-3 text-dark">Dashboard</h4>
        <div class="row">
            <!-- Kartu Jumlah Menu -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                            <div class="col-auto" style="margin-right: 60px;">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Menu</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= htmlspecialchars($jMenu['jumlahmenu']); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kartu Jumlah Transaksi -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2"><i class="fas fa-chart-bar fa-2x text-gray-300"></i></div>
                            <div class="col-auto mr-4">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Transaksi</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= htmlspecialchars($jTransaksi['jumlahtransaksi']); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kartu Total Transaksi -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2"><i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i></div>
                            <div class="col-auto" style="margin-right: 50px;">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Transaksi</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= htmlspecialchars($tahun['total']); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kartu Jumlah User (Admin) -->
            <?php if ($_SESSION['level'] == 1) : ?>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2"><i class="fas fa-users fa-2x text-gray-300"></i></div>
                                <div class="col-auto mr-4">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Pengguna</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= htmlspecialchars($jUser['jumlahuser']); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Kartu Menu Terjual (Kasir/Manajer) -->
            <?php if ($_SESSION['level'] == 2 || $_SESSION['level'] == 3) : ?>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2"><i class="fas fa-shopping-bag fa-2x text-gray-300"></i></div>
                                <div class="col-auto mr-4">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Total Menu Terjual</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= htmlspecialchars($menuTerjual['menuTerjual']); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Grafik -->
        <div class="row">
            <div class="col-12 col-lg-8 mb-3">
                <div class="d-block rounded shadow bg-white p-3">
                    <canvas id="myChartOne"></canvas>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="d-block rounded shadow bg-white p-3">
                    <canvas id="doughnut" style="margin-bottom: 28px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>

<!-- Chart JS -->
<script>
    const ctx = document.getElementById('myChartOne').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?= implode(',', $labels); ?>],
            datasets: [{
                label: 'Terjual',
                data: [<?= implode(',', $data); ?>],
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
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

    const ctx1 = document.getElementById('doughnut').getContext('2d');
    const myChart1 = new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: [
                'Jumlah Menu', 'Jumlah Transaksi', 'Total Menu Terjual'
            ],
            datasets: [{
                label: 'Data',
                data: [
                    <?= htmlspecialchars($jMenu['jumlahmenu']); ?>,
                    <?= htmlspecialchars($jTransaksi['jumlahtransaksi']); ?>,
                    <?= htmlspecialchars($menuTerjual['menuTerjual']); ?>
                ],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(75, 192, 192)'
                ],
                hoverOffset: 4
            }]
        }
    });
</script>
