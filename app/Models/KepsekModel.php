<?php
namespace App\Models;
use CodeIgniter\Model;

class KepsekModel extends Model
{
    protected $table = 'kepsek';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password'];

    // Metode lain yang diperlukan untuk operasi pada tabel kepsek
}