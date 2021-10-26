<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    // public function deleteData($id_user)
    // {
    //     return $this->db->table($this->table)->delete(['id_user' => $id_user]);
    // }

    // public function add($insert)
    // {
    //     $this->db->table('user')->insert($insert);
    // }
    protected $table  = 'user';
    // protected $primaryKey = 'id_user';

    public function getVoting()
    {
        $data = $this->db->query("SELECT COUNT(voting.id_voting) AS voting from voting, kandidat, periode WHERE voting.id_kandidat = kandidat.id_kandidat AND kandidat.id_periode = periode.id_periode AND periode.st_periode = 1");
        return $data;
    }

    public function getJumlahUser()
    {
        $data = $this->db->query("SELECT COUNT(nis) AS nis FROM user");
        return $data;
    }

    public function getJumlahKandidat()
    {
        $data = $this->db->query("SELECT COUNT(id_kandidat) AS kandidat FROM kandidat, periode WHERE kandidat.id_periode = periode.id_periode AND periode.st_periode = 1");
        return $data;
    }

    public function getPeriode()
    {
        $data = $this->db->query("SELECT periode FROM periode WHERE st_periode = 1");
        return $data;
    }
}
