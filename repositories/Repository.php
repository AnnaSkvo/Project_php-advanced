<?php
namespace app\repositories;

use app\entities\Entity;
use app\main\Container;
use app\services\DB;

/**
 * Class Repository
 * @package app\repositories
 */
abstract class Repository
{
    /** @var Container */
    protected $container;

    abstract protected function getTableName():string;
    abstract protected function getEntityName():string;

    public function setContainer(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @return DB
     */
    protected function getDB()
    {
        return $this->container->db;
    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id ";
        $params = [':id' => $id];
        return $this->getDB()->getObject($sql, $this->getEntityName(), $params);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->getDB()->getAllObjects($sql, $this->getEntityName());
    }

    protected function insert(Entity $entity)
    {
        $fields = [];
        $params = [];
        foreach ($entity as $fieldName => $value) {
            if ($fieldName == 'id') {
                continue;
            }
            $fields[] = $fieldName;
            $params[":{$fieldName}"] = $value;
        }

        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            $this->getTableName(),
            implode(',', $fields),
            implode(',', array_keys($params))
        );

        $this->getDB()->execute($sql, $params);
        $entity->id = $this->getDB()->getLastId();
        return $entity;
    }

    protected function update(Entity $entity)
    {
        /*
            UPDATE
                `users`
            SET
                `login` = :login,
                `password` = :password,
                `is_admin` = :is_admin
            WHERE
                `id` = :id;
        */
        $fields = [];
        $params = [];
        foreach ($entity as $fieldName => $value) {
            $params[":{$fieldName}"] = $value;
            if ($fieldName == 'id') {
                continue;
            }
            $fields[] = "{$fieldName} = :{$fieldName}";
        }

//        $sql = sprintf(
//            "UPDATE %s SET %s WHERE id = :id",
//            static::getTableName(),
//            implode(',', $fields)
//        );

        $sql = "UPDATE " . $this->getTableName() . " SET " . implode(',', $fields) . " WHERE id = :id";
        $this->getDB()->execute($sql, $params);
        return $entity;
    }

    public function save(Entity $entity)
    {
        if (empty($entity->id)) {
            return $this->insert($entity);
        }
        return $this->update($entity);
    }

    public function delete($entity)
    {
        //$this->id
    }

    //
}
