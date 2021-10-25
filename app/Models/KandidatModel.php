<?php

namespace App\Models;

use CodeIgniter\Model;

class KandidatModel extends Model
{
    protected $table = 'kandidat';
    protected $primaryKey = 'id_kandidat';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_kandidat', 'ketua', 'wakil', 'nama_pasangan', 'foto', 'visi', 'misi', 'periode'];

    public function getKandidat()
    {
        return $this->select('*')
                    ->join('user as u1', 'u1.nis=kandidat.ketua')
                    ->join('user as u2', 'u2.nis=kandidat.wakil')
                    ->join('periode', 'periode.id_periode=kandidat.periode')
                    ->orderBy('kandidat.id_kandidat', 'DESC')
                    ->findAll();
    }

    public function getKetua()
    {
        return $this->select('*')
                    ->join('user as u1', 'u1.nis=kandidat.ketua')
                    ->join('periode', 'periode.id_periode=kandidat.periode')
                    ->orderBy('kandidat.id_kandidat', 'DESC')
                    ->findAll();
    }

    public function getWakil()
    {
        return $this->select('*')
                    ->join('user as u2', 'u2.nis=kandidat.wakil')
                    ->join('periode', 'periode.id_periode=kandidat.periode')
                    ->orderBy('kandidat.id_kandidat', 'DESC')
                    ->findAll();
    }

    public function editKandidat($id)
    {
        return $this->select('*')
                    ->join('user as u1', 'u1.nis=kandidat.ketua')
                    ->join('user as u2', 'u2.nis=kandidat.wakil')
                    ->join('periode', 'periode.id_periode=kandidat.periode')
                    ->where('id_kandidat', $id)
                    ->orderBy('id_kandidat', 'DESC')
                    ->first();
    }

    public function pemilihan()
    {
        $data = $this->db->query("SELECT * FROM kandidat, user, kelas, periode 
            WHERE kandidat.ketua = user.nis AND user.id_kelas = kelas.id_kelas 
            AND periode.id_periode = kandidat.id_periode");
        return $data;
    }
}
