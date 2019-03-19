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
    protected $rules = [];

    protected $errorMessage = '';

    abstract public function addRule($field, $value, $rule, $errorMessage = '');

    abstract public function validate();
}
