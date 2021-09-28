<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginAdminModel extends Model
{
    protected $table      = 'admin';
    protected $allowedFields = ['username', 'password'];
}
