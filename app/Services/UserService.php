<?php

namespace App\Services;

use App\Models\LoggedUserModel;

class UserService
{
    protected $user = null;

    public function user()
    {
        if ($this->user === null) {

            $id = session('user.id');

            if (!$id) {
                return null;
            }

            $model = new LoggedUserModel();

            $this->user = $model->getUserFullData($id);
        }

        return $this->user;
    }
}
