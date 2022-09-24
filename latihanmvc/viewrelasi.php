<?php
require("allcontroller.php");
if (isset($_POST['submit'])) {
    $indexkaryawan = $_POST['indexkar'];
    $indexkantor = $_POST['indexkan'];
    $dupe = 0;

    if (!isset($_POST['editRelasi'])) {
        foreach (indexKar() as $index => $karyawan) {
            if ($index == $indexkaryawan) {
                $nama = $karyawan->nama;
                $jabatan = $karyawan->jabatan;
                $usia = $karyawan->usia;
            }
        }



        foreach (indexOffice() as $index => $office) {
            if ($index == $indexkantor) {
                $nkantor = $office->namakantor;
                $alamat = $office->alamat;
                $kota = $office->kota;
                $kontak = $office->kontak;
            }
        }
        foreach (indexRelasi() as $index => $relasi) {
            if ($nama == $relasi->rnama) {
                $dupe++;
            }
        }
        if ($dupe == 0) {
            header("Location: viewrelasi.php?nama=$nama&jabatan=$jabatan&usia=$usia&namakantor=$nkantor&alamat=$alamat&kota=$kota&kontak=$kontak");
        } else {
            echo '<script>alert("Karyawan ' . $nama . ' telah memiliki kantor")</script>';
        }
    } else {
        foreach (indexKar() as $index => $karyawan) {
            if ($index == $indexkaryawan) {
                $nama = $karyawan->nama;
                $jabatan = $karyawan->jabatan;
                $usia = $karyawan->usia;
            }
        }
        foreach (indexOffice() as $index => $office) {
            if ($index == $indexkantor) {
                $nkantor = $office->namakantor;
                $alamat = $office->alamat;
                $kota = $office->kota;
                $kontak = $office->kontak;
            }
        }
        editRelasi($nama, $jabatan, $usia, $nkantor, $alamat, $kota, $kontak);
    }
}

if (isset($_GET['nama'])) {
    insertRelasi();
    header("Location: viewrelasi.php");
}

if (isset($_GET['delete'])) {
    deleteRelasi($_GET['delete']);
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
        Karyawan Kantor
    </h1>
    <table class="table table-bordered table-dark mt-2 w-50 mx-auto">
        <thead>
            <tr>
                <th scope="col" rowspan="2" class="text-center align-middle">No</th>
                <th scope="col" colspan="3" class="text-center">Karyawan</th>
                <th scope="col" colspan="4" class="text-center">Kantor</th>
                <th scope="col" rowspan="2" class="text-center align-middle">Delete</th>
                <th scope="col" rowspan="2" class="text-center align-middle">Edit</th>
            </tr>
            <tr>
                <th scope="col">Nama</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Usia</th>
                <th scope="col">Nama Kantor</th>
                <th scope="col">Alamat</th>
                <th scope="col">Kota</th>
                <th scope="col">Kontak</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach (indexRelasi() as $index => $relasi) {
                echo "
                <tr>
                    <td>" . $index . "</td>
                    <td>" . $relasi->rnama . "</td>
                    <td>" . $relasi->rjabatan . "</td>
                    <td>" . $relasi->rusia . "</td>
                    <td>" . $relasi->rnamakantor . "</td>
                    <td>" . $relasi->ralamat . "</td>
                    <td>" . $relasi->rkota . "</td>
                    <td>" . $relasi->rkontak . "</td>
                    <td class='text-center'><a href='viewrelasi.php?delete=" . $index . "'><button class='btn btn-primary'>Delete</button></a></td>
                    <td class='text-center'><a href='viewrelasi.php?edit=" . $relasi->rnama . "&ekantor=" . $relasi->rnamakantor . "'><button class='btn btn-primary'>Edit</button></a></td>
                </tr>
                ";
            }
            ?>
        </tbody>
    </table>
    <h1 class="text-center mt-2">
        <?= (isset($_GET['edit'])) ? 'Edit' : 'List' ?>
        Karyawan Kantor
    </h1>
    <?php
    if (isset($_GET['edit'])) {
    ?>
        <div class="d-flex justify-content-center"><a href="viewrelasi.php" class="btn btn-danger" tabindex="-1" role="button">CANCEL</a>
        </div>
    <?php
    }
    ?>
    <form method="POST" action="viewrelasi.php">
        <div class="text-center">
            <div class="form-group text-start w-50 d-inline-block">
                <label for="formGroupExampleInput" class="form-label">Nama Karyawan</label>
                <select class="form-select" name="indexkar">
                    <?php
                    foreach (indexKar() as $index => $karyawan) {
                        if (!isset($_GET['edit'])) {
                    ?>
                            <option value="<?= $index ?>"><?= $karyawan->nama ?></option>
                            <?php } else {
                            if ($karyawan->nama == $_GET['edit']) {
                            ?>
                                <option value="<?= $index ?>"><?= $karyawan->nama ?></option>
                                <input type="hidden" name="editRelasi" value="true">
                    <?php
                            }
                        }
                    } ?>
                </select>
            </div>
            <div class="form-group text-start w-50 d-inline-block">
                <label for="formGroupExampleInput" class="form-label">Nama Kantor</label>
                <select class="form-select" name="indexkan">
                    <?php
                    foreach (indexOffice() as $index => $office) {
                    ?>
                        <option value="<?= $index ?>" <?php if (isset($_GET['ekantor'])) {
                                                            echo ($office->namakantor == $_GET['ekantor']) ? 'selected' : '';
                                                        } ?>><?= $office->namakantor ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <button name="submit" type="submit" class="btn d-block mt-2 btn-primary mx-auto">Submit</button>
    </form>
</body>

</html>