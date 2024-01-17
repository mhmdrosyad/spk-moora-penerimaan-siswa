<?php

namespace App\Models;
use CodeIgniter\Model;

class AkunModel extends Model
{
    protected $table = 'akun'; // Gantilah 'hasil' dengan nama tabel yang sesuai
    protected $primaryKey = 'id'; // Gantilah 'id' jika kolom primary key tabel Anda berbeda
    protected $allowedFields = ['username', 'password']; // Sesuaikan dengan kolom-kolom yang ada di tabel Anda

}