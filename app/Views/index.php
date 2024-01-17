<?= $this->extend('layout/main') ?>
<!-- Content Wrapper -->
<?= $this->section('content') ?>


<!-- Main Content -->
<div id="content">



    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h2 class="m-0 font-weight-bold text-success text-center">Data Siswa</h2>

        <div class="card">
            <h2>Import Data Siswa</h2>

            <?php if (session()->has('message')) : ?>
                <div class="alert alert-<?= session('message_type') ?>">
                    <?= session('message') ?>
                </div>
            <?php endif; ?>

            <form method="post" action="/import" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="excel_file">Choose Excel File</label>
                    <input type="file" name="excel_file" id="excel_file" class="form-control" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-file-import"></i> Import Data
                    </button>
                </div>

            </form>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>
                    <button id="tambahData" onclick="location.href='tambahdata'" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah Data </button>
                    <button id="tambahKriteria" onclick="location.href='kriteria'" class="btn btn-info">
                        <i class="fas fa-plus"></i> Tambah Kriteria </button>

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-success">
                            <tr>
                                <th>No Reg</th>
                                <th>Nama</th>
                                <?php foreach ($kriteria as $item) : ?>
                                    <th><?= $item['nama_kriteria']; ?></th>
                                <?php endforeach; ?>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Di dalam file view (misalnya, index.php) -->
                            <?php foreach ($siswa as $index => $row) : ?>
                                <tr>
                                    <td><?= sprintf('%03d', $index + 1); ?></td>
                                    <td><?= $row['nama']; ?></td>
                                    <?php
                                    $nilai_kriteria = explode(',', $row['nilai_kriteria']);
                                    foreach ($nilai_kriteria as $nilai) : ?>
                                        <td><?= $nilai; ?></td>
                                    <?php endforeach; ?>
                                    <td>
                                        <div style="display: flex; align-items: center;">
                                            <a href="edit/<?= $row['id']; ?>" class="btn btn-warning" style="margin-right: 10px;">Edit</a>
                                            <a href="delete/<?= $row['id']; ?>" class="btn btn-success">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>



                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?= $this->endSection() ?>