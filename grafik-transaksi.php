<?php
include 'koneksi.php';

$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

$sql = "SELECT DATE_FORMAT(tanggal, '%Y-%m-%d') AS tanggal, SUM(qty) AS total_jumlah FROM formtransaksi";

if ($filter == 'weekly') {
    $sql .= " WHERE tanggal >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
} elseif ($filter == 'daily') {
    $sql .= " WHERE tanggal = CURDATE()";
}

$sql .= " GROUP BY tanggal";

$result = mysqli_query($conn, $sql);

$dates = [];
$totals = [];
while ($row = mysqli_fetch_assoc($result)) {
    $dates[] = $row['tanggal'];
    $totals[] = $row['total_jumlah'];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body>
    <div class="container mx-auto border p-4">
        <h1 class="text-2xl font-bold mb-4">Grafik Transaksi</h1>
        <div class="mb-4">
            <a href="?filter=all" class="mr-2 <?= $filter == 'all' ? 'font-bold' : ''; ?>">Seluruh Transaksi</a>
            <a href="?filter=weekly" class="mr-2 <?= $filter == 'weekly' ? 'font-bold' : ''; ?>">Mingguan</a>
            <a href="?filter=daily" class="<?= $filter == 'daily' ? 'font-bold' : ''; ?>">Harian</a>
        </div>
        <div id="chart"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
            chart: {
                type: 'bar',
                height: 350
            },
            series: [{
                name: 'Total Jumlah',
                data: <?= json_encode($totals); ?>
            }],
            xaxis: {
                categories: <?= json_encode($dates); ?>
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
</body>

</html>
