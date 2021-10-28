<?php

namespace App\Models;

use CodeIgniter\Model;

class VotingModel extends Model
{
    protected $table = 'voting';
    protected $useTimestamps = true;
    protected $allowedFields = ['nis', 'id_kandidat', 'created_at'];

}
