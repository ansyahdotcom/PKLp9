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
        // SELECT kelas.nama_kelas, COUNT('user.id_kelas') as jumlah_siswa 
        // FROM user, kelas WHERE user.id_kelas=kelas.id_kelas group by kelas.id_kelas
        $this->join('user', 'user.id_kelas=kelas.id_kelas');
        return $this->db->table('user')->countAll();
    }
}