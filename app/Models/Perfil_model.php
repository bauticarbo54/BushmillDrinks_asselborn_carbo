<?php

namespace App\Models;

use CodeIgniter\Model;

class Perfil_model extends Model
{
    protected $table = 'perfiles';
    protected $primaryKey = 'id_perfil';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['perfil_descripcion'];

    protected $useTimestamps = false;
    protected $createdField = '';
    protected $updatedField = '';
    protected $deletedField = '';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}
