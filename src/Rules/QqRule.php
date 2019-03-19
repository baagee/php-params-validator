<?php
/**
 * Desc: 判断是否为QQ号码
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

/**
 * Class QqRule
 * @package BaAGee\ParamsValidator\Rules
 */
class QqRule extends RuleAbstract
{
    /**
     * @param $value
     * @return array|bool|mixed
     */
    public function check($value)
    {
        $res = preg_match('/^[1-9]\d{4,12}$/', $value);
        if ($res === false || $res === 0) {
            return false;
        }
        return ["data" => $value];
    }
}
