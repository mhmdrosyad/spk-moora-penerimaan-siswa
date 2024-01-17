    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.21.0/font/bootstrap-icons.css">

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>PSB ADMIN</title>

        <!-- Custom fonts for this template -->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">

        <!-- Custom styles for this page -->
        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <style>
            .green-text {
                color: green;
            }

            .red-text {
                color: red;
            }
        </style>
    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                    <div class="sidebar-brand-icon rotate-n-0">
                        <img src="img/min.png" width="50">
                    </div>
                    <div class="sidebar-brand-text mx-3">MIN 1 YOGYAKARTA</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Data Siswa</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Nav Item - Data Siswa -->
                <li class="nav-item">
                    <a class="nav-link" href="datasiswa">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Perhitungan</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <li class="nav-item">
                    <a class="nav-link" href="hasil">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Hasil Perhitungan MOORA</span></a>
                </li>

                <hr class="sidebar-divider">

                <!-- <li class="nav-item">  
                    <a class="nav-link" href="histori">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Histori</span></a>
                </li> -->
                <!-- Divider -->
                <!-- <hr class="sidebar-divider d-none d-md-block"> -->

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <form class="form-inline">
                            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                                <i class="fa fa-bars"></i>
                            </button>
                        </form>

                        <!-- Topbar Search -->

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-success" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Logout</span>
                                    <img class="img-profile rounded-circle" src="img/logout.png">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h2 class="m-0 font-weight-bold text-success text-centerzf">Hasil Perhitungan MOORA</h2>
                            </div>
                            <div class="card-body"></div>
                        </div>
                        <!-- Di dalam tag <div class="card-body"></div> -->


                        <div class="table-responsive">
                            <a href="<?= site_url('/generatePdf') ?>" target="_blank" class="btn btn-success">
                                <i class="fas fa-print"></i> Download
                            </a>


                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="bg-success">
                                    <tr>
                                        <th>No Reg</th>
                                        <th>Name</th>
                                        <th>Nilai</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                    $rowNumber = 0;
                                    $siswaLolos = 0;
                                    $batasLolos = 65; // Sesuaikan dengan jumlah siswa yang Sekolah inginkan untuk lolos
                                    ?>
                                <!-- <div class="card-body">
                                    <form id="formBatasLolos" class="mb-3">
                                        <label for="inputBatasLolos">Batas Siswa Lolos:</label>
                                        <br>
                                        <input type="number" id="inputBatasLolos" name="inputBatasLolos" min="1" value="<?= $batasLolos; ?>">
                                        <button type="button" onclick="simpanBatasLolos()" class="btn btn-success">Terapkan</button>
                                    </form>
                                </div> -->
                                    <?php foreach ($hasil as $row) : ?>
                                        <tr data-row-number="<?= $rowNumber++; ?>">
                                            <td><?= sprintf('%03d', $rowNumber); ?></td>
                                            <td><?= $row['nama']; ?></td>
                                            <td><?= $row['nilai_total']; ?></td>
                                            <td><?= $row['tgl'] ?></td>
                                            <td>
                                                <?php
                                                if ($siswaLolos < $batasLolos) {
                                                    echo '<span style="color: green;">Lolos</span>';
                                                    $siswaLolos++;
                                                } else {
                                                    echo '<span style="color: red;">Tidak Lolos</span>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <a href="/clearhasil" id="clearHasil" class="btn btn-danger">Clear Data Hasil</a>
                            <!-- Script JavaScript -->
                            <!-- Script JavaScript -->
                            <script>
                                document.getElementById('clearHasil').addEventListener('click', function(e) {
                                    e.preventDefault()
                                    // Tampilkan konfirmasi
                                    var confirmation = confirm('Apakah Anda yakin ingin menghapus semua data perhitungan?');

                                    if (confirmation) {
                                        // Panggil metode clearhasil() menggunakan Ajax
                                        clearhasil();
                                    } else {
                                        console.log('User canceled');
                                    } 
                                });

                                // Metode untuk membersihkan data perhitungan
                                function clearhasil() {
                                    // Panggil metode di controller untuk menghapus data perhitungan
                                    fetch('/clearhasil')
                                        .then(response => {
                                            if (response.ok) {
                                                // Jika sukses, reload halaman
                                                location.reload();
                                            } else {
                                                // Jika gagal, tampilkan pesan kesalahan dari server
                                                return response.text();
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                            alert('Terjadi kesalahan. Silakan coba lagi.');
                                        });
                                }
                            </script>



                        </div>





                    </div>
                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; MIN 1 YOGYAKARTA</span>
                    </div>
                </div>
            </footer>
        <!-- End of Footer -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Apakah Anda Ingin Keluar.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-success" href="logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <!-- Setelah semua tag <script> yang ada -->
        <script>
    // Fungsi untuk menentukan siswa yang lolos berdasarkan nomor
    function updateStatusBasedOnInputNumber(enteredNumber) {
        const rows = document.querySelectorAll("tr[data-row-number]");
        rows.forEach(row => {
            const rowNumber = parseInt(row.getAttribute("data-row-number"));
            const nilaiCell = row.querySelector("td:nth-child(3)"); // Kolom "Nilai"
            const keteranganCell = row.querySelector("td:nth-child(5)"); // Kolom "Keterangan"

            if (rowNumber <= enteredNumber) {
                nilaiCell.classList.remove("red-text");
                nilaiCell.classList.add("green-text");
                keteranganCell.innerHTML = '<span style="color: green;">Lolos</span>';
            } else {
                nilaiCell.classList.remove("green-text");
                nilaiCell.classList.add("red-text");
                keteranganCell.innerHTML = '<span style="color: red;">Tidak Lolos</span>';
            }
        });
    }

    // Mendengarkan input nomor
    document.getElementById("inputBatasLolos").addEventListener("input", function() {
        const enteredNumber = parseInt(this.value);

        // Pastikan nilai yang dimasukkan adalah angka
        if (!isNaN(enteredNumber)) {
            updateStatusBasedOnInputNumber(enteredNumber -1);
        } else {
            // Handle jika input bukan angka
            // Misalnya, reset keterangan siswa jika input bukan angka
            const rows = document.querySelectorAll("tr[data-row-number]");
            rows.forEach(row => {
                const keteranganCell = row.querySelector("td:nth-child(5)");
                keteranganCell.innerHTML = '';
            });
        }
    });

    // Fungsi untuk menyimpan batas siswa yang lolos
    function simpanBatasLolos() {
        const batasLolos = document.getElementById('inputBatasLolos').value;

        // Kirim nilai batas lolos ke server untuk disimpan
        fetch('/set_batas_lolos', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                // Headers lain yang diperlukan, jika ada
            },
            body: JSON.stringify({ batasLolos: batasLolos }),
        })
        .then(response => {
            // Handle respons dari server jika diperlukan
        })
        .catch(error => {
            // Handle error jika terjadi kesalahan koneksi atau permintaan
        });

        // Update status siswa berdasarkan batas yang baru disimpan
        updateStatusBasedOnInputNumber(parseInt(batasLolos));
    }
</script>

        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/datatables-demo.js"></script>

    </body>

    </html>