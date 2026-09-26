<?php
$conn = mysqli_connect("localhost", "root", "255150707111052", "crud_mahasiswa");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// INSERT
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $fakultas = $_POST['fakultas'];
    $program_studi = $_POST['program_studi'];

    mysqli_query($conn, "INSERT INTO mahasiswa 
        (nama, nim, fakultas, program_studi)
        VALUES ('$nama', '$nim', '$fakultas', '$program_studi')");

    header("Location: CRUD.php");
    exit;
}

// UPDATE
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $fakultas = $_POST['fakultas'];
    $program_studi = $_POST['program_studi'];

    mysqli_query($conn, "UPDATE mahasiswa SET
        nama='$nama',
        nim='$nim',
        fakultas='$fakultas',
        program_studi='$program_studi'
        WHERE id=$id");

    header("Location: index.php");
    exit;
}

// DELETE
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id=$id");

    header("Location: index.php");
    exit;
}

// DATA UNTUK EDIT
$edit = null;

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $hasil = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id=$id");
    $edit = mysqli_fetch_assoc($hasil);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
</head>
<body>

<h2>Data Mahasiswa</h2>

<?php if ($edit) { ?>

<h3>Edit Data Mahasiswa</h3>

<form method="POST">
    <input type="hidden" name="id" value="<?= $edit['id'] ?>">

    Nama:
    <input type="text" name="nama" value="<?= $edit['nama'] ?>" required>
    <br><br>

    NIM:
    <input type="text" name="nim" value="<?= $edit['nim'] ?>" required>
    <br><br>

    Fakultas:
    <input type="text" name="fakultas" value="<?= $edit['fakultas'] ?>" required>
    <br><br>

    Program Studi:
    <input type="text" name="program_studi"
           value="<?= $edit['program_studi'] ?>" required>
    <br><br>

    <button type="submit" name="update">Update</button>
    <a href="index.php">Batal</a>
</form>

<?php } else { ?>

<h3>Tambah Data Mahasiswa</h3>

<form method="POST">
    Nama:
    <input type="text" name="nama" required>
    <br><br>

    NIM:
    <input type="text" name="nim" required>
    <br><br>

    Fakultas:
    <input type="text" name="fakultas" required>
    <br><br>

    Program Studi:
    <input type="text" name="program_studi" required>
    <br><br>

    <button type="submit" name="tambah">Tambah</button>
</form>

<?php } ?>

<br>

<h3>Daftar Mahasiswa</h3>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIM</th>
        <th>Fakultas</th>
        <th>Program Studi</th>
        <th>Aksi</th>
    </tr>

<?php
$data = mysqli_query($conn, "SELECT * FROM mahasiswa");
$no = 1;

while ($row = mysqli_fetch_assoc($data)) {
?>

    <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['nim'] ?></td>
        <td><?= $row['fakultas'] ?></td>
        <td><?= $row['program_studi'] ?></td>
        <td>
            <a href="CRUD.php?edit=<?= $row['id'] ?>">Edit</a> |
            <a href="CRUD.php?hapus=<?= $row['id'] ?>"
               onclick="return confirm('Yakin ingin menghapus data ini?')">
               Hapus
            </a>
        </td>
    </tr>

<?php } ?>

</table>

</body>
</html>
