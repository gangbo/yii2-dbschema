<?php

/**
 * Created by daigangbo.
 * User: daigangbo daigangbo@gmail.com
 * Date: 5/28/16
 * Time: 22:08
 */
namespace gangbo\dbschema\models;


use yii\base\Model;

class DbCollection extends Model
{
    public $name;
    public $db;

    /**
     * @param string $name
     * @return mixed
     * @throws \yii\base\UnknownPropertyException
     */
    public function __get($name)
    {

        if (parent::hasProperty($name)) {
            return parent::__get($name);
        }
        return $this->db->$name;
    }
}