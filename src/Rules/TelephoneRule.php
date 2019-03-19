<?php
/**
 * Desc: 字符串验证
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

class TelephoneRule extends RuleAbstract
{
    public function check($value)
    {
        $res = preg_match('/^((\(\d{2,3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}(\-\d{1,4})?$/', $value);
        if ($res === false || $res === 0) {
            return false;
        } else {
            return ["data" => $value];
        }
    }
}
