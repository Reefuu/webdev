<?php
require("allcontroller.php");
if (isset($_POST['submit'])) {
    $dupe = 0;
    $nama = $_POST['namakantor'];
    foreach (indexOffice() as $index => $office) {
        if ($nama == $office->namakantor) {
            $dupe++;
        }
    }
    if ($dupe == 0) {
        insertOffice();
    } else {
        echo '<script>alert("Kantor bernama ' . $nama . ' telah terdaftar")</script>';
    }
}
if (isset($_GET['delete'])) {
    deleteOffice($_GET['delete']);
    $nama = $_GET['nama'];
    foreach (indexRelasi() as $index => $relasi) {
        if ($nama == $relasi->rnamakantor) {
            deleteRelasi($index);
        }
    }
    header("Location: viewoffice.php");
}
if(isset($_POST['submitedit'])){
    $id = $_POST['idKantor'];
    editOffice($id);
    $nama = $_POST['namalama'];
    editRelasiKantor($nama);
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
        List Kantor
    </h1>
    <table class="table table-dark mt-2 w-50 mx-auto">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Kantor</th>
                <th scope="col">Alamat</th>
                <th scope="col">Kota</th>
                <th scope="col">Kontak</th>
                <th scope="col" class="text-center">Delete</th>
                <th scope="col" class="text-center">Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach (indexOffice() as $index => $boffice) {
                echo "
                <tr>
                    <td>" . $index . "</td>
                    <td>" . $boffice->namakantor . "</td>
                    <td>" . $boffice->alamat . "</td>
                    <td>" . $boffice->kota . "</td>
                    <td>" . $boffice->kontak . "</td>
                    <td class='text-center'><a href='viewoffice.php?delete=" . $index . "&nama=" . $boffice->namakantor . "'><button class='btn btn-primary'>Delete</button></a></td>
                    <td class='text-center'><a href='viewoffice.php?edit=" . $index . "&nama=" . $boffice->namakantor . "'><button class='btn btn-primary'>Edit</button></a></td>
                </tr>
                ";
            }
            ?>
        </tbody>
    </table>
    <h1 class="text-center mt-2">
        List Kantor
    </h1>
    <?php
    if (!isset($_GET['edit'])) {
    ?>
        <form method="POST" action="viewoffice.php">
            <div class="text-center">
                <div class="form-group text-start w-50 d-inline-block">
                    <label for="formGroupExampleInput" class="form-label">Nama Kantor</label>
                    <input name="namakantor" type="text" class="form-control" id="formGroupExampleInput" placeholder="Masukkan Nama Kantor">
                </div>
                <div class="form-group text-start w-50 d-inline-block">
                    <label for="formGroupExampleInput2" class="form-label">Alamat Kantor</label>
                    <input name="alamat" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Masukkan Alamat Kantor">
                </div>
                <div class="form-group text-start w-50 d-inline-block">
                    <label for="formGroupExampleInput2" class="form-label">Kota Kantor</label>
                    <input name="kota" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Masukkan Kota Kantor">
                </div>
                <div class="form-group text-start w-50 d-inline-block">
                    <label for="formGroupExampleInput2" class="form-label">Kontak Kantor</label>
                    <input name="kontak" type="number" class="form-control" id="formGroupExampleInput2" placeholder="Masukkan Kontak Kantor">
                </div>
            </div>
            <button name="submit" type="submit" class="btn d-block mt-2 btn-primary mx-auto">Submit</button>

        </form>

    <?php
    } else {
    ?>
        <form method="POST" action="viewoffice.php">
            <div class="text-center">
                <div class="form-group text-start w-50 d-inline-block">
                    <label for="formGroupExampleInput" class="form-label">Nama Kantor</label>
                    <input name="namakantor" type="text" class="form-control" id="formGroupExampleInput" placeholder="Masukkan Nama Kantor" value="<?php
                                                                                                                                        foreach (indexOffice() as $index => $office) {
                                                                                                                                            if ($_GET['edit'] == $index) {

                                                                                                                                                echo "$office->namakantor";
                                                                                                                                            }
                                                                                                                                        }
                                                                                                                                        ?>">
                </div>
                <div class="form-group text-start w-50 d-inline-block">
                    <label for="formGroupExampleInput2" class="form-label">Alamat</label>
                    <input name="alamat" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Masukkan Alamat" value="<?php
                                                                                                                                                foreach (indexOffice() as $index => $office) {
                                                                                                                                                    if ($_GET['edit'] == $index) {

                                                                                                                                                        echo "$office->alamat";
                                                                                                                                                    }
                                                                                                                                                }
                                                                                                                                                ?>">
                </div>
                <div class="form-group text-start w-50 d-inline-block">
                    <label for="formGroupExampleInput2" class="form-label">Kota</label>
                    <input name="kota" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Masukkan Kota" value="<?php
                                                                                                                                            foreach (indexOffice() as $index => $office) {
                                                                                                                                                if ($_GET['edit'] == $index) {

                                                                                                                                                    echo $office->kota;
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                            ?>">
                </div>
                <div class="form-group text-start w-50 d-inline-block">
                    <label for="formGroupExampleInput2" class="form-label">Kontak Kantor</label>
                    <input name="kontak" type="number" class="form-control" id="formGroupExampleInput2" placeholder="Masukkan Kontak Kantor" value="<?php
                                                                                                                                            foreach (indexOffice() as $index => $office) {
                                                                                                                                                if ($_GET['edit'] == $index) {

                                                                                                                                                    echo $office->kontak;
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                            ?>">
                </div>
                <input type="hidden" name="idKantor" value="<?= $_GET['edit'] ?>">
                <input type="hidden" name="namalama" value="<?= $_GET['nama'] ?>">


            </div>
            <button name="submitedit" type="submit" class="btn d-block mt-2 btn-primary mx-auto">Edit</button>

        </form>
    <?php
    }
    ?>

</body>

</html>