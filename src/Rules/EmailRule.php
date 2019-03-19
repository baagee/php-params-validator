<?php
/**
 * Desc: 字符串验证
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

class EmailRule extends RuleAbstract
{
    public function check($value)
    {
        $status = preg_match('/^[a-zA-Z0-9_-]+(?:\.[\w-_]+)*+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/', $value);
        if (false === $status || 0 === $status) {
            return false;
        }
        return ["data" => $value];
    }
}
