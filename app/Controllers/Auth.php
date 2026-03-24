<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Google\Client;
use App\Models\UserModel;
use App\Models\ProfileModel;
use App\Models\RoleModel;
use App\Models\UserRoleModel;
use App\Models\UserProviderModel;

class Auth extends Controller
{
    public function index()
    {
        if (session()->get('user')) {
            return redirect()->to('/dashboard');
        }

        return redirect()->to('/login');
    }

    public function login()
    {
        // Vista simple con botón de prueba
        return view('login');
    }

    /**
     * Cerrar sesión
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    /**
     * Iniciar autenticación con Google Oauth2
     */
    public function google()
    {
        $client = new Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));

        $client->addScope('email');
        $client->addScope('profile');

        return redirect()->to($client->createAuthUrl());
    }


    public function callback()
    {
        $client = new \Google\Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));

        $token = $client->fetchAccessTokenWithAuthCode($this->request->getVar('code'));

        if (isset($token['error'])) {
            return redirect()->to('/login');
        }

        $client->setAccessToken($token['access_token']);

        $google_service = new \Google\Service\Oauth2($client);
        $data = $google_service->userinfo->get();

        $email = $data->email;

        // Validar dominio
        if (!str_ends_with($email, '@scuolaitalianalaserena.cl')) {
            return redirect()->to('/login');
        }

        $userModel       = new UserModel();
        $profileModel    = new ProfileModel();
        $roleModel       = new RoleModel();
        $userRoleModel   = new UserRoleModel();
        $providerModel   = new UserProviderModel();

        /*
    BUSCAR PROVIDER GOOGLE
    */
        $provider = $providerModel
            ->where('provider', 'google')
            ->where('provider_id', $data->id)
            ->first();

        if ($provider) {
            $user = $userModel->find($provider['user_id']);
        } else {

            /*
        BUSCAR USUARIO POR EMAIL
        */
            $user = $userModel->where('email', $email)->first();

            if (!$user) {

                /*
            CREAR USUARIO
            */
                $userId = $userModel->insert([
                    'email'  => $email,
                    'active' => 1
                ]);

                /*
            DESCARGAR AVATAR
            */
                $avatarUrl = $data->picture;
                $avatarContent = @file_get_contents($avatarUrl);

                $avatar = null;

                if ($avatarContent) {

                    $fileName = 'avatar_' . time() . '.jpg';

                    file_put_contents(
                        FCPATH . 'uploads/avatars/' . $fileName,
                        $avatarContent
                    );

                    $avatar = 'uploads/avatars/' . $fileName;
                }

                /*
            CREAR PROFILE
            */
                $profileModel->insert([
                    'user_id'    => $userId,
                    'first_name' => $data->givenName,
                    'last_name'  => $data->familyName,
                    'avatar'     => $avatar
                ]);

                /*
            DEFINIR ROL
            PRIMER USUARIO = ADMIN
            */
                $userCount = $userModel->withDeleted()->countAllResults();

                $roleCode = $userCount === 1 ? 'admin' : 'profesor';

                $role = $roleModel->where('code', $roleCode)->first();

                $userRoleModel->insert([
                    'user_id' => $userId,
                    'role_id' => $role['id']
                ]);

                $user = $userModel->find($userId);
            }

            /*
        GUARDAR PROVIDER GOOGLE
        */
            $providerModel->insert([
                'user_id'     => $user['id'],
                'provider'    => 'google',
                'provider_id' => $data->id
            ]);
        }

        /*
    OBTENER PROFILE
    */
        $profile = $profileModel
            ->where('user_id', $user['id'])
            ->first();

        /*
    OBTENER ROL
    */
        $role = $userRoleModel
            ->select('roles.code')
            ->join('roles', 'roles.id = user_roles.role_id')
            ->where('user_roles.user_id', $user['id'])
            ->first();
        /*
    GENERAR TOKEN DE SESION
    */
        $token = bin2hex(random_bytes(32));

        $userModel->update($user['id'], [
            'token'      => $token,
            'last_login' => date('Y-m-d H:i:s')
        ]);

        /*
    CREAR SESION
    */
        session()->set('user', [
            'id'        => $user['id'],
            'token'     => $token,
            'name'      => ($profile['first_name'] ?? '') . ' ' . ($profile['last_name'] ?? ''),
            'email'     => $user['email'],
            'avatar'    => $profile['avatar'] ?? null,
            'role'      => $role['code'] ?? null,
            'logged_in' => true
        ]);

        if (($role['code'] ?? null) === 'admin') {
            return redirect()->to('/admin');
        }

        return redirect()->to('/dashboard');
    } //.callback
}
