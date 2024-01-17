<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f8ff; /* Light blue background */
        }
        .container {
            margin-top: 20px;
            background-color: #fff; /* White background */
            border-radius: 10px; /* Rounded corners */
            padding: 20px;
            box-shadow: 0px 0px 10px #888888; /* Box shadow for a slight 3D effect */
        }
        h2 {
            color: #007bff; /* Blue heading text color */
            text-align: center; /* Center the heading text */
        }
        .form-control {
            border-radius: 5px; /* Rounded input fields */
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
        }
        .btn-container a {
            margin-right: 10px;
        }
        .btn-container a:last-child {
            margin-right: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Data Siswa</h2>
        <form action="<?= base_url('Home/update/' . $siswa['id']); ?>" method="post">
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input
                type="text"
                class="form-control"
                name="nama"
                value="<?= $siswa['nama']; ?>"
                required="required">
        </div>
        <div class="form-group">
            <label for="umur">Umur:</label>
            <input
                type="number"
                class="form-control"
                name="umur"
                value="<?= $siswa['umur']; ?>"
                required="required">
        </div>
        <div class="form-group">
            <label for="hafalan">Al-Qur'a/Iqro:</label>
            <input
                type="number"
                class="form-control"
                name="hafalan"
                value="<?= $siswa['hafalan']; ?>"
                required="required">
        </div>
        <div class="form-group">
            <label for="calistung">Calistung:</label>
            <input
                type="number"
                class="form-control"
                name="calistung"
                value="<?= $siswa['calistung']; ?>"
                required="required">
        </div>
        <div class="form-group">
            <label for="kb">Kesiapan Belajar:</label>
            <input
                type="number"
                class="form-control"
                name="kb"
                value="<?= $siswa['kb']; ?>"
                required="required">
        </div>
            <div class="btn-container">
                <a href="/" class="btn btn-danger">Batal</a>
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</body>
</html>
