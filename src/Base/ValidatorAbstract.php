<?php
/**
 * Desc: 抽象参数验证
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午4:52
 */

namespace BaAGee\ParamsValidator\Base;

abstract class ValidatorAbstract
{
    use SingletonTrait;
    protected $rules = [];

    abstract public function addRules(string $field, $value, array $rules);

    abstract public function validate();

    final public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new static();
        }
        return self::$_instance;
    }
}
