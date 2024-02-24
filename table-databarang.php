<?php
require_once 'koneksi.php';

$query = "SELECT * FROM databarang";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <title>Data Barang</title>
</head>

<body>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Data Barang</h1>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Jenis Teknik</th>
                    <th class="py-2 px-4 border-b">Jenis Pewarna</th>
                    <th class="py-2 px-4 border-b">Jenis Kain</th>
                    <th class="py-2 px-4 border-b">Ukuran Kain Panjang</th>
                    <th class="py-2 px-4 border-b">Ukuran Baju Satuan</th>
                    <th class="py-2 px-4 border-b">Ukuran Kain Lebar</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td class="py-2 px-4 border-b"><?= $row['jenis_teknik']; ?></td>
                        <td class="py-2 px-4 border-b"><?= $row['jenis_pewarna']; ?></td>
                        <td class="py-2 px-4 border-b"><?= $row['jenis_kain']; ?></td>
                        <td class="py-2 px-4 border-b"><?= $row['ukuran_kain_panjang']; ?></td>
                        <td class="py-2 px-4 border-b"><?= $row['ukuran_baju_satuan']; ?></td>
                        <td class="py-2 px-4 border-b"><?= $row['ukuran_kain_lebar']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
