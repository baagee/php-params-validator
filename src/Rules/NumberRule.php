<?php
/**
 * Desc: 判断是否为数字字符串
 * User: baagee
 * Date: 2019/3/19
 * Time: 下午6:06
 */

namespace BaAGee\ParamsValidator\Rules;

use BaAGee\ParamsValidator\Base\RuleAbstract;

/**
 * Class NumberRule
 * @package BaAGee\ParamsValidator\Rules
 */
class NumberRule extends RuleAbstract
{
    /**
     * @param $value
     * @return array|bool|mixed
     */
    public function check($value)
    {
        $value = strval($value);
        $res   = is_numeric($value);
        if ($res === false) {
            return false;
        }
        $length = strlen($value);
        if (isset($this->params['min']) && $length < abs($this->params['min'])) {
            return false;
        }
        if (isset($this->params['max']) && $length > abs($this->params['max'])) {
            return false;
        }
        return ["data" => $value];
    }
}
