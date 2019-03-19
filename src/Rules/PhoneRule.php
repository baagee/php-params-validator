<?php
/**
 * Desc: 手机号验证
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

/**
 * Class PhoneRule
 * @package BaAGee\ParamsValidator\Rules
 */
class PhoneRule extends RuleAbstract
{
    /**
     * @param $value
     * @return array|bool|mixed
     */
    public function check($value)
    {
        $res = preg_match("/^0?(13|14|15|17|18)[0-9]{9}$/", $value);
        if ($res === false || $res === 0) {
            return false;
        }
        return ["data" => $value];
    }
}
