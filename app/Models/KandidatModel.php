<?php

namespace App\Models;

use CodeIgniter\Model;

class KandidatModel extends Model
{
    protected $table = 'kandidat';
    protected $primaryKey = 'id_kandidat';
    protected $useTimestamps = true;
    protected $createdField  = 'created_kd';
    protected $updatedField  = 'updated_kd';
    protected $allowedFields = ['id_kandidat', 'ketua', 'wakil', 'nama_pasangan', 'foto', 'visi', 'misi', 'periode'];

    public function getKandidat()
    {
        return $this->select('*')
            ->join('user as u1', 'u1.nis=kandidat.ketua')
            ->join('user as u2', 'u2.nis=kandidat.wakil')
            ->join('periode', 'periode.id_periode=kandidat.periode')
            ->where('st_periode', '1')
            ->orderBy('id_kandidat', 'DESC')
            ->findAll();
    }

    public function kandidatPeriode($periode)
    {
        return $this->select('*')
            ->join('user as u1', 'u1.nis=kandidat.ketua')
            ->join('user as u2', 'u2.nis=kandidat.wakil')
            ->join('periode', 'periode.id_periode=kandidat.periode')
            ->where('kandidat.periode', $periode)
            ->orderBy('id_kandidat', 'DESC')
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
            AND periode.id_periode = kandidat.periode AND periode.st_periode = 1");
        return $data;
    }

    public function periode()
    {
        $data = $this->db->query("SELECT * FROM periode WHERE st_periode = 1");
        return $data;
    }
}
