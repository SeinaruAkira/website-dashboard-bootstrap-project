<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link rel="icon" href="../../assets/img/favicon.ico" type="image/x-icon">
    <link href="../../css/styles.css" rel="stylesheet" />
    <link href="../../css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../font/fontawesome/css/all.min.css">
    <script src="../../js/scripts.js"></script>
    <script src="../../js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../../js/datatables-simple-demo.js"></script>
    <style>
        .floating-alert {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 1050;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <?php
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                createAlert('$message');
                setTimeout(function() {
                    $(alertDiv).alert('close');
                    isAlertVisible = false;
                }, 2000);
            });
        </script>";
        unset($_SESSION['message']); // Hapus pesan setelah ditampilkan
    }
    ?>
    <!-- Navbar -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Start Bootstrap</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="login.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- End Navbar -->

    <!-- Sidebar -->
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Content
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="siswa.php">Siswa</a>
                                <a class="nav-link" href="guru.php">Guru</a>
                                <a class="nav-link" href="presensi.php">Presensi</a>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Admin</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#tambahLayout" aria-expanded="false" aria-controls="tambahLayout">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Tambah Data
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="tambahLayout" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="../proses-dashboard/tambahSiswa.php">Siswa</a>
                                <a class="nav-link" href="../proses-dashboard/tambahGuru.php">Guru</a>
                                <a class="nav-link" href="../proses-dashboard/buatSesi.php">Tambah Sesi</a>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <!-- End Sidebar -->

        <!-- Main Content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="card shadow-lg border-0 rounded-lg mt-5 w-100">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Absen</h3>
                                    <div class="mb-3">
                                        <!-- Form untuk memilih kelas -->
                                        <form method="POST" action="" id="kategori-form" class="w-100">
                                            <div class="mb-3">
                                                <label for="kelas" class="form-label">Kelas:</label>
                                                <select name="kelas" id="kelas" class="form-select" onchange="this.form.submit()">
                                                    <option value="">Semua</option>
                                                    <?php
                                                    include "../proses-dashboard/connect.php";

                                                    // Query untuk mengambil daftar kelas yang unik
                                                    $sql = "SELECT DISTINCT(nama_kelas) FROM tabel_kelas";
                                                    $result = $conn->query($sql);

                                                    // Ambil kategori yang dipilih sebelumnya
                                                    $kelasDipilih = isset($_POST['kelas']) ? $_POST['kelas'] : '';

                                                    // Tampilkan opsi kelas
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $selected = ($kelasDipilih == $row['nama_kelas']) ? 'selected' : '';
                                                            echo "<option value='" . $row['nama_kelas'] . "' $selected>" . $row['nama_kelas'] . "</option>";
                                                        }
                                                    }

                                                    // Tutup koneksi
                                                    $conn->close();
                                                    ?>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <?php
                                    // Koneksi ke database
                                    include "../proses-dashboard/connect.php";

                                    // Query untuk mengambil data siswa sesuai kategori yang dipilih
                                    $sql = "SELECT * FROM tabel_siswa";
                                    if ($kelasDipilih != '') {
                                        $sql .= " WHERE idKelas_siswa = '$kelasDipilih'";
                                    }

                                    $result = $conn->query($sql);
                                    ?>

                                    <form method="POST" action="simpan_presensi.php" id="presensi-form" class="w-100">
                                        <?php
                                        if ($result->num_rows > 0) {
                                            echo "<h3 class='mt-4 text-center'>Data Siswa</h3>";
                                            echo "<table class='table table-bordered table-striped w-100 text-center'>
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Nama</th>
                                                        <th>Kelas</th>
                                                        <th>Hadir</th>
                                                        <th>Sakit</th>
                                                        <th>Izin</th>
                                                        <th>Alpha</th>
                                                    </tr>
                                                </thead>
                                                <tbody>";
                                            $no = 0;
                                            while ($row = $result->fetch_assoc()) {
                                                $no++;
                                                // Nama grup radio berdasarkan ID siswa
                                                $radioGroupName = "kehadiran_" . $row['id_siswa']; // Pastikan ID siswa digunakan sebagai bagian dari nama grup
                                                echo "<tr>
                                                        <td>" . $no . "</td>
                                                        <td>" . $row['nama_siswa'] . "</td>
                                                        <td>" . $row['idKelas_siswa'] . "</td>
                                                        <td><input type='radio' class='btn-check' name='" . $radioGroupName . "' id='hadir_" . $row['id_siswa'] . "' value='Hadir'><label class='btn btn-outline-primary w-100' for='hadir_" . $row['id_siswa'] . "'>Hadir</label></td>
                                                        <td><input type='radio' class='btn-check' name='" . $radioGroupName . "' id='sakit_" . $row['id_siswa'] . "' value='Sakit'><label class='btn btn-outline-primary w-100' for='sakit_" . $row['id_siswa'] . "'>Sakit</label></td>
                                                        <td><input type='radio' class='btn-check' name='" . $radioGroupName . "' id='izin_" . $row['id_siswa'] . "' value='Izin'><label class='btn btn-outline-primary w-100' for='izin_" . $row['id_siswa'] . "'>Izin</label></td>
                                                        <td><input type='radio' class='btn-check' name='" . $radioGroupName . "' id='alpha_" . $row['id_siswa'] . "' value='Alpha'><label class='btn btn-outline-primary w-100' for='alpha_" . $row['id_siswa'] . "'>Alpha</label></td>
                                                    </tr>";
                                            }
                                            echo "</tbody></table>";
                                        } else {
                                            echo "<p class='mt-4'>Tidak ada data siswa yang ditemukan.</p>";
                                        }

                                        // Tutup koneksi
                                        $conn->close();
                                        ?>

                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary w-100" id="btnS">Simpan Presensi</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- End Main Content -->
    </div>
    <script>
        function onChangeAction() {
            console.log("Action Change");
            var form = document.getElementById("form");
            form.submit();
        }
        var isAlertVisible = false; // Variabel untuk melacak status notifikasi

        // Fungsi untuk membuat dan menampilkan alert baru
        function createAlert(message) {
            if (!isAlertVisible) {
                isAlertVisible = true;

                // Membuat elemen div untuk alert baru
                var alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-success alert-dismissible fade show floating-alert';
                alertDiv.role = 'alert';
                alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;

                // Menambahkan alert baru ke dalam body
                document.body.appendChild(alertDiv);

                // Menghilangkan alert secara otomatis setelah 2 detik
                setTimeout(function() {
                    alertDiv.remove(); // Menghapus alert dari DOM
                    isAlertVisible = false;
                }, 2000);

                // Mengatur agar status diperbarui jika alert ditutup secara manual
                alertDiv.addEventListener('closed.bs.alert', function() {
                    isAlertVisible = false;
                });
            }
        }
    </script>
</body>

</html>