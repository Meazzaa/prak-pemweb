<?php
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari formulir
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];

    // Query untuk melakukan update data mahasiswa
    $update_query = "UPDATE mahasiswa SET nama = '$nama', prodi = '$prodi' WHERE nim = '$nim'";
    $result = mysqli_query($conn, $update_query);

    if ($result) {
        // Redirect ke halaman utama
        echo '<script>alert("Data berhasil dirubah.");</script>';
        echo '<script>window.location.href = "index.php";</script>';
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    // Jika bukan metode POST, redirect ke halaman utama
    header("Location: index.php");
    exit();
}
?>