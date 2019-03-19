<?php
/**
 * Desc: 字符串验证
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

class ChineseRule extends RuleAbstract
{
    public function check($value)
    {
        if (strlen($value) === 0) {
            return false;
        }
        $res = preg_match("/^[\x7f-\xff]+$/", $value);
        if ($res === false || $res === 0) {
            return false;
        }
        return ['data' => $value];
    }
}
