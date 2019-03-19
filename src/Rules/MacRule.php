<?php
/**
 * Desc: 字符串验证
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

class MacRule extends RuleAbstract
{
    public function check($value)
    {
        if (filter_var($value, FILTER_VALIDATE_MAC) === false) {
            return false;
        }
        return ["data" => $value];
    }
}
