<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form pembelian tiket bioskop</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    $judul_film = ["Jumanji", "Star Wars", "Your Name"];
    ?> 
    <h2>PEMBELIAN TIKET BIOSKOP</h2>
    <form action="output.php" method="POST">
        <label for="id_pelanggan">ID Pelanggan :</label>
        <input type="text" name="id_pelanggan" required><br>

        <label for="film">Pilih Film :</label>
        <select name="film" id="film">
        <?php
            for ($i = 0; $i < count($judul_film); $i++) {
                echo "<option value='" .(str_replace(' ', '', $judul_film[$i])) . "'>" . $judul_film[$i] . "</option>";
            }
            ?>
        </select><br>

        <label for="jumlah">Jumlah Tiket: </label>
        <input type="number" name="jumlah" min="1" required><br>

        <input type="submit" name="proses">
    </form>
</body>
</html>