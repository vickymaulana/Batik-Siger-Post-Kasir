<?php

require_once 'koneksi.php';

$kodeTransaksi = generateKodeTransaksi();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = $_POST["tanggal"];
    $namaPelanggan = $_POST["namapelanggan"];
    $namaProduk = $_POST["nama_produk"];
    $kategori = $_POST["kategori"];
    $qty = $_POST["qty"];
    $satuan = $_POST["satuan"];
    $stock = $_POST["stock"];
    $metodepembayaran = $_POST["metodepembayaran"];
    $harga = $_POST["harga"];

    $totalHarga = hitungTotalHarga($qty, $harga);

    $dataBarang = [$kodeTransaksi, $tanggal, $namaPelanggan, $namaProduk, $kategori, $qty, $satuan, $stock, $metodepembayaran, $harga, $totalHarga];
    simpanDataBarang($dataBarang);
}

function hitungTotalHarga($qty, $harga)
{
    return $qty * $harga;
}

function simpanDataBarang($data)
{
    global $conn;

    $sql = "INSERT INTO formtransaksi (kode_transaksi, tanggal, namapelanggan, nama_produk, kategori, qty, satuan, stock, metodepembayaran, harga, total_harga) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssisissd", $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10]);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data barang berhasil disimpan.',
            });
        </script>";
    } else {
        $error = mysqli_error($conn);
        if (strpos($error, "Duplicate entry") !== false) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal menyimpan data barang: Kode transaksi sudah ada.',
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal menyimpan data barang: " . $error . "',
                });
            </script>";
        }
    }

    mysqli_stmt_close($stmt);
}

function generateKodeTransaksi()
{
    global $conn;

    $sql = "SELECT kode_transaksi FROM formtransaksi ORDER BY kode_transaksi DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $latestKodeTransaksi = $row['kode_transaksi'] ?? '';

    $numericPart = intval(substr($latestKodeTransaksi, 3));

    $newNumericPart = $numericPart + 1;
    $newKodeTransaksi = 'BS-' . $newNumericPart;

    return $newKodeTransaksi;
}

?>
<style>
        form {
            display: flex;
            flex-direction: column;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="reset"] {
            padding: 10px 20px;
            background-color: #ff0000;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

</style>

<?php include 'navbar.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <div style="display: flex; gap: 10px;">
        <div style="flex: 1;">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="kode_transaksi">Kode Transaksi:</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="kode_transaksi" id="kode_transaksi" value="<?php echo $kodeTransaksi; ?>" required>
        </div>
        <div style="flex: 1;">
            <label for="tanggal">Tanggal:</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="date" name="tanggal" id="tanggal" required>
        </div>
    </div>
    <div style="display: flex; gap: 10px;">
        <div style="flex: 1;">
            <label for="namapelanggan">Nama Pelanggan:</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="namapelanggan" id="namapelanggan" required>
        </div>
    </div>

    <div style="display: flex; gap: 10px;">
        <div style="flex: 1;">
            <label for="nama_produk">Nama Produk:</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="nama_produk" id="nama_produk" required>
        </div>
        <div style="flex: 1;">
            <label for="kategori" class="block font-bold mb-2">Kategori:</label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="kategori" id="kategori" required class="border border-gray-300 rounded px-2 py-2">
                <option value="jenisteknik">Jenis Teknik</option>
                <option value="jenispewarna">Jenis Pewarna</option>
                <option value="jeniskain">Jenis Kain</option>
            </select>
        </div>
    </div>

    <div style="display: flex; gap: 10px;">
        <div style="flex: 1;">
            <label for="qty">Qty:</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" name="qty" id="qty" required>
        </div>
        <div style="flex: 1;">
            <div class="mb-4">
                <label for="satuan" class="block font-bold mb-2">Satuan:</label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="satuan" id="satuan" required class="border border-gray-300 rounded px-2 py-2">
                    <option value="pcs">pcs</option>
                    <option value="meter">meter</option>
                </select>
            </div>
        </div>
        <div style="flex: 4;">
            <label for="stock">Stock:</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" name="stock" id="stock" required>
        </div>
    </div>

    <div style="display: flex; gap: 10px;">
        <div style="flex: 1;">
            <label for="metodepembayaran">Metode Pembayaran:</label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="metodepembayaran" id="metodepembayaran" required>
                <option value="CASH">CASH</option>
                <option value="MANDIRI">MANDIRI</option>
                <option value="BCA">BCA</option>
                <option value="BRI">BRI</option>
                <option value="BANK LAMPUNG">BANK LAMPUNG</option>
                <option value="EDC MANDIRI">EDC MANDIRI</option>
                <option value="EDC BCA">EDC BCA</option>
                <option value="EDC BRI">EDC BRI</option>
            </select>
        </div>
        <div style="flex: 1;">
            <label for="harga">Harga:</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" name="harga" id="harga" required>
        </div>
    </div>

    <div style="display: flex; justify-content: space-between;">
        <input class='bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline' type="reset" value="Reset">
        <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" value="Simpan">
    </div>
</form>
