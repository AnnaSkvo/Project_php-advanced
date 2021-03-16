<?php

namespace app\repositories;

use app\entities\User;

class UserRepository extends Repository
{
    protected function getTableName(): string
    {
        return  'users';
    }

    protected function getEntityName(): string
    {
        return User::class;
    }

    public function getUserByLogin($login)
    {
        $sql = "SELECT * FROM usesr WHERE login = :login";
        $params = [];

        return $this->getDB()->getObject($sql, $params, $this->getEntityName());
    }
}