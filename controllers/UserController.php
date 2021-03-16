<?php

namespace app\controllers;


use app\entities\User;
use app\repositories\UserRepository;

class UserController extends Controller
{
    public function allAction()
    {
        $users = (new UserRepository())->getAll();
        return $this->renderer
            ->render(
                'userAll',
                ['users' => $users]
            );
    }

    public function oneAction()
    {
        $id = $this->getId();
        $person = (new UserRepository())->getOne($id);
        return $this->renderer
            ->render(
                'userOne',
                [
                    'user' => $person,
                    'title' => "Пользователь: " . $person->login
                ]
            );
    }


    public function addAction()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return $this->renderer->render('userAdd');
        }

        $user = new User();
        $user->password = $_POST['password'];
        $user->login = $_POST['login'];
        $user->name = $_POST['name'];

        (new UserRepository())->save($user);

        header('Location: /');
        return '';
    }
}
