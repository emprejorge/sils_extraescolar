<?php

namespace App\Models;

use CodeIgniter\Model;

class LoggedUserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = \App\Entities\User::class;
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'email',
        'password',
        'token',
        'active',
        'last_login',
        'created_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function findByEmail($email)
    {
        return $this->where('email', $email)->first();
    }


    public function getUserFullData($userId)
    {
        $user = $this->select('
            users.id,
            users.email,
            users.active,
            profiles.first_name,
            profiles.last_name,
            profiles.avatar,
            CONCAT(profiles.first_name, " ", profiles.last_name) AS name,
            roles.name as role
        ')
            ->join('profiles', 'profiles.user_id = users.id', 'left')
            ->join('user_roles', 'user_roles.user_id = users.id', 'left')
            ->join('roles', 'roles.id = user_roles.role_id', 'left')
            ->where('users.id', $userId)

            ->first();

        // if ($user && $user->roles) {
        //     dd($user->roles);
        //     $user->roles = explode(',', $user->roles);
        // }

        return $user;
    }

    public function getUserList()
    {
        $user = $this->select('
            users.id,
            users.email,
            users.active,
            users.created_at,
            profiles.first_name as first_name,
            profiles.last_name as last_name,
            CONCAT(profiles.first_name, " ", profiles.last_name) AS nombre_completo,
            GROUP_CONCAT(roles.code) as roles
        ')
            ->join('profiles', 'profiles.user_id = users.id', 'left')
            ->join('user_roles', 'user_roles.user_id = users.id', 'left')
            ->join('roles', 'roles.id = user_roles.role_id', 'left')
            ->groupBy('users.id')
            ->findAll();



        return $user;
    }
}
