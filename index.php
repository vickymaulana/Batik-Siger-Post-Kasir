<?php
include 'koneksi.php';

$query = "SELECT * FROM formtransaksi";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Batik Siger </title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>

    <style>
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }

    .table-container {
        overflow-x: auto;
    }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container mx-auto mt-1">
        <h1 class="text-2xl font-bold mb-4">Selamat datang di kasir Batik Siger</h1>
        <h1 class="text-2xl font-bold mb-2">Data Transaksi</h1>

        <div class="mb-2">
            <label for="filter" class="block text-sm font-medium text-gray-700">Filter:</label>
            <select id="filter" onchange="applyFilter(this.value)" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="all">Seluruh Transaksi</option>
                <option value="daily">Harian</option>
                <option value="weekly">Mingguan</option>
            </select>
        </div>
        <div class="table-container">
            <table id="transaksi-table" class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-300 bg-gray-100">Kode Transaksi</th>
                        <th class="py-2 px-4 border-b border-gray-300 bg-gray-100">Tanggal</th>
                        <th class='py-2 px-4 border-b border-gray-300 bg-gray-100'>Nama Pelanggan</th>
                        <th class="py-2 px-4 border-b border-gray-300 bg-gray-100">Nama Barang</th>
                        <th class="py-2 px-4 border-b border-gray-300 bg-gray-100">Kategori</th>
                        <th class="py-2 px-4 border-b border-gray-300 bg-gray-100">Qty</th>
                        <th class="py-2 px-4 border-b border-gray-300 bg-gray-100">Satuan</th>
                        <th class="py-2 px-4 border-b border-gray-300 bg-gray-100">Stock</th>
                        <th class="py-2 px-4 border-b border-gray-300 bg-gray-100">Harga</th>
                        <th class="py-2 px-4 border-b border-gray-300 bg-gray-100">Total Harga</th>
                        <th class="py-2 px-4 border-b border-gray-300 bg-gray-100">Metode Pembayaran</th>
                        <th class="py-2 px-4 border-b border-gray-300 bg-gray-100">Cetak Struck</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-300 text-center"><?= $row['kode_transaksi'] ?></td>
                            <td class="py-2 px-4 border-b border-gray-300 text-center"><?= $row['tanggal'] ?></td>
                            <td class="py-2 px-4 border-b border-gray-300 text-center"><?= $row['namapelanggan'] ?></td>
                            <td class="py-2 px-4 border-b border-gray-300 text-center"><?= $row['nama_produk'] ?></td>
                            <td class="py-2 px-4 border-b border-gray-300 text-center"><?= $row['kategori'] ?></td>
                            <td class="py-2 px-4 border-b border-gray-300 text-center"><?= $row['qty'] ?></td>
                            <td class="py-2 px-4 border-b border-gray-300 text-center"><?= $row['satuan'] ?></td>
                            <td class="py-2 px-4 border-b border-gray-300 text-center"><?= $row['stock'] ?></td>
                            <td class="py-2 px-4 border-b border-gray-300 text-center">Rp. <?= number_format($row['harga'], 0, ',', '.') ?></td>
                            <td class="py-2 px-4 border-b border-gray-300 text-center">Rp. <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                            <td class="py-2 px-4 border-b border-gray-300 text-center"><?= $row['metodepembayaran'] ?></td>
                            <td class="py-2 px-4 border-b border-gray-300 text-center"><a href="http://localhost/batik-siger/cetak-struck.php?kode_transaksi=<?= $row['kode_transaksi'] ?>">Cetak</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="mb-2"></div>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="exportToExcel()">Print ke Excel</button>
        <!-- <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" onclick="printToPDF()">Print ke PDF</button> -->
        <div class="mb-2"></div>

        <script>
            function applyFilter(filter) {
                const table = document.getElementById('transaksi-table');
                const rows = Array.from(table.querySelectorAll('tr'));

                rows.forEach(row => {
                    const cells = Array.from(row.querySelectorAll('td'));
                    if (cells.length > 1) {
                        const tanggal = cells[1].innerText;

                        if (filter === 'daily') {
                            const today = new Date().toISOString().split('T')[0];
                            row.style.display = (tanggal === today) ? 'table-row' : 'none';
                        } else if (filter === 'weekly') {
                            const today = new Date();
                            const lastWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 7).toISOString().split('T')[0];
                            row.style.display = (tanggal >= lastWeek && tanggal <= today.toISOString().split('T')[0]) ? 'table-row' : 'none';
                        } else {
                            row.style.display = 'table-row';
                        }

                        if (row.style.display === 'table-row') {
                            row.classList.add('fade-in');
                        } else {
                            row.classList.remove('fade-in');
                        }
                    }
                });
            }

            function exportToExcel() {
                const table = document.querySelector('table');
                const title = 'Data Transaksi Batik Siger';
                const rows = Array.from(table.querySelectorAll('tr'));

                const data = rows.map(row => {
                    const cells = Array.from(row.querySelectorAll('td'));
                    return cells.map(cell => cell.innerText);
                });

                data.unshift([
                    'Kode Transaksi',
                    'Tanggal',
                    'Nama Pelanggan',
                    'Nama Barang',
                    'Kategori',
                    'Qty',
                    'Satuan',
                    'Stock',
                    'Harga',
                    'Total Harga',
                    'Metode Pembayaran'
                ]);
                data.unshift([]);
                data.unshift([title]);

                const worksheet = XLSX.utils.aoa_to_sheet(data);
                const workbook = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(workbook, worksheet, 'Sheet1');
                XLSX.writeFile(workbook, 'data-transaksi.xlsx');
            }
        </script>

        <?php include 'table-metodepembayaran.php'; ?>
        <?php include 'table-databarang.php'; ?>
        <?php include 'grafik-transaksi.php'; ?>
    </div>
</body>

</html>
