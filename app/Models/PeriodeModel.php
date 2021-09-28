<?php

namespace App\Models;

use CodeIgniter\Model;

class PeriodeModel extends Model
{
    protected $table = 'periode';
    protected $useTimestamps = true;

    public function getPeriode()
    {
        return $this->findAll();
    }
}
