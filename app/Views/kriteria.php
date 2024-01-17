<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div id="content">
    <div class="container-fluid">

        <h2 class="m-0 font-weight-bold text-success text-center">Tambah Kriteria</h2>

        <div class="card">
            <!-- Form untuk menambahkan kriteria -->
            <form method="post" action="/simpankriteria">
                <div class="form-group">
                    <label for="nama_kriteria">Nama Kriteria</label>
                    <input type="text" name="nama_kriteria" id="nama_kriteria" class="form-control" required>
                    <label for="nama_kriteria">Bobot</label>
                    <input type="text" name="bobot" id="nama_kriteria" class="form-control" required>
                </div>

                <!-- Tambahkan field lain sesuai kebutuhan -->

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus"></i> Simpan Kriteria
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<?= $this->endSection() ?>