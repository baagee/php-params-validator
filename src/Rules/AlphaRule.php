<?php
/**
 * Desc: 判断是否为字母、数字、下划线（_）、破折号（-）
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

class AlphaRule extends RuleAbstract
{
    public function check($value)
    {
        $res = preg_match('/^([a-z])+$/i', $value);
        if ($res === false || $res === 0) {
            return false;
        }
        return ["data" => $value];
    }
}
