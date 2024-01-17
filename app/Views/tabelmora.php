    <style>
        /* Gaya untuk judul tabel */
        .table-title {
            font-size: 24px;
            font-weight: bold;
            margin: 20px 0;
        }

        /* Gaya untuk tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .green-text {
            color: green;
        }

        .red-text {
            color: red;
        }

        .text-center {
            text-align: center;
        }
    </style>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="text-right">
                <!-- <img src="img/min.png" width="50"> -->
                </div>
                <h2 class="m-0 font-weight-bold text-center">Hasil Penerimaan Siswa Baru MIN 1 Yogyakarta</h2>
            </div>
            <div class="card-body">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No Reg</th>
                            <th>Name</th>
                            <!-- <th>Nilai</th>
                            <th>Tanggal</th> -->
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $rowNumber = 0;
                        $siswaLolos = 0;
                        $batasLolos = 64; // Sesuaikan dengan jumlah siswa yang Anda inginkan untuk lolos
                        ?>
                        <?php foreach ($hasil as $row) : ?>
                            <tr data-row-number="<?= $rowNumber++; ?>">
                                <td><?= sprintf('%03d', $rowNumber); ?></td>
                                <td><?= $row['nama']; ?></td>
                                <!-- <td><?= $row['nilai_total']; ?></td>
                                <td><?= $row['tgl'] ?></td> -->
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
            </div>



        </div>
    </div>