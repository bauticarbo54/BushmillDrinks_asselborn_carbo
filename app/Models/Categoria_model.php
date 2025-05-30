<?php

namespace App\Models;

use CodeIgniter\Model;

class Categoria_model extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['categoria_nombre', 'categoria_descripcion'];

    protected $useTimestamps = false;
    protected $createdField = '';
    protected $updatedField = '';
    protected $deletedField = '';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}