<?php
include('koneksi.php');

// Fungsi untuk mendapatkan data mahasiswa dari database
function getMahasiswa($conn, $prodi = null)
{
    $sql = "SELECT * FROM mahasiswa";
    if ($prodi) {
        $sql .= " WHERE prodi = '$prodi'";
    }

    $result = mysqli_query($conn, $sql);

    $mahasiswa = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $mahasiswa[] = $row;
    }

    return $mahasiswa;
}

// Fungsi untuk menambah data mahasiswa
function tambahMahasiswa($conn, $nama, $nim, $prodi)
{
    $sql = "INSERT INTO mahasiswa (nama, nim, prodi) VALUES ('$nama', '$nim', '$prodi')";
    return mysqli_query($conn, $sql);
}

// Fungsi untuk menghapus data mahasiswa
function hapusMahasiswa($conn, $id)
{
    $sql = "DELETE FROM mahasiswa WHERE id = $id";
    return mysqli_query($conn, $sql);
}

// Fungsi untuk mengubah data mahasiswa
function editMahasiswa($conn, $id, $nama, $nim, $prodi)
{
    $sql = "UPDATE mahasiswa SET nama = '$nama', nim = '$nim', prodi = '$prodi' WHERE id = $id";
    return mysqli_query($conn, $sql);
}

// Inisialisasi variabel
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';
$prodi = isset($_GET['prodi']) ? $_GET['prodi'] : '';

// Proses form tambah mahasiswa
if ($aksi == 'tambah' && isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];

    tambahMahasiswa($conn, $nama, $nim, $prodi);
    header("Location: index.php");
}

// Proses form edit mahasiswa
if ($aksi == 'edit' && isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];

    editMahasiswa($conn, $id, $nama, $nim, $prodi);
    header("Location: index.php");
}

// Proses hapus mahasiswa
if ($aksi == 'hapus') {
    $id = $_GET['id'];
    hapusMahasiswa($conn, $id);
    header("Location: index.php");
}

// Mendapatkan data mahasiswa sesuai program studi
$mahasiswa = getMahasiswa($conn, $prodi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Data Mahasiswa</h1>
    <form action="index.php" method="get">
        <label for="prodi">Filter berdasarkan Program Studi</label>
        <select name="prodi" id="prodi" onchange="this.form.submit()">
            <option value="">Semua Program Studi</option>
            <option value="Teknik Informatika" <?php echo ($prodi == 'Teknik Informatika') ? 'selected' : ''; ?>>Teknik
                Informatika</option>
            <option value="Teknik Elektro" <?php echo ($prodi == 'Teknik Elektro') ? 'selected' : ''; ?>>Teknik Elektro
            </option>
            <option value="Matematika" <?php echo ($prodi == 'Matematika') ? 'selected' : ''; ?>>Matematika</option>
            <option value="Teknik Mesin" <?php echo ($prodi == 'Teknik Mesin') ? 'selected' : ''; ?>>Teknik Mesin</option>
        </select>
    </form>

    <table>
        <tr>
            <th>Nama</th>
            <th>NIM</th>
            <th>Program Studi</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($mahasiswa as $mhs): ?>
            <tr>
                <td>
                    <?php echo $mhs['nama']; ?>
                </td>
                <td>
                    <?php echo $mhs['nim']; ?>
                </td>
                <td>
                    <?php echo $mhs['prodi']; ?>
                </td>
                <td>
                    <form action="hapusdata.php" method="get">
                        <input type="hidden" name="del" value="<?php echo $mhs['nim']; ?>">
                        <button type="submit">Hapus</button>
                    </form>
                    <form action="editdata.php" method="get">
                        <input type="hidden" name="edit" value="<?php echo $mhs['nim']; ?>">
                        <button type="submit">Edit</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    </form>
    <form action="tambahdata.php" method="post">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" required>
        <label for="nim">NIM:</label>
        <input type="text" name="nim" required>
        <select name="prodi">
            <option value="">Pilih Program Studi</option>
            <option value="Teknik Informatika" <?php echo ($prodi == 'Teknik Informatika') ? 'selected' : ''; ?>>Teknik
                Informatika</option>
            <option value="Teknik Elektro" <?php echo ($prodi == 'Teknik Elektro') ? 'selected' : ''; ?>>Teknik Elektro
            </option>
            <option value="Matematika" <?php echo ($prodi == 'Matematika') ? 'selected' : ''; ?>>Matematika</option>
            <option value="Teknik Mesin" <?php echo ($prodi == 'Teknik Mesin') ? 'selected' : ''; ?>>Teknik Mesin</option>
            <input type="submit" value="Tambahkan">
    </form>
</body>

</html>