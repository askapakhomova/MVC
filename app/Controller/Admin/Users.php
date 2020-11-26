<?php


namespace App\Controller\Admin;


use App\Controller\AdminController;
use App\Model\Eloquent\Message;
use App\Model\Eloquent\User;

class Users extends AdminController
{
    public function index()
    {
            return $this -> view -> render('admin/users.phtml'
                , [
                    'users' => User ::getList(),
                ]
            );
        }

    public function saveUser()
    {

        $id = (int)$_POST['id'];
        $email = (string)$_POST['email'];
        $login = (string)$_POST['login'];
        $password = (string)$_POST['password'];


        $user = User::getById($id);
        if (!$user) {
            return $this->response(['error' => 'no_user']);
        }

        if (!$login) {
            return $this->response(['error' => 'no_login']);
        }

        if (!$email) {
            return $this->response(['error' => 'no_email']);
        }

        if ($password && mb_strlen($password) < 5) {
            return $this->response(['error' => 'too_short_password']);
        }

        $user->login = $login;
        $user->email = $email;

        $emailUser = User::getByEmail($email);
        if ($emailUser && $emailUser->id != $id) {
            return $this->response(['error' => 'This_email_already_used']);
        }



        if ($password) {
            $user->password = User::getPasswordHash($password);
        }

        $user -> save();

        return $this->response(['response' => 'ok']);
    }

    public function deleteUser()
    {
        $id = (int)$_POST['id'];
        $user = User::getById($id);
        if (!$user) {
            return $this->response(['error' => 'no_user']);
        }
        $user->delete();
        return $this->response(['response' => 'ok']);
    }

    public function addUser()
    {
        $email = (string)$_POST['email'];
        $login = (string)$_POST['login'];
        $password = (string)$_POST['password'];

        if (!$login || !$password) {
            return 'Не заданы имя и пароль';
        }

        if (!$login) {
            return $this->response(['error' => 'no_login']);
        }

        if (!$email) {
            return $this->response(['error' => 'no_email']);
        }

        if (!$password || mb_strlen($password) < 5) {
            return $this->response(['error' => 'too_short_password']);
        }

        /** @var User $emailUser */
        $emailUser = User::getByEmail($email);
        if ($emailUser) {
            return $this->response(['error' => 'this_email_already_used']);
        }

        $userData = [
            'login' => $login,
            'email' => $email,
            'password' => User::getPasswordHash($password),

        ];
        $user = new User($userData);
        $user->save();

        return $this->response(['response' => 'ok']);
    }
    public function response(array $data)
    {
        header('Content-type: application/json');
        return json_encode($data);
    }

}