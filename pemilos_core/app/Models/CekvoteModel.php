<?php

namespace App\Models;

use CodeIgniter\Model;

class CekvoteModel extends Model
{
    protected $table = 'cekvote';
    protected $allowedFields = ['nis'];

    public function cek($data)
    {
        $this->db->table('cekvote')->ignore(true)->insert($data);
    }
}