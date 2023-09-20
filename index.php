<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "crud_example");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// CREATE (Tambah data)
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $usia = $_POST['usia'];

    $sql = "INSERT INTO users (nama, email, usia) VALUES ('$nama', '$email', $usia)";
    $result = $koneksi->query($sql);

    if ($result) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Data berhasil ditambahkan.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Error: ' . $sql . '<br>' . $koneksi->error . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    }
}

// READ (Mengambil data)
$sql = "SELECT * FROM users";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Data Pengguna:</h2>";
    echo '<table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Usia</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>';

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nama"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["usia"] . "</td>";
        echo '<td>
                <a href="edit.php?id=' . $row["id"] . '" class="btn btn-primary">Edit</a>
                <a href="delete.php?id=' . $row["id"] . '" class="btn btn-danger">Hapus</a>
              </td>';
        echo "</tr>";
    }

    echo '</tbody></table>';
} else {
    echo "Tidak ada data.";
}

// Tutup koneksi
$koneksi->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Aplikasi CRUD dengan Bootstrap</title>
    <!-- Tambahkan pustaka CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Data Pengguna</h2>
        <form method="post" action="index.php">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="usia">Usia:</label>
                <input type="text" class="form-control" id="usia" name="usia">
            </div>
            <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
        </form>
    </div>

    <!-- Tambahkan pustaka JavaScript Bootstrap dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
