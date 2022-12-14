<?php
require("allcontroller.php");
if (isset($_POST['submit'])) {
    $dupe = 0;
    $nama = $_POST['nama'];
    foreach (indexKar() as $index => $karyawan) {
        if ($nama == $karyawan->nama) {
            $dupe++;
        }
    }
    if ($dupe == 0) {
        insertKar();
    } else {
        echo '<script>alert("Karyawan bernama ' . $nama . ' telah terdaftar")</script>';
    }
}
if (isset($_GET['delete'])) {
    deleteKar($_GET['delete']);
    $nama = $_GET['nama'];
    foreach (indexRelasi() as $index => $relasi) {
        if ($nama == $relasi->rnama) {
            deleteRelasi($index);
        }
    }
    header("Location: view.php");
}
if(isset($_POST['submitedit'])){
    $id = $_POST['idKar'];
    editKar($id);
    $nama = $_POST['namalama'];
    editRelasiKar($nama);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="view.php">Karyawan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewoffice.php">Kantor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewrelasi.php">Karyawan-Kantor</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <h1 class="text-center">
        Karyawan
    </h1>
   
    <table class="table table-dark mt-2 w-50 mx-auto">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Usia</th>
                <th scope="col" class="text-center">Delete</th>
                <th scope="col" class="text-center">Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach (indexKar() as $index => $karyawan) {
                echo "
                <tr>
                    <td>" . $index . "</td>
                    <td>" . $karyawan->nama . "</td>
                    <td>" . $karyawan->jabatan . "</td>
                    <td>" . $karyawan->usia . "</td>
                    <td class='text-center'><a href='view.php?delete=" . $index . "&nama=" . $karyawan->nama . "'><button class='btn btn-primary'>Delete</button></a></td>
                    <td class='text-center'><a href='view.php?edit=" . $index . "&nama=" . $karyawan->nama . "'><button class='btn btn-primary'>Edit</button></a></td>
                </tr>
                ";
            }
            ?>
        </tbody>
    </table>
    <h1 class="text-center mt-2">
    <?= (isset($_GET['edit'])) ? 'Edit':'List' ?>
         Karyawan
    </h1>
    <?php
    if (isset($_GET['edit'])) {
    ?>
        <div class="d-flex justify-content-center"><a href="view.php" class="btn btn-danger" tabindex="-1" role="button">CANCEL</a>
        </div>
    <?php
    }
    ?>
    <?php
    if (!isset($_GET['edit'])) {
    ?>
        <form method="POST" action="view.php">
            <div class="text-center">
                <div class="form-group text-start w-50 d-inline-block">
                    <label for="formGroupExampleInput" class="form-label">Nama</label>
                    <input name="nama" type="text" class="form-control" id="formGroupExampleInput" placeholder="Masukkan Nama">
                </div>
                <div class="form-group text-start w-50 d-inline-block">
                    <label for="formGroupExampleInput2" class="form-label">Jabatan</label>
                    <input name="jabatan" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Masukkan Jabatan">
                </div>
                <div class="form-group text-start w-50 d-inline-block">
                    <label for="formGroupExampleInput2" class="form-label">Usia</label>
                    <input name="usia" type="number" class="form-control" id="formGroupExampleInput2" placeholder="Masukkan Usia">
                </div>

            </div>
            <button name="submit" type="submit" class="btn d-block mt-2 btn-primary mx-auto">Submit</button>

        </form>
    <?php
    } else {
    ?>
        <form method="POST" action="view.php">
            <div class="text-center">
                <div class="form-group text-start w-50 d-inline-block">
                    <label for="formGroupExampleInput" class="form-label">Nama</label>
                    <input name="nama" type="text" class="form-control" id="formGroupExampleInput" placeholder="Masukkan Nama" value="<?php
                                                                                                                                        foreach (indexKar() as $index => $karyawan) {
                                                                                                                                            if ($_GET['edit'] == $index) {

                                                                                                                                                echo "$karyawan->nama";
                                                                                                                                            }
                                                                                                                                        }
                                                                                                                                        ?>">
                </div>
                <div class="form-group text-start w-50 d-inline-block">
                    <label for="formGroupExampleInput2" class="form-label">Jabatan</label>
                    <input name="jabatan" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Masukkan Jabatan" value="<?php
                                                                                                                                        foreach (indexKar() as $index => $karyawan) {
                                                                                                                                            if ($_GET['edit'] == $index) {

                                                                                                                                                echo "$karyawan->jabatan";
                                                                                                                                            }
                                                                                                                                        }
                                                                                                                                        ?>">
                </div>
                <div class="form-group text-start w-50 d-inline-block">
                    <label for="formGroupExampleInput2" class="form-label">Usia</label>
                    <input name="usia" type="number" class="form-control" id="formGroupExampleInput2" placeholder="Masukkan Usia" value="<?php
                                                                                                                                        foreach (indexKar() as $index => $karyawan) {
                                                                                                                                            if ($_GET['edit'] == $index) {

                                                                                                                                                echo $karyawan->usia;
                                                                                                                                            }
                                                                                                                                        }
                                                                                                                                        ?>">
                </div>
                <input type="hidden" name="idKar" value="<?= $_GET['edit'] ?>">
                <input type="hidden" name="namalama" value="<?= $_GET['nama'] ?>">


            </div>
            <button name="submitedit" type="submit" class="btn d-block mt-2 btn-primary mx-auto">Edit</button>

        </form>
    <?php
    }
    ?>
</body>

</html>