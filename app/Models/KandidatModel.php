<?php

namespace App\Models;

use CodeIgniter\Model;

class KandidatModel extends Model
{
    protected $table = 'kandidat';
    protected $useTimestamps = true;
    protected $allowedFields = ['ketua', 'wakil', 'nama_pasangan', 'foto', 'visi', 'misi', 'periode'];

    public function getKandidat()
    {
        $this->select('*');
        $this->join('user as u1', 'u1.nis=kandidat.ketua');
        $this->join('user as u2', 'u2.nis=kandidat.wakil');
        $this->join('periode', 'periode.id_periode=kandidat.periode');
        $this->orderBy('id_kandidat', 'DESC');
        return $this->findAll();
    }
}
