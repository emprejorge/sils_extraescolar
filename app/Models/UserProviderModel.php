<?php

namespace App\Models;

use CodeIgniter\Model;

class UserProviderModel extends Model
{
    protected $table = 'user_providers';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'user_id',
        'provider',
        'provider_id'
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';
    protected $updatedField = '';
}
