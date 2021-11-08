<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'nis';
    protected $allowedFields = ['nis', 'password', 'st_pemilih', 'st_password'];
}
