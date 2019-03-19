<?php
/**
 * Desc: 字符串验证
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

class RegexpRule extends RuleAbstract
{
    public function check($value)
    {
        $res = preg_match($this->params['pattern'], $value);
        if ($res === false || $res === 0) {
            return false;
        }
        return ["data" => $value];
    }
}
