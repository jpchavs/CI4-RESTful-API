<?php namespace App\Models;

use CodeIgniter\Model;

class Inventory extends Model
{   
    protected $DBGroup = 'default';
    protected $table      = 'inventory';
    protected $primaryKey = 'id';

    // protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['item_name', 'quantity', 'availability'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';

    // protected $validationRules    = ['item_name'=>required];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;
}