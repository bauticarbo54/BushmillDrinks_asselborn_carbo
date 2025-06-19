<?php

namespace App\Models;

use CodeIgniter\Model;

class Ventas_model extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';

    protected $useAutoIncrement = true;
    protected $returnType = 'array'; 
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_cliente', 'venta_fecha'];

    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
