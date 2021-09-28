<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'nis';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['nis', 'nama_usr', 'id_kelas', 'jk', 'st_pemilih', 'st_kandidat', 'password', 'created_at', 'updated_at'];

    public function deleteData($nis)
    {
        return $this->db->table($this->table)->delete(['nis' => $nis]);
    }

    public function add($insert)
    {
        $this->db->table('user')->insert($insert);
    }
}
