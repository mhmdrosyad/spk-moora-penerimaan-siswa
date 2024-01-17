<?php

namespace App\Models;

use CodeIgniter\Model;

class KriteriaModel extends Model
{
    protected $table      = 'kriteria'; // Sesuaikan dengan nama tabel Anda
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_kriteria', 'bobot'];

    public function getKriteria($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->find($id);
    }

    public function insertKriteria($data)
    {
        return $this->insert($data);
    }

    public function updateKriteria($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteKriteria($id)
    {
        return $this->delete($id);
    }
    public function deleteAll()
    {
        $builder = $this->db->table($this->table);
        return $builder->truncate(); // Gunakan truncate untuk menghapus semua data
    }
}
