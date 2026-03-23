<?php

namespace App\Libraries;

use Config\Theme as ThemeConfig;

class Theme
{
    protected $config;
    protected $role;

    public function __construct()
    {
        $this->config = new ThemeConfig();

        $user = session('user');

        $this->role = $user['role'] ?? 'profesor';
    }

    public function layout()
    {
        $theme = $this->config->{$this->role};

        return "themes/{$this->role}/{$theme}/layout";
    }
}
