<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="stylesOutput.css">
</head>
<body>
    <?php
    $id_pelanggan = strtoupper($_POST['id_pelanggan']);
    $film = $_POST['film'];
    $jumlah_beli = $_POST['jumlah'];

    $status_pelanggan = [
        "MBV" => ["Status" => "Member VIP","diskon" => 0.2],
        "MBR" => ["Status" => "Member Reguler","diskon" => 0.1],
        "MBN" => ["Status" => "Non Member","diskon" => 0]
    ];

    $pelanggan = diskon($id_pelanggan, $status_pelanggan);
    $status = $pelanggan["Status"];
    $diskon_persen = $pelanggan["diskon"];
    $harga = harga();

    function diskon($id,$status_pelanggan){
        if (isset($id,$status_pelanggan)) {
            return $status_pelanggan[$id];
        }
        return $status_pelanggan["NON"];
    }

    function harga(){
        $hari = date("N");;
        if ($hari >=1 && $hari <=4){
            return 25000;
        }
        else {
            return 30000;
        }
    }

    function hitung_total($harga,$jumlah_beli,$diskon_persen){
        $total_harga = $harga * $jumlah_beli;
        $diskon = $total_harga * $diskon_persen;
        $total_bayar = $total_harga - $diskon;
        return [$total_harga, $diskon, $total_bayar];
    }

    list($total_harga, $diskon, $total_bayar) = hitung_total($harga, $jumlah_beli, $diskon_persen);

    $ppn = 0.11;
    $total_ppn = $total_bayar * $ppn;
    $total_bayarPPN = $total_bayar + $total_ppn;

    $struk = [
        "ID Pelanggan" => $id_pelanggan,
        "Status" => $status,
        "Film" => $film,
        "Harga per Tiket" => "Rp. " . number_format($harga, 0, ',', '.'),
        "Jumlah Beli" => $jumlah_beli,
        "Total Harga" => "Rp." . number_format($total_harga, 0, ',', '.'),
        "Diskon" => "Rp." . number_format($diskon, 0, ',', '.'),
        "PPN 11%" => "Rp." . number_format($total_ppn, 0, ',', '.'),
        "Total Bayar" => "Rp." . number_format($total_bayarPPN, 0, ',', '.')
    ];

    ?>

    <h2>Struk Pembelian Tiket Bioskop Almahrya</h2>
    <p>Bioskop Almahrya</p>
    <p>Jl. Silangga 127A, Kel. Sepanjang Jaya, Kota Bekasi</p>
    <hr>

    <div class="struk">
    <?php
    foreach ($struk as $key => $value) {
        echo "<p>$key: $value</p>";
    }
    ?>
    </div>
    <center>
            <a href="input.php" class="button"><<< INPUT LAGI</a>
    </center>
    

    <hr>
    <p>Terima Kasih</p>
</body>
</html>