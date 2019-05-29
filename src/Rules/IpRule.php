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
        // 判断是否为IP
        if (filter_var($value, FILTER_VALIDATE_IP) === false) {
            return false;
        }
        // 判断ip是否在某个范围内
        if (isset($this->params['start']) && !empty($this->params['start'])) {
            if (ip2long($this->params['start']) > ip2long($value)) {
                return false;
            }
        }

        if (isset($this->params['end']) && !empty($this->params['end'])) {
            if (ip2long($this->params['end']) < ip2long($value)) {
                return false;
            }
        }
        return ["data" => $value];
    }
}
