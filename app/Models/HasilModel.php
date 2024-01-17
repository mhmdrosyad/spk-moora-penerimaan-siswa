<?php

namespace App\Models;

use CodeIgniter\Model;

class HasilModel extends Model
{
    protected $table = 'hasil'; // Gantilah 'hasil' dengan nama tabel yang sesuai
    protected $primaryKey = 'id'; // Gantilah 'id' jika kolom primary key tabel Anda berbeda

    protected $allowedFields = ['nama', 'nilai_total','tgl']; // Sesuaikan dengan kolom-kolom yang ada di tabel Anda

    // Tambahkan atribut-atribut lain seperti created_at, updated_at jika diperlukan

    // Contoh metode lain yang sesuai dengan kebutuhan Anda
}
