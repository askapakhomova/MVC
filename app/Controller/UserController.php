<?php
namespace App\Controller;

use App\Model\Eloquent\User;
use Core\AbstractController;

class UserController extends AbstractController
{
    public function index()
    {
        if ($this -> getUser()) {
            $this -> redirect('/blog');
        }

        if ($_SERVER['REQUEST_URI'] == "/register") {
            return $this -> view -> render(
                'register.phtml');
        }
        if ($_SERVER['REQUEST_URI'] == "/login") {
            return $this -> view -> render(
                'login.phtml',
                [
                    'title' => 'Главная',
                    'user' => $this -> getUserId(),
                ]
            );
        }
        $this -> redirect('/login');

    }

    public function auth()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = User::getByEmail($email);
        if (!$user) {
            return 'Неверный логин и пароль';
        }

        if ($user -> getPassword() !== User::getPasswordHash($password)) {
            return 'Неверный логин и пароль';
        }

        $this -> session -> authUser($user -> getId());
        $this -> redirect('/blog');
    }

    public function register()
    {
        if (!empty($_POST)) {

            $email = (string)$_POST['email'];
            $login = (string)$_POST['login'];
            $password = (string)$_POST['password'];
            $password2 = (string)$_POST['password2'];


            if (!$login || !$password) {
                return 'Не заданы логин или пароль';
            }

            if (!$email) {
                return 'Не задан email';
            }

            if ($password !== $password2) {
                return 'Введенные пароли не совпадают';
            }

            if (mb_strlen($password) < 5) {
                return 'Пароль слишком короткий';
            }

            $data = [
                'login' => $login,
                'email' => $email,
                'password' => $password
            ];
            $user = new User($data);
            $user -> save();

            $this -> session -> authUser($user -> getId());
            $this -> redirect('/blog');
        }
    }

}
