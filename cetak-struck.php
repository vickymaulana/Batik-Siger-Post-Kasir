<?php
require_once('pdf/tcpdf.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Vicky');
$pdf->SetTitle('Batik Siger Struk');

$pdf->SetHeaderData($_SERVER['DOCUMENT_ROOT'] . 'batiksiger.jpg', 30, 'Batik Siger Struk', 'Batik Siger Lampung');

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->AddPage();

include 'koneksi.php';
$kode_transaksi = $_GET['kode_transaksi'] ?? '';
$query = "SELECT * FROM formtransaksi WHERE kode_transaksi = '$kode_transaksi'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$html = '
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            color: #333;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #f2f2f2;
        }
        
        hr {
            border: none;
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }
        
        p {
            margin-bottom: 20px;
        }
    </style>
    
    <div class="container">
        <h1 class="text-3xl font-bold mb-6">Batik Siger Struk</h1>
        <hr>
        <table>
            <tr>
                <th class="py-2">Kode Transaksi</th>
                <td class="py-2">'.$kode_transaksi.'</td>
            </tr>
            <tr>
                <th class="py-2">Tanggal</th>
                <td class="py-2">'.$row['tanggal'].'</td>
            </tr>
            <tr>
                <th class="py-2">Nama Pelanggan</th>
                <td class="py-2">'.$row['namapelanggan'].'</td>
            </tr>
            <tr>
                <th class="py-2">Nama Produk</th>
                <td class="py-2">'.$row['nama_produk'].'</td>
            </tr>
            <tr>
                <th class="py-2">Kategori</th>
                <td class="py-2">'.$row['kategori'].'</td>
            </tr>
            <tr>
                <th class="py-2">Qty</th>
                <td class="py-2">'.$row['qty'].'</td>
            </tr>
            <tr>
                <th class="py-2">Satuan</th>
                <td class="py-2">'.$row['satuan'].'</td>
            </tr>
            <tr>
                <th class="py-2">Stock</th>
                <td class="py-2">'.$row['stock'].'</td>
            </tr>
            <tr>
                <th class="py-2">Metode Pembayaran</th>
                <td class="py-2">'.$row['metodepembayaran'].'</td>
            </tr>
            <tr>
                <th class="py-2">Harga</th>
                <td class="py-2">Rp. '.number_format($row['harga'], 0, ',', '.').'</td>
            </tr>
        </table>
        <hr>
        <p class="text-center">Terima kasih atas pembelian Anda!</p>
    </div>
';

$pdf->writeHTML($html, true, false, true, false, '');

$pdf->lastPage();

$pdf->Output('bs-struck.pdf', 'I');
?>
