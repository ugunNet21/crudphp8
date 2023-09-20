<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "crud_example");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mengambil data pengguna berdasarkan ID
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $koneksi->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nama = $row['nama'];
        $email = $row['email'];
        $usia = $row['usia'];
    } else {
        echo "Data tidak ditemukan.";
    }
}

// Memproses form update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $usia = $_POST['usia'];

    // Update data pengguna
    $sql = "UPDATE users SET nama='$nama', email='$email', usia=$usia WHERE id=$id";
    $result = $koneksi->query($sql);

    if ($result) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

// Tutup koneksi
$koneksi->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Pengguna</title>
</head>
<body>
    <h2>Edit Data Pengguna</h2>
    <form method="post" action="edit.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        Nama: <input type="text" name="nama" value="<?php echo $nama; ?>"><br>
        Email: <input type="text" name="email" value="<?php echo $email; ?>"><br>
        Usia: <input type="text" name="usia" value="<?php echo $usia; ?>"><br>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>
