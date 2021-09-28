<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $useTimestamps = true;
    protected $allowedFields = ['nis', 'st_kandidat'];

    public function getUser()
    {
        return $this->getWhere([
            'st_kandidat' => '0'
        ]);
    }
}
