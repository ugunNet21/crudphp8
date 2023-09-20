<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "crud_example");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data pengguna berdasarkan ID
    $sql = "DELETE FROM users WHERE id = $id";
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
