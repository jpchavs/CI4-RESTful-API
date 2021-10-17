<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'client';
    protected $primaryKey           = 'id';
    protected $allowedFields        = ['firstname', 'lastname', 'update_at'];
    
    protected $updateField          = 'updated_at';

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = ['beforeInsert'];
    protected $beforeUpdate         = ['beforeUpdate'];

    protected function beforeInsert(array $data)
    {
        return $this->getHashedPassword($data);
    }

    protected function beforeUpdate(array $data)
    {
        return $this->getHashedPassword($data);
    }

    private function getHashedPassword(array $data)
    {
        if(isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        }

        return $data;
    }

    public function findClientById(string $id)
    {
        $client = $this
            ->asArray()
            ->where(['id' => $id])
            ->first();

        if (!$client) 
            throw new Exception('Client does not exist for specified client id');

        return $client;
    }

}
