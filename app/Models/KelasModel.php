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
        // $this->join('user', 'kelas.id_kelas=user.id_kelas');
        $this->orderBy('id_kelas', 'DESC');
        return $this->get();
    }
}