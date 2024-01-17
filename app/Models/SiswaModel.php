<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table = 'siswa'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key tabel
    protected $allowedFields = ['nama'];

    // Di dalam model SiswaModel
    public function getSiswaWithAtributKriteria()
    {
        $builder = $this->db->table('siswa');
        $builder->select('siswa.*, GROUP_CONCAT(atribut_kriteria.nilai ORDER BY atribut_kriteria.kriteria_id) as nilai_kriteria');
        $builder->join('atribut_kriteria', 'siswa.id = atribut_kriteria.siswa_id', 'left');
        $builder->groupBy('siswa.id');

        return $builder->get()->getResultArray();
    }
    public function deleteAll()
    {
        $builder = $this->db->table($this->table);
        return $builder->truncate(); // Gunakan truncate untuk menghapus semua data
    }
}
