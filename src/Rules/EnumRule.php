<?php
/**
 * Desc: 字符串验证
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

class EnumRule extends RuleAbstract
{
    public function check($value)
    {
        $value  = trim($value);
        $allows = array_filter(explode(',', $this->params['allows']));
        if (!in_array($value, $allows)) {
            return false;
        }
        return ["data" => $value];
    }
}
