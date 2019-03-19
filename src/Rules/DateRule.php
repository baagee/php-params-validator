<?php
/**
 * Desc: 字符串验证
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

class DateRule extends RuleAbstract
{
    public function check($value)
    {
        if (date_create_from_format($this->params['format'], $value) === false) {
            return false;
        }
        return ["data" => $value];
    }
}
