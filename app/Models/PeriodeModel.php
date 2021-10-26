<?php

namespace App\Models;

use CodeIgniter\Model;

class PeriodeModel extends Model
{
    protected $table = 'periode';
    protected $primaryKey = 'id_periode';
    protected $useTimestamps = true;
    protected $createdField = 'created_pd';
    protected $updatedField = 'updated_pd';
    protected $allowedFields = ['id_periode', 'periode', 'st_periode'];

    public function getPeriode()
    {
        return $this->orderBy('id_periode', 'DESC')
                    ->findAll();
    }

    public function editPeriode($id)
    {
        return $this->getWhere(['id_periode' => $id])
                    ->getRowArray();
    }
}
