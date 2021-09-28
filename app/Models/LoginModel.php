<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table      = 'user';
    protected $allowedFields = ['nis', 'password'];
}
