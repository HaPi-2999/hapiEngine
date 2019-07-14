<?php


namespace vendor\core\base;


use RedBeanPHP\R;
use vendor\core\Db;

class Model extends Db
{
    protected static $table = "";

    /**
     * array data
     * Model constructor.
     * @param array $data
     */
    public function __construct()
    {

    }

    /**
     * Поиск по id
     * @return array
     */
    public static function find($id)
    {
        return self::getAll("select * from " . static::$table . " where id=?", [$id]);
    }

    /**
     * получение всех данных из таблицы
     * @return array
     */
    public static function findAll()
    {
        return self::getAll("select * from " . static::$table);
    }

    /**
     * Поиск в базе данных по конкретному полю
     * @param $nameField
     * @param $valueField
     */
    public static function findByFieldName($nameField, $valueField)
    {
        return self::getAll("select * from " . static::$table . " where $nameField=?", [$valueField]);
    }

}