<?php
/**
 * Desc: 字符串验证
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

class FloatRule extends RuleAbstract
{
    public function check($value)
    {
        if (!is_numeric($value)) {
            return false;
        }
        $value = floatval($value);
        if (isset($this->params['min']) && $value < $this->params['min']) {
            return false;
        }
        if (isset($this->params['max']) && $value > $this->params['max']) {
            return false;
        }
        return ["data" => $value];
    }
}
