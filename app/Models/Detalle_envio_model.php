<?php

namespace App\Models;

use CodeIgniter\Model;

class Detalle_envio_model extends Model
{
    protected $table = 'detalle_envio';
    protected $primaryKey = 'id_envio';

    protected $useAutoIncrement = true;
    protected $returnType = 'array'; 
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_venta', 'envio_telefono', 'envio_mail', 'envio_provincia', 'envio_ciudad', 'envio_codigo', 'envio_direccion'];

    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
