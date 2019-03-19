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
        $res   = preg_match('/^([0-9])+$/i', $value);
        if ($res === false || $res === 0) {
            return false;
        }
        $length = strlen($value);
        if (isset($this->params['min']) && $length < $this->params['min']) {
            return false;
        }
        if (isset($this->params['max']) && $length > $this->params['max']) {
            return false;
        }
        return ["data" => $value];
    }
}
