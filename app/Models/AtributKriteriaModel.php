<?php

namespace App\Models;

use CodeIgniter\Model;

class AtributKriteriaModel extends Model
{
    protected $table = 'atribut_kriteria';
    protected $primaryKey = 'id';
    protected $allowedFields = ['siswa_id', 'kriteria_id', 'nilai'];

    public function siswa()
    {
        return $this->belongsTo('App\Models\SiswaModel', 'siswa_id');
    }

    public function kriteria()
    {
        return $this->belongsTo('App\Models\KriteriaModel', 'kriteria_id');
    }
    public function deleteAll()
    {
        $builder = $this->db->table($this->table);
        return $builder->truncate(); // Gunakan truncate untuk menghapus semua data
    }
    public function getNilaiAtribut($siswaId, $kriteriaId)
    {
        return $this->where(['siswa_id' => $siswaId, 'kriteria_id' => $kriteriaId])
            ->get()
            ->getRow('nilai');
    }
}
