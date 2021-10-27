<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table            = 'kelas';
    protected $useTimestamps    = true;
    protected $primaryKey       = 'id_kelas';
    protected $allowedFields    = ['id_kelas', 'nama_kelas'];
    
    public function getKelas()
    {
        $this->select('*');
        $this->orderBy('id_kelas', 'ASC');
        return $this->get();
    }

    public function editKelas($id)
    {
        return $this->getWhere(['id_kelas' => $id])->getRowArray();
    }

    public function detailKelas($id)
    {
        $kelas = $this->getWhere(['id_kelas' => $id])->getResultArray();
        return $kelas;
    }

    public function add($insert)
    {
        $this->db->table('kelas')->insert($insert);
    }
}