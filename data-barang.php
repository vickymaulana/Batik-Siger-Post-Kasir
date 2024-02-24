<?php
require_once 'koneksi.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jenisTeknik = $_POST["jenis_teknik"];
    $jenisPewarna = $_POST["jenis_pewarna"];
    $jenisKain = $_POST["jenis_kain"];
    $ukuranKainPanjang = $_POST["ukuran_kain_panjang"];
    $ukuranBajuSatuan = $_POST["ukuran_baju_satuan"];
    $ukuranKainLebar = $_POST["ukuran_kain_lebar"];

    $stmt = $conn->prepare("INSERT INTO databarang (jenis_teknik, jenis_pewarna, jenis_kain, ukuran_kain_panjang, ukuran_baju_satuan, ukuran_kain_lebar)
            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $jenisTeknik, $jenisPewarna, $jenisKain, $ukuranKainPanjang, $ukuranBajuSatuan, $ukuranKainLebar);

    if ($stmt->execute()) {
        // echo "berhasil di input";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
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

        input[type="submit"],
        input[type="reset"] {
            padding: 10px 20px;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"] {
            background-color: #4CAF50;
        }

        input[type="reset"] {
            background-color: #ff0000;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

    </style>
</head>

<body>
    <div class="container mx-auto flex justify-center items-center h-screen">
        <div class="w-full max-w-md">
            <h1 class="text-2xl font-bold mb-4">Data Barang</h1>
            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <div class="mb-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="jenis_teknik">Jenis Teknik</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jenis_teknik" name="jenis_teknik">
                        <option value="Batik Tulis/Cap">Batik Tulis/Cap</option>
                        <option value="Kombinasi Cap Tulis">Kombinasi Cap Tulis</option>
                        <option value="Printing">Printing</option>
                        <option value="Prada Tulis">Prada Tulis</option>
                        <option value="Prada Cap">Prada Cap</option>
                        <option value="Prada Printing">Prada Printing</option>
                        <option value="Baju Pria">Baju Pria</option>
                        <option value="Baju Wanita">Baju Wanita</option>
                        <option value="Tenun">Tenun</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="jenis_pewarna">Jenis Pewarna</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jenis_pewarna" name="jenis_pewarna">
                        <option value="Sintetik">Sintetik</option>
                        <option value="Alami Mahoni">Alami Mahoni</option>
                        <option value="Alami Indigovera">Alami Indigovera</option>
                        <option value="Alami Soga">Alami Soga</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="jenis_kain">Jenis Kain</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jenis_kain" name="jenis_kain">
                        <option value="primisima kupu-kupu">Primisima Kupu-Kupu</option>
                        <option value="primisima gamelan">Primisima Gamelan</option>
                        <option value="kereta kencana">Kereta Kencana</option>
                        <option value="sutra">Sutra</option>
                        <option value="paris">Paris</option>
                        <option value="tenun">Tenun</option>
                        <option value="ajl">AJL</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="ukuran_kain_panjang">Ukuran Kain (Panjang)</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="ukuran_kain_panjang" name="ukuran_kain_panjang">
                        <option value="200">200 cm</option>
                        <option value="225">225 cm</option>
                        <option value="240">240 cm</option>
                        <option value="250">250 cm</option>
                        <option value="300">300 cm</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="ukuran_baju_satuan">Ukuran Baju Satuan</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="ukuran_baju_satuan" name="ukuran_baju_satuan">
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="XXL">XXL</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="ukuran_kain_lebar">Ukuran Kain (Lebar)</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="ukuran_kain_lebar" name="ukuran_kain_lebar">
                        <option value="110">110 cm</option>
                        <option value="115">115 cm</option>
                        <option value="150">150 cm</option>
                    </select>
                </div>
                <div class="flex justify-between">
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="reset">Reset</button>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
