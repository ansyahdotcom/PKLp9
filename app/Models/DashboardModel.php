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

    public function getJumlahKandidat()
    {
        $this->select('*');
        $this->join('kandidat', 'kandidat.id_kandidat');
        return $this->db->table('kandidat')->countAll();
    }
}
