<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table = 'kelas';
    protected $useTimestamps = true;

    public function getKelas()
    {
        $this->select('*');
        $this->orderBy('id_kelas', 'ASC');
        return $this->get();
    }

    public function getJumlahSiswa()
    {
        $this->select('*');
        $this->join('user', 'user.id_kelas=kelas.id_kelas');
        return $this->db->table('user')->countAll();
    }
}