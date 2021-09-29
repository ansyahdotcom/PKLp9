<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'nis';

    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $allowedFields = ['nis', 'nama_usr', 'id_kelas', 'jk', 'st_pemilih', 'st_kandidat', 'password'];

    public function getUser()
    {
        return $this->getWhere([
            'st_kandidat' => '0'
        ]);
    }

    public function getUser2()
    {
        return $this->findAll();
    }

    public function deleteData($nis)
    {
        return $this->db->table($this->table)->delete(['nis' => $nis]);
    }

    public function add($insert)
    {
        $this->db->table('user')->insert($insert);
    }
}
