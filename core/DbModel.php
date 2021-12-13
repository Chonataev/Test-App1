<?php
namespace app\core;

use app\core\Application;
use app\core\Model;

abstract class DbModel extends Model
{
    abstract public static function tableName(): string;

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (" . implode(",", $attributes) . ") 
                VALUES (" . implode(",", $params) . ")");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true; 
    }

    public function update($id)
    {
        $tableName = $this->tableName();
        $attributes = $this->updateAttributes();
        $statement = self::prepare("UPDATE $tableName SET firstname=:firstname, lastname=:lastname, DOB=:DOB, gender=:gender WHERE `id`=:id");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true; 
    }

    public static function prepare($sql): \PDOStatement
    {
        return Application::$app->db->prepare($sql);
    }

    public static function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    public static  function findOneById($id){
        $tableName = static::tableName();
        $statement = self::prepare("SELECT `id`, `firstname`, `lastname`, `email`,`DOB`,`gender` FROM $tableName WHERE `id` = $id");
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    public function findAll($count,$sort){
        $start = ($count-1)*3; 
        if($start<0){
            $start=0; 
        }
        if(!$sort)
        $sort = 'id';
        $tableName = static::tableName();
        $statement = self::prepare("SELECT `id`, `firstname`, `lastname`, `role`, `email`,`DOB`,`gender` FROM $tableName ORDER BY $sort LIMIT $start, 3");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function delete($id){
        $tableName = $this->tableName();
        $statement = self::prepare("DELETE FROM users 
        
        
        
        
        
         id=?");
        $statement->execute([$id]);
        return true; 
    }

    public function getCountPages(){
        $tableName = $this->tableName();
        $statement = self::prepare("SELECT COUNT(*) FROM users");
        $statement->execute();
        return $statement->fetch();
    }

}