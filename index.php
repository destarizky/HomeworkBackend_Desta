<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Tiket Bioskop</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
       <div class="order-container">
        <h1 class="order-title">Pemesanan Tiket Bioskop</h1>
        <form action="" method="POST" class="order-form">
            <label for="jenisTiket">Jenis Tiket:</label>
            <select name="jenisTiket" id="jenisTiket" required>
                <option value="dewasa">Dewasa - Rp50.000</option>
                <option value="anak-anak">Anak-anak - Rp30.000</option>
            </select>

            <label for="jumlahTiket">Jumlah Tiket:</label>
            <input type="number" name="jumlahTiket" id="jumlahTiket" min="1" required>

            <label for="hariPemesanan">Hari Pemesanan:</label>
            <select name="hariPemesanan" id="hariPemesanan" required>
                <option value="senin">Senin</option>
                <option value="selasa">Selasa</option>
                <option value="rabu">Rabu</option>
                <option value="kamis">Kamis</option>
                <option value="jumat">Jumat</option>
                <option value="sabtu">Sabtu</option>
                <option value="minggu">Minggu</option>
            </select>

            <button type="submit">Hitung Total Harga</button>
        </form>
        
        <?php
            function hitungHargaTiket($jenisTiket, $jumlahTiket, $hariPemesanan) {
                $hargaDewasa = 50000;
                $hargaAnak = 30000;
                $tambahanAkhirPekan = 10000;
                $diskonThreshold = 150000;
                $diskonPersentase = 0.10;

                if ($jenisTiket == "dewasa") {
                    $hargaPerTiket = $hargaDewasa;
                } elseif ($jenisTiket == "anak-anak") {
                    $hargaPerTiket = $hargaAnak;
                } else {
                    return "Jenis tiket tidak valid.";
                }

                if (strtolower($hariPemesanan) == "sabtu" || strtolower($hariPemesanan) == "minggu") {
                    $hargaPerTiket += $tambahanAkhirPekan;
                }

                $totalHarga = $hargaPerTiket * $jumlahTiket;

                if ($totalHarga > $diskonThreshold) {
                    $totalHarga -= $totalHarga * $diskonPersentase;
                }

                return $totalHarga;
            }

            // Menampilkan hasil perhitungan jika form disubmit
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $jenisTiket = $_POST['jenisTiket'];
                $jumlahTiket = $_POST['jumlahTiket'];
                $hariPemesanan = $_POST['hariPemesanan'];

                $totalHarga = hitungHargaTiket($jenisTiket, $jumlahTiket, $hariPemesanan);

                echo "<p class='result'>Total harga tiket adalah: Rp" . number_format($totalHarga, 0, ',', '.') . "</p>";
            }
        ?>
    </div>
</body>
</html>
