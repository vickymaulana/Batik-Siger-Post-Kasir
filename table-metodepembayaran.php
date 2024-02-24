<?php
require_once 'koneksi.php';

$sql = "SELECT metodepembayaran, SUM(total_harga) AS total FROM formtransaksi GROUP BY metodepembayaran";
$result = mysqli_query($conn, $sql);

$tableRows = '';

$totalSum = 0;

while($row = mysqli_fetch_assoc($result)) {
    $totalSum += $row['total'];
    $tableRows .= "<tr><td class='py-2 px-4 border-b border-gray-300 text-center'>{$row['metodepembayaran']}</td><td class='border p-2'>Rp. " . number_format($row['total'], 0, '.', '.') . "</td></tr>";
}

$tableRows .= "<tr><td class='py-2 px-4 border-b border-gray-300 text-center'><strong>Total</strong></td><td class='border p-2'><strong>Rp. " . number_format($totalSum, 0, '.', '.') . "</strong></td></tr>";

$table = <<<HTML
<table class='min-w-full bg-white border border-gray-300'>
    <tr>
        <th class='py-2 px-4 border-b border-gray-300 bg-gray-100 text-center'>Metode Pembayaran</th>
        <th class='py-2 px-4 border-b border-gray-300 bg-gray-100 text-center'>Total Harga</th>
    </tr>
    $tableRows
</table>
HTML;

echo $table;
?>