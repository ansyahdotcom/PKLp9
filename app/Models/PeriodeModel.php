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
        return $this->orderBy('id_periode', 'ASC')
                    ->findAll();
    }

    public function activePeriode()
    {
        return $this->getWhere(['st_periode' => 1])
                    ->getRowArray();
    }

    public function editPeriode($id)
    {
        return $this->getWhere(['id_periode' => $id])
                    ->getRowArray();
    }

    public function tahunPeriode($periode)
    {
        return $this->getWhere(['id_periode' => $periode])
                    ->getRowArray();
    }
}
