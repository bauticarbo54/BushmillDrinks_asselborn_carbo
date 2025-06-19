<?php

namespace App\Models;

use CodeIgniter\Model;

class Mensajes_model extends Model
{
    protected $table = 'mensajes';
    protected $primaryKey = 'id_mensaje';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['mensaje_nombre', 'mensaje_mail', 'mensaje_telefono', 'mensaje_consulta', 'mensaje_leido'];

    protected $useTimestamps = false;
    protected $createdField = '';
    protected $updatedField = '';
    protected $deletedField = '';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}