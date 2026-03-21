<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity
{
    protected $attributes = [];

    public function getName()
    {
        return $this->attributes['name'] ?? null;
    }

    public function getRole()
    {
        return $this->attributes['role'] ?? null;
    }

    public function getAvatar()
    {
        return $this->attributes['avatar'] ?? null;
    }

    public function isProfesor()
    {
        return ($this->attributes['role'] ?? null) === 'profesor';
    }

    public function isAdmin()
    {
        return ($this->attributes['role'] ?? null) === 'admin';
    }
}
