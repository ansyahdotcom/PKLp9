<?php

namespace App\Models;

use CodeIgniter\Model;

class KandidatModel extends Model
{
    protected $table = 'kandidat';
    protected $useTimestamps = true;

    public function getKandidat()
    {
        $this->select('*');
        $this->join('user as u1', 'u1.nis=kandidat.ketua');
        $this->join('user as u2', 'u2.nis=kandidat.wakil');
        $this->join('periode', 'periode.id_periode=kandidat.id_periode');
        $this->orderBy('id_kandidat', 'DESC');
        return $this->get();
    }

    public function pemilihan()
    {
        $data = $this->db->query("SELECT * FROM kandidat, user, kelas, periode 
            WHERE kandidat.ketua = user.nis AND user.id_kelas = kelas.id_kelas 
            AND periode.id_periode = kandidat.id_periode");
        return $data;
    }
}
