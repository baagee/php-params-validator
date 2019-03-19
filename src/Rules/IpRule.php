<?php
/**
 * Desc: IP验证
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

/**
 * Class IpRule
 * @package BaAGee\ParamsValidator\Rules
 */
class IpRule extends RuleAbstract
{
    /**
     * @param $value
     * @return array|bool|mixed
     */
    public function check($value)
    {
        if (filter_var($value, FILTER_VALIDATE_IP) === false) {
            return false;
        }
        return ["data" => $value];
    }
}
