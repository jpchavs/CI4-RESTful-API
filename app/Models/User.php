<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class User extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'user';
    protected $primaryKey           = 'id';
    protected $allowedFields        = ['username', 'password', 'email', 'name', 'update_at'];
    
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
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }

        return $data;
    }

    public function findUserByEmailAddress(string $emailAddress)
    {
        $user = $this
            ->asArray()
            ->where(['email' => $emailAddress])
            ->first();

        if (!$user) 
            throw new Exception('User does not exist for specified email address');

        return $user;
    }

}
